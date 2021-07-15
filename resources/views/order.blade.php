@extends('layouts.app')

@section('title')
    My Order
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('front/css/nice-select2.css') }}" />
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Shop</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                My Order</button>
        </div>
    </div>

    @livewire('order')

    <script type="text/javascript">
        const niceSelect = document.querySelector(".nice-select");
        NiceSelect.bind(niceSelect);

    </script>
@endsection

@section('extra-js')
    <script type="text/javascript" src="{{ asset('front/js/nice-select2.js') }}"></script>
@endsection
