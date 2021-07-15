@extends('layouts.app')

@section('title')
    Order Detial
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('order') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-history mr-2" aria-hidden="true"></i>Order</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                Order detial</button>
        </div>
    </div>
    <div class="container py-2">

        @if (session()->has('order_placed') && auth()->user()->email_verified_at)
            <h3 class="mb-4 py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
                {{ session('order_placed') }}
            </h3>
        @endif

        <div class="row mb-4 pb-4 text-black">
            <div class="col-md-6 col-sm-6">
                <p class="f-500 small-font my-0">#{{ $order->id }}</p>
                <p class="f-500 small-font my-0">{{ dataTableDate($order->created_at) }}</p>
                <p class="f-500 small-font my-0">{{ dataTableTime($order->created_at) }}</p>
            </div>
            <div class="col-md- col-sm-6 text-right">
                <p class="f-500 small-font my-0">{{ $order->name }}</p>
                <p class="f-500 small-font my-0">{{ $order->email }}</p>
                <p class="f-500 small-font my-0">{{ $order->city }}, {{ $order->state }}</p>
                <p class="f-500 small-font my-0">{{ $order->address }}({{ $order->zip }})</p>
            </div>
        </div>
        <div class="table-container">
            @livewire('order-detail', ['orders' => $order->orderDetail])
        </div>
        <div class="col-md-6 shadow-1-strong col-sm-12 offset-md-6">
            <h4 class="bg__primary p-3 small-font text-light f-500 text-uppercase">Total</h4>
            <div class="p-4 bg-light smallest-font text-uppercase">
                <div class="d-flex justify-content-between">
                    <p>total</p>
                    <p class="f-500">${{ $order->total_price }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>TAX</p>
                    <p class="f-500">${{ $order->tax }}</p>
                </div>
                @if ($order->tax + $order->total_price - $order->final_price > 0)
                    <div class="d-flex justify-content-between">
                        <p>Discount</p>
                        <p class="f-500">${{ $order->tax + $order->total_price - $order->final_price }}</p>
                    </div>
                @endif
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Final price</p>
                    <p class="f-500">${{ $order->final_price }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
