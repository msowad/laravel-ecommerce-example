<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Detail extends Component
{
    public $order;
    public $oid;

    public function cancel($id)
    {
        if (can('manage order')) {
            Order::where('id', $id)->where('order_status', '!=', 'success')->where('cancel_by', null)->update([
                'cancel_by'    => 'admin',
                "cancel_on"    => now(),
                'order_status' => 'canceled',
            ]);
        }
    }

    public function reorder($id)
    {
        if (can('manage order')) {
            Order::where('id', $id)
                ->where('cancel_by', 'admin')->update([
                'cancel_by'    => null,
                "cancel_on"    => null,
                'order_status' => 'pending',
            ]);
        }
    }

    public function delivered($id)
    {
        if (can('manage order')) {
            Order::where('id', $id)
                ->where('order_status', 'pending')->update([
                'cancel_by'    => null,
                "cancel_on"    => null,
                "delivered_on" => now(),
                'order_status' => 'success',
            ]);
        }
    }

    public function mount($id)
    {
        $this->oid = $id;
    }

    public function render()
    {
        $this->order = Order::where('id', $this->oid)->with('orderDetail')->first();
        return view('livewire.admin.order.detail')
            ->layout('layouts.admin');
    }
}
