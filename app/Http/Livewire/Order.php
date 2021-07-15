<?php

namespace App\Http\Livewire;

use App\Models\Order as ModelsOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;

    public $sort        = "new";
    public $perPage     = 10;
    public $sortedField = 'id';
    public $sortedOrder = 'desc';

    protected $queryString = [
        'sort'    => ['except' => 'new'],
        'perPage' => ['except' => 10],
    ];

    public function updatedSort()
    {
        if ('low' == $this->sort) {
            $this->sortedFiled = 'price';
            $this->sortedOrder = 'desc';
        } elseif ('high' == $this->sort) {
            $this->sortedFiled = 'price';
            $this->sortedOrder = 'asc';
        } elseif ('old' == $this->sort) {
            $this->sortedFiled = 'id';
            $this->sortedOrder = 'asc';
        } else {
            $this->sortedFiled = 'id';
            $this->sortedOrder = 'desc';
        }
    }

    public function cancelOrder($id)
    {
        ModelsOrder::where("id", $id)
            ->where('order_status', '!=', 'success')
            ->where('order_status', '!=', 'waiting')
            ->update([
                'cancel_by'    => auth()->user()->name,
                'cancel_on'    => now(),
                'order_status' => 'canceled',
            ]);
    }

    public function reOrder($id)
    {
        ModelsOrder::where("id", $id)
            ->where('order_status', '!=', 'success')
            ->where('cancel_by', '!=', 'admin')
            ->where('cancel_by', '!=', null)
            ->update([
                'cancel_by'    => null,
                'cancel_on'    => null,
                'order_status' => auth()->user()->email_verified_at ? 'pending' : 'waiting',
            ]);
    }

    public function resendCode()
    {
        resendVerifyCode();
    }

    public function render()
    {
        $this->updatedSort();
        $orders = ModelsOrder::where('user_id', auth()->id())
            ->with('orderDetail')
            ->orderBy($this->sortedField, $this->sortedOrder)
            ->paginate($this->perPage);

        return view('livewire.order', ['orders' => $orders]);
    }
}
