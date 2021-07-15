<?php

namespace App\Http\Livewire\Child;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Cartalyst\Stripe\Exception\BadRequestException;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\InvalidRequestException;
use Cartalyst\Stripe\Exception\NotFoundException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $name, $email, $mobile, $zip, $address, $city, $state, $company, $password;

    protected $listeners = ["submit"];

    public function rules()
    {
        return [
            'name'     => "required",
            'email'    => "required|email",
            'mobile'   => "required",
            'zip'      => "required|numeric",
            'address'  => "required",
            'city'     => "required",
            "state"    => "required",
            "company"  => "nullable",
            "password" => Rule::requiredIf(!auth()->check()),
        ];
    }

    public function submit($stripeToken)
    {
        $validatedData = $this->validate();

        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];
        $newUser = $validatedData;

        $uid = null;
        if (!auth()->check()) {
            $uid = cache('user_temp_id', 0);
        }
        if (!auth()->check() || !auth()->user()->email_verified_at) {
            $this->guestCheckout($newUser, $credentials);
        }

        if (auth()->check()) {
            $carts = Cart::where('user_id', $uid ?? userId())->get();

            $coupon = session('appliedCoupon');

            unset($validatedData['password']);

            if ($uid) {
                $orderStatus = "waiting";
            } else {
                if (auth()->user()->email_verified_at) {
                    $orderStatus = "pending";
                } else {
                    $orderStatus = "waiting";
                }
            }

            $final = finalPrice($uid);

            $validatedData['user_id']        = auth()->id();
            $validatedData['total_price']    = cartTotal($uid)['total'];
            $validatedData['coupon']         = $coupon ? $coupon->code : null;
            $validatedData['tax']            = $final['tax'];
            $validatedData['final_price']    = $final['total'];
            $validatedData['payment_status'] = 'pending';
            $validatedData['order_status']   = $orderStatus;

            $order = Order::create($validatedData);

            $message = null;

            try {
                Stripe::charges()->create([
                    'amount'        => $order->final_price,
                    'currency'      => 'USD',
                    'source'        => $stripeToken["id"],
                    'description'   => 'This payments belongs to order id ' . $order->id,
                    'receipt_email' => $order->email,
                    'metadata'      => [],
                ]);

                Order::find($order->id)->update([
                    'payment_status' => 'success',
                    'payment_type'   => $stripeToken["type"],
                ]);
            } catch (CardErrorException $e) {
                $message = $e->getMessage();
            } catch (BadRequestException $e) {
                $message = $e->getMessage();
            } catch (InvalidRequestException $e) {
                $message = $e->getMessage();
            } catch (NotFoundException $e) {
                $message = $e->getMessage();
            } catch (Exception $e) {
                $message = $e->getMessage();
            }

            session()->flash('card_error', $message);

            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id'        => $order->id,
                    'product_id'      => $cart->product_id,
                    'product_attr_id' => $cart->product_attr_id,
                    'qty'             => $cart->qty,
                ]);
                $pd = ProductDetail::find($cart->product_attr_id);
                $pd->update(['qty' => $pd->qty - $cart->qty]);
                $cart->delete();
            }

            if (session()->has("appliedCoupon")) {
                $coupon = session("appliedCoupon");
                $coupon->update(["used" => $coupon->used + 1]);
            }

            session()->forget('appliedCoupon');
            session()->forget('appliedCouponCode');
            session()->forget('appliedCouponExtra');

            if (auth()->user()->email_verified_at) {
                $data = ["name" => auth()->user()->name, "link" => route("order.detail", $order->id)];

                Notification::send(auth()->user(), new OrderPlaced($data));
            }

            session()->flash('order_placed', 'Your order has been successfully placed.');
            return redirect()->route('order.detail', $order->id);
        } else {
            session()->flash('error_msg', 'Please enter valid login information.');
        }
    }

    public function guestCheckout(array $newUser, array $credentials)
    {
        $user = User::where("email", $newUser["email"])->first();

        if (!$user) {
            $this->prepareUser(null, $newUser);
        } elseif (!$user->email_verified_at) {
            $this->prepareUser($user);
        }

        Auth::attempt($credentials, true);
    }

    public function prepareUser($user = null, array $newUser = [])
    {
        $hash = str_shuffle('absdkmfnejfmkedmsmf109948394344usdnfjenejm');

        $newUser['verification_code'] = $hash;

        if ($user) {
            $user->update(["verification_code" => $hash]);
        } else {
            $user = User::create($newUser);
        }

        $data = [
            'name' => $user->name,
            'link' => route('verify', $newUser['verification_code']),
        ];
        sendVerificationEmail($data, $user);
    }

    public function mount()
    {
        if (auth()->check()) {
            $this->name     = auth()->user()->name;
            $this->email    = auth()->user()->email;
            $this->mobile   = auth()->user()->mobile;
            $this->zip      = auth()->user()->zip;
            $this->address  = auth()->user()->address;
            $this->city     = auth()->user()->city;
            $this->state    = auth()->user()->state;
            $this->compoany = auth()->user()->compoany;
        }
    }

    public function render()
    {
        return view('livewire.child.checkout-form');
    }
}
