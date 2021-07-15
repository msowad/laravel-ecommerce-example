@extends('layouts.app')

@section('title')
    About Us
@endsection

@section('about-us')
    active
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Shop</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                About us</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        <h5 class="bigger-font f-500 text-uppercase text-center text-black">{{ config('app.name') }}</h5>
        <div class="my-4 p-4 about-us-text editor-text">
            {!! $aboutUs->body !!}
        </div>
    </div>
@endsection
