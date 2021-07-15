<?php

namespace App\Http\Livewire\Admin\Order;

use App\Admin\WithAdminDataTable;
use App\Models\Order;
use Livewire\Component;

class DataTable extends Component
{
    public $that  = 'order';
    public $model = 'Order';

    public $cancelBy = 'all';
    public $cancelOnFrom;
    public $cancelOnTo;
    public $deliveredOnFrom;
    public $deliveredOnTo;

    public $paymentSuccess;
    public $paymentPending;
    public $orderSuccess;
    public $orderPending;
    public $orderCanceled;

    use WithAdminDataTable;

    protected $queryString;

    public function __construct()
    {
        $this->queryStringArr = array_merge($this->queryStringArr, [
            'cancelBy'        => ['except' => 'all'],
            'cancelOnFrom'    => ['except' => null],
            'cancelOnTo'      => ['except' => null],
            'deliveredOnFrom' => ['except' => null],
            'deliveredOnTo'   => ['except' => null],
            'paymentSuccess'  => ['except' => false],
            'paymentPending'  => ['except' => false],
            'orderSuccess'    => ['except' => false],
            'orderPending'    => ['except' => false],
            'orderCanceled'   => ['except' => false],
        ]);

        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();
    }

    public function updatedCancelOnFrom()
    {
        $this->cancelOnFrom = '' != $this->cancelOnTo ? ($this->cancelOnFrom > $this->cancelOnTo ? $this->cancelOnTo : $this->cancelOnFrom)
        : ($this->cancelOnFrom > date('Y-m-d') ? date('Y-m-d') : $this->cancelOnFrom);
    }

    public function updatedCancelOnTo()
    {
        $this->cancelOnTo   = $this->cancelOnTo > date('Y-m-d') ? date('Y-m-d') : $this->cancelOnTo;
        $this->cancelOnFrom = '' != $this->cancelOnTo ? ($this->cancelOnFrom > $this->cancelOnTo ? $this->cancelOnTo : $this->cancelOnFrom)
        : $this->cancelOnFrom;
    }

    public function updatedDeliveredOnFrom()
    {
        $this->deliveredOnFrom = '' != $this->deliveredOnTo ? ($this->deliveredOnFrom > $this->deliveredOnTo ? $this->deliveredOnTo : $this->deliveredOnFrom)
        : ($this->deliveredOnFrom > date('Y-m-d') ? date('Y-m-d') : $this->deliveredOnFrom);
    }

    public function updatedDeliveredOnTo()
    {
        $this->deliveredOnTo   = $this->deliveredOnTo > date('Y-m-d') ? date('Y-m-d') : $this->deliveredOnTo;
        $this->deliveredOnFrom = '' != $this->deliveredOnTo ? ($this->deliveredOnFrom > $this->deliveredOnTo ? $this->deliveredOnTo : $this->deliveredOnFrom)
        : $this->deliveredOnFrom;
    }

    public function cancel($id)
    {
        if (can('manage order')) {
            Order::where('id', $id)->where('order_status', '!=', 'success')
                ->where('order_status', '!=', 'waiting')
                ->where('cancel_by', null)->update([
                'cancel_by'    => 'admin',
                "cancel_on"    => now(),
                'order_status' => 'canceled',
            ]);
        }
    }

    public function cancelChecked()
    {
        if (can('manage order')) {
            $this->obj->whereIn('id', $this->selected)
                ->where('order_status', '!=', 'success')
                ->where('order_status', '!=', 'waiting')
                ->where('cancel_by', null)->update([
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

    public function reOrderChecked()
    {
        if (can('manage order')) {
            $this->obj->whereIn('id', $this->selected)
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
                ->where('order_status', 'pending')
                ->update([
                    'cancel_by'    => null,
                    "cancel_on"    => null,
                    "delivered_on" => now(),
                    'order_status' => 'success',
                ]);
        }
    }

    public function deliveredChecked()
    {
        if (can('manage order')) {
            $this->obj->whereIn('id', $this->selected)
                ->where('order_status', 'pending')->update([
                'cancel_by'    => null,
                "cancel_on"    => null,
                "delivered_on" => now(),
                'order_status' => 'success',
            ]);
        }
    }

    public function selectAll()
    {
        if (false == $this->isAllSelect) {
            $this->selected = true == $this->onlyTrashed ? $this->getModelProperty(false)->map(fn($id) => (string) $id)
            : $this->getModelProperty(false)->map(fn($id) => (string) $id);
            $this->isAllSelect = true;
            $this->selectPage  = true;
        } else {
            $this->clearSelected();
        }
    }

    public function clear($of)
    {
        switch ($of) {
            case 'all':
                $this->reset(['cancelBy', 'cancelOnFrom', 'cancelOnTo', 'deliveredOnFrom', 'deliveredOnTo', 'paymentSuccess', 'paymentPending', 'orderSuccess', 'orderPending', 'orderCanceled']);
                $this->clearBasicAll();
                break;
            case 'cancelBy':
                $this->reset('cancelBy');
                break;
            case 'cancelOnFrom':
                $this->reset('cancelOnFrom');
                break;
            case 'cancelOnTo':
                $this->reset('cancelOnTo');
                break;
            case 'deliveredOnFrom':
                $this->reset('deliveredOnFrom');
                break;
            case 'deliveredOnTo':
                $this->reset('deliveredOnTo');
            case 'paymentSuccess':
                $this->reset('paymentSuccess');
            case 'paymentPending':
                $this->reset('paymentPending');
            case 'orderSuccess':
                $this->reset('orderSuccess');
            case 'orderPending':
                $this->reset('orderPending');
            case 'orderCanceled':
                $this->reset('orderCanceled');
        }
        $this->clearBasic($of);
    }

    public function getModelProperty($paginate = true)
    {
        $obj = $this->obj;
        $qry = $obj->where(function ($query) {
            $query->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('mobile', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orWhere('city', 'like', '%' . $this->search . '%')
                ->orWhere('state', 'like', '%' . $this->search . '%')
                ->orWhere('company', 'like', '%' . $this->search . '%')
                ->orWhere('zip', 'like', '%' . $this->search . '%')
                ->orWhere('total_price', 'like', '%' . $this->search . '%')
                ->orWhere('coupon', 'like', '%' . $this->search . '%')
                ->orWhere('tax', 'like', '%' . $this->search . '%')
                ->orWhere('final_price', 'like', '%' . $this->search . '%')
                ->orWhere('payment_status', 'like', '%' . $this->search . '%')
                ->orWhere('order_status', 'like', '%' . $this->search . '%')
                ->orWhere('cancel_by', 'like', '%' . $this->search . '%')
                ->orWhere('cancel_on', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });

        if ('true' == $this->orderCanceled) {
            $qry->where('order_status', 'canceled');
        }

        if ('true' == $this->orderSuccess) {
            $qry->where('order_status', 'success');
        }

        if ('true' == $this->orderPending) {
            $qry->where('order_status', 'pending');
        }

        if ('true' == $this->paymentPending) {
            $qry->where('payment_status', 'pending');
        }

        if ('true' == $this->paymentSuccess) {
            $qry->where('payment_status', 'success');
        }

        if ('allcanceled' == $this->cancelBy) {
            $qry->where('cancel_by', '!=', '');
        }

        if ('admin' == $this->cancelBy) {
            $qry->where('cancel_by', 'admin');
        }

        if ('user' == $this->cancelBy) {
            $qry->where('cancel_by', '!=', '')->where('cancel_by', '!=', 'admin');
        }

        $this->deliveredOnFrom != ''
        ? $qry->where('delivered_on', '>=', $this->deliveredOnFrom . ' 00:00:00') : '';'' != $this->deliveredOnTo ? $qry->where('delivered_on', '<=', $this->addedOnTo . ' 23:59:59') : '';'' != $this->cancelOnFrom ? $qry->where('cancel_on', '>=', $this->cancelOnFrom . ' 00:00:00') : '';'' != $this->cancelOnTo ? $qry->where('cancel_on', '<=', $this->cancelOnTo . ' 23:59:59') : '';

        return $this->getCommonModalProperty($qry, $paginate);
    }

    public function render()
    {
        $this->getCacheData();
        $items = $this->getModelProperty();

        return view('livewire.admin.' . $this->that . '.data-table', compact('items', $items))
            ->layout('layouts.admin');
    }
}
