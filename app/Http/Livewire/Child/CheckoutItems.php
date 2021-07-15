<?php

namespace App\Http\Livewire\Child;

use App\Models\Cart;
use App\Models\Coupon;
use Livewire\Component;

class CheckoutItems extends Component
{
    protected $listeners = ['delete'];

    public $carts;
    public $total;
    public $subTotal;
    public $tax;
    public $coupon;
    public $appliedCoupon;
    public $appliedCouponCode;
    public $appliedCouponExtra = 0;

    public function delete($id)
    {
        Cart::destroy($id);
        $this->emit('cartUpdated');
        if (Cart::where('user_id', userId())->count() < 1) {
            return redirect()->route('shop');
        }
    }

    public function submit()
    {
        $this->validate([
            'coupon' => "required",
        ]);
        $coupon = Coupon::where('code', $this->coupon)->first();

        if (!$coupon) {
            return session()->flash('error_msg', 'Enter valid coupon.');
        }

        if (0 == $coupon->status) {
            return session()->flash('error_msg', 'Coupon deactivated.');
        }

        if ($coupon->limit && $coupon->used >= $coupon->limit) {
            return session()->flash('error_msg', 'Coupon limit exceed.');
        }

        $now        = strtotime(date("Y-m-d"));
        $expired_on = strtotime($coupon->expired_on);
        if ($now > $expired_on) {
            return session()->flash('error_msg', 'Coupon expired.');
        }

        if ($coupon->cart_min_value > $this->subTotal) {
            return session()->flash('error_msg', 'Cart min value should be greater than or equals to ' . $coupon->cart_min_value . '.');
        }

        $appliedValue = 0;
        if ("F" == $coupon->type) {
            $appliedValue = $coupon->value;
        } else if ("P" == $coupon->type) {
            $appliedValue = ($coupon->value * $this->subTotal) / 100;
        }
        session()->put('appliedCoupon', $coupon);
        session()->put('appliedCouponCode', $coupon->code);
        session()->put('appliedCouponExtra', $appliedValue);
        $this->reset('coupon');
        return session()->flash('success_msg', 'Coupon successfully applied.');
    }

    public function render()
    {
        $carts       = cartTotal();
        $this->carts = $carts['carts'];

        $this->subTotal = $carts['total'];
        $this->tax      = cartTax($this->carts);

        $this->total = $this->subTotal + $this->tax;

        $this->appliedCoupon      = session('appliedCoupon');
        $this->appliedCouponCode  = session('appliedCouponCode');
        $this->appliedCouponExtra = session('appliedCouponExtra');

        $this->total -= $this->appliedCouponExtra;

        return view('livewire.child.checkout-items');
    }
}
