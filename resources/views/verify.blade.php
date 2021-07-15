@extends('layouts.app')

@section('title')
    Verify
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                    class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Shop</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                Verify</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        <div class="row">
            <div class="col-md-4 col-sm-8 offset-sm-2 bg-success text-light rounded-3 shadow-5 offset-md-4 text-center p-4">
                <div class="w-100 p-4">
                    <i style="font-size: 100px;" class="mb-3 fas fa-check-circle"></i>
                    <p class="big-font">
                        Email Verified
                        @if ($order > 0)
                            And Order has been successfully placed
                        @endif.
                    </p>
                    @guest
                        <a href="{{ route('login', 'redirect_to=order') }}" class="btn btn-light">Login now
                            <i class="fas ml-2 fa-arrow-right"></i>
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('order') }}" class="btn btn-light">Go to my order
                            <i class="fas ml-2 fa-arrow-right"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
