@extends('layouts.app')

@section('title')
    Checkout
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>shop</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <a href="{{ route('cart') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>cart</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                Checkout</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        <div class="row  sm-flex-row-reverse">
            @if ($cartCount > 0)

                <div class="col-md-8 col-sm-12">
                    <h4 class="big-font text-uppercase text-center bg-white p-4 mb-4">Checkout</h4>

                    @livewire('child.checkout-form')

                </div>

                <div class="col-md-4 bg-white shadow-3 p-4 col-sm-12 p-relative mb-4 md-mb-0">
                    @livewire('child.checkout-items')
                </div>

            @else
                <div class="offset-md-3 p-4 col-md-6 col-sm-12 bg-white rounded-5 shadow-5-strong">
                    <div class="p-4 text-center text-uppercase text-danger">
                        <i style="font-size: 110px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        <h3 class="small-font f-500 p-4">
                            Please add some product to your card
                        </h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript" src="{{ asset('front/js/sweetalert.js') }}"></script>
@endsection
