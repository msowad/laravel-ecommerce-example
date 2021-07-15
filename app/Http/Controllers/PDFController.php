<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PDF;

class PDFController extends Controller
{
    public function download($id)
    {
        $order = new Order;

        if (!isAdminLogin()) {
            $order = $order->where("user_id", auth()->id());
        }

        $order = $order->with("details")->findOrFail($id);

        return PDF::loadView('pdf.invoice', ["order" => $order])
            ->download('order_' . $order->id . '_invoice_' . time() . '.pdf');
    }
}
