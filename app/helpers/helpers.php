<?php

use App\Models\Cart;
use App\Models\User;
use App\Notifications\VerifyMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

function dataTableDate($date)
{
    return '' != $date ? date_format($date, 'd-m-Y') : '';
}

function dataTableTime($date)
{
    return '' != $date ? date_format($date, 'h:m:i') : '';
}

function fileSrc($dir, $name)
{
    return asset('storage/' . $dir . '_image/' . $name);
}

function userId()
{
    return Auth::check() ? Auth::user()->id : cache('user_temp_id', 0);
}

function totalCart()
{
    return \App\Models\Cart::where('user_id', userId())->count();
}

function sendVerificationEmail($data, $user)
{
    Notification::send($user, new VerifyMail($data));
}

function resendCode($email)
{
    $user = User::where('email', $email)->first();

    if ($user) {
        $hash = str_shuffle('absdkmfnejfmkedmsmf109948394344usdnfjenejm');
        $user->update([
            'verification_code' => $hash,
        ]);

        $data = [
            'name' => $user->name,
            'link' => route('verify', $user['verification_code']),
        ];

        sendVerificationEmail($data, $user);
        session()->flash('verify_success_msg', "Please check your email to verify your account.");
    } else {
        session()->flash('error_msg', 'Please renter your mail and submit form again.');
    }
}

function cartTotal($uid = null)
{
    $carts = Cart::where('user_id', $uid ?? userId())
        ->with('attribute')
        ->with('product')
        ->get();
    $total = 0;
    foreach ($carts as $cart) {
        $total += $cart->attribute->price * $cart->qty;
    }

    return ['total' => $total, 'carts' => $carts];
}

function cartTax($carts)
{
    $total = 0;
    foreach ($carts as $cart) {
        $total += ($cart->attribute->price * $cart->product->tax->value) / 100;
    }

    return $total;
}

function finalPrice($uid = null)
{
    $carts = Cart::where('user_id', $uid ?? userId())
        ->with('product')
        ->with('attribute')
        ->get();
    $total = 0;
    foreach ($carts as $cart) {
        $total += $cart->attribute->price * $cart->qty;
    }

    $appliedCouponExtra = session('appliedCouponExtra');
    $total -= $appliedCouponExtra;

    $tax = cartTax($carts);
    $total += $tax;

    return ['total' => $total, 'tax' => $tax];
}

function resendVerifyCode()
{
    resendCode(auth()->user()->email);
    session()->flash('mail_success_msg', "Please check your email to verify your account. if you don't receive mail click here to resend code.");
}

function can($ability)
{
    return auth()->user()->can($ability);
}
