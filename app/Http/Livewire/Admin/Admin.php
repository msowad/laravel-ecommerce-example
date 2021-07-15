<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Admin extends Component
{
    public $totalEarning;
    public $totalOrder;
    public $userCancelOrder;
    public $pendingPayment;
    public $months;
    public $earnings;
    public $orders;
    public $deliveredOrders;
    public $canceledOrders;
    public $items;
    public $users;
    public $item;
    public $totalUser;

    public function mount()
    {
        $permissions = Permission::all()->toArray();
        if (!auth()->user()->hasAnyPermission($permissions)) {
            abort(404);
        }

        if (can('view dashboard')) {
            $y     = date('Y');
            $m     = date('m');
            $days  = $this->daysInMonth($m, $y);
            $end   = $y . '-' . $m . '-' . $days . ' 23:59:59';
            $start = $y . '-' . $m . '-1 00:00:00';
            if ($m < 12) {
                for ($j = $m + 1, $k = 1; $j <= 12; $j++, $k++) {
                    $pre_y                     = $y - 1;
                    $days                      = $this->daysInMonth($j, $pre_y);
                    $end                       = $pre_y . '-' . $j . '-' . $days . ' 23:59:59';
                    $start                     = $pre_y . '-' . $j . '-1 00:00:00';
                    $total_e                   = $this->sellSnglMonTotal($start, $end);
                    $total_u                   = $this->userSnglMonTotal($start, $end);
                    $total_o                   = $this->orderSnglMonTotal($start, $end);
                    $total_d                   = $this->orderDeliveredSnglMonTotal($start, $end);
                    $total_c                   = $this->orderCancledSnglMonTotal($start, $end);
                    $total_i                   = $this->itemSnglMonTotal($start, $end);
                    $month                     = date('M', strtotime($end));
                    $this->months[$k]          = $month;
                    $this->earnings[$k]        = $total_e;
                    $this->orders[$k]          = $total_o;
                    $this->deliveredOrders[$k] = $total_d;
                    $this->canceledOrders[$k]  = $total_c;
                    $this->users[$k]           = $total_u;
                    $this->items[$k]           = $total_i;
                }
            }

            for ($i = 1, $k = $k; $i <= $m; $i++, $k++) {
                $days                      = $this->daysInMonth($i, $y);
                $end                       = $y . '-' . $i . '-' . $days . ' 23:59:59';
                $start                     = $y . '-' . $i . '-1 00:00:00';
                $total_e                   = $this->sellSnglMonTotal($start, $end);
                $total_u                   = $this->userSnglMonTotal($start, $end);
                $total_o                   = $this->orderSnglMonTotal($start, $end);
                $total_d                   = $this->orderDeliveredSnglMonTotal($start, $end);
                $total_c                   = $this->orderCancledSnglMonTotal($start, $end);
                $total_i                   = $this->itemSnglMonTotal($start, $end);
                $month                     = date('M', strtotime($end));
                $this->months[$k]          = $month;
                $this->earnings[$k]        = $total_e;
                $this->orders[$k]          = $total_o;
                $this->deliveredOrders[$k] = $total_d;
                $this->canceledOrders[$k]  = $total_c;
                $this->users[$k]           = $total_u;
                $this->items[$k]           = $total_i;
            }

            $order = new Order();

            $this->totalEarning = $order->where('created_at', '>=', $start)->where('created_at', '<=', $end)
                ->where('payment_status', 'success')
                ->sum('final_price');

            $this->totalOrder = $order->where('created_at', '>=', $start)->where('created_at', '<=', $end)
                ->where('order_status', 'success')
                ->count();

            $this->userCancelOrder = $order->where('created_at', '>=', $start)->where('created_at', '<=', $end)
                ->where('cancel_by', '!=', null)
                ->where('cancel_by', '!=', 'admin')->count();

            $this->pendingPayment = $order->where('created_at', '>=', $start)->where('created_at', '<=', $end)
                ->where('payment_status', 'pending')->sum('final_price');

            $this->totalUser = User::where('email_verified_at', '!=', null)->count();
            $this->item      = Product::count();
        }
    }

    private function daysInMonth($month, $year)
    {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    public function sellSnglMonTotal($start, $end)
    {
        return Order::where('created_at', '>=', $start)->where('created_at', '<=', $end)
            ->where('payment_status', 'success')
            ->sum('final_price');
    }

    public function orderSnglMonTotal($start, $end)
    {
        return Order::where('created_at', '>=', $start)
            ->where('created_at', '<=', $end)
            ->count();
    }

    public function userSnglMonTotal($start, $end)
    {
        return User::where('created_at', '>=', $start)->where('created_at', '<=', $end)
            ->where('email_verified_at', '!=', null)->count();
    }

    public function orderDeliveredSnglMonTotal($start, $end)
    {
        return Order::where('created_at', '>=', $start)->where('created_at', '<=', $end)
            ->where('order_status', 'success')->count();
    }

    public function itemSnglMonTotal($start, $end)
    {
        return Product::where('created_at', '>=', $start)->where('created_at', '<=', $end)->count();
    }

    public function orderCancledSnglMonTotal($start, $end)
    {
        return Order::where('created_at', '>=', $start)->where('created_at', '<=', $end)
            ->where('order_status', 'canceled')->count();
    }

    public function render()
    {
        return view('livewire.admin.admin')
            ->layout('layouts.admin');
    }
}
