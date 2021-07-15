<?php

namespace App\Http\Controllers;

use App\Models\AboutsUs;
use App\Models\Cart as ModelsCart;
use App\Models\Category;
use App\Models\MyShop;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Notification;

class FrontController extends Controller
{
    public function search($term)
    {
        $products = Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where(function ($qry) use ($term) {
                $qry->where('name', 'like', '%' . $term . '%')
                    ->orWhere('slug', 'like', '%' . $term . '%')
                    ->orWhere('model', 'like', '%' . $term . '%')
                    ->orWhere('short_description', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%')
                    ->orWhere('keywords', 'like', '%' . $term . '%')
                    ->orWhere('technical_specification', 'like', '%' . $term . '%')
                    ->orWhere('usage', 'like', '%' . $term . '%')
                    ->orWhere('warrenty', 'like', '%' . $term . '%')
                    ->orWhereHas('category', function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->where('status', 1)
                            ->orWhere('slug', 'like', '%' . $term . '%');
                    })->orWhereHas('brand', function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->where('status', 1)
                        ->orWhere('slug', 'like', '%' . $term . '%');
                });
            })
            ->get();

        return view('search', ['products' => $products, 'term' => $term]);
    }

    public function shop()
    {
        $categories = Category::withCount('products')
            ->with('photo')
            ->has('products')
            ->where('status', 1)
            ->where('in_home_page', 1)
            ->whereHas('photo')
            ->orderBy('products_count', 'desc')
            ->get();

        return view('shop', ['categories' => $categories]);
    }

    public function profile()
    {
        return view('profile');
    }

    public function checkout()
    {
        $cartCount = ModelsCart::where('user_id', userId())->count();
        return view('checkout', ['cartCount' => $cartCount]);
    }

    public function aboutUs()
    {
        $aboutUs = AboutsUs::first();

        return view('about-us', ['aboutUs' => $aboutUs]);
    }

    public function contactUs()
    {
        $myShop = MyShop::first();

        return view('contact-us', ['myShop' => $myShop]);
    }

    public function verify($code)
    {
        $user = User::where('verification_code', $code)->firstOrFail();

        $user->email_verified_at = date('Y-m-d h:m:s');

        $user->save();

        $orders = Order::where("user_id", $user->id)
            ->where("order_status", "waiting")
            ->get(["id"]);

        foreach ($orders as $order) {
            $order->update(["order_status" => "pending"]);

            $data = ["name" => auth()->user()->name, "link" => route("order.detail", $order->id)];
            Notification::send(auth()->user(), new OrderPlaced($data));
        }

        return view('verify', ["order" => $orders->count()]);
    }

    public function order()
    {
        return view('order');
    }

    public function orderDetail($id)
    {
        $order = Order::where('id', $id)->with('orderDetail')->first();

        return view('order-detail', ['order' => $order]);
    }
}
