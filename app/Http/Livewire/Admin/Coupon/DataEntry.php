<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Rules\greaterThanZero;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DataEntry extends Component
{
    public $that   = 'coupon';
    public $thatUp = 'Coupon';
    public $editId = '';

    public $title;
    public $code;
    public $value;
    public $cart_min_value;
    public $type;
    public $expired_on;
    public $limit;

    public $coupon;

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'title'          => ['required', Rule::unique('coupons')->ignore($this->editId)],
            'code'           => ['required', Rule::unique('coupons')->ignore($this->editId)],
            'value'          => 'required',
            'cart_min_value' => 'required',
            'type'           => 'required',
            'expired_on'     => 'required',
            'limit'          => ['nullable', "integer", new greaterThanZero],
        ]
        : [
            'title'          => 'required|unique:coupons',
            'code'           => 'required|unique:coupons',
            'value'          => 'required',
            'cart_min_value' => 'required',
            'type'           => 'required',
            'expired_on'     => 'required',
            'limit'          => ['nullable', "integer", new greaterThanZero],
        ];

        $this->validate($validationArr);

        $form = [
            'code'           => $this->code,
            'title'          => $this->title,
            'value'          => $this->value,
            'cart_min_value' => $this->cart_min_value,
            'type'           => $this->type,
            'expired_on'     => $this->expired_on,
            'limit'          => $this->limit || 0,
        ];
        $status = "added";

        if ('' != $this->editId && $this->coupon && can('edit coupon')) {
            $this->coupon->update($form);
            $status = "updated";
        } else if (can('add coupon')) {
            Coupon::create($form);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->coupon         = Coupon::where('id', $id)->firstOrFail();
            $this->code           = $this->coupon->code;
            $this->value          = $this->coupon->value;
            $this->title          = $this->coupon->title;
            $this->cart_min_value = $this->coupon->cart_min_value;
            $this->type           = $this->coupon->type;
            $this->expired_on     = $this->coupon->expired_on;
            $this->editId         = $this->coupon->id;
            $this->limit          = $this->coupon->limit;
        }
    }

    public function render()
    {
        return view('livewire.admin.coupon.data-entry')
            ->layout('layouts.admin');
    }
}
