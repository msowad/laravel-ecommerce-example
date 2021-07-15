@extends('layouts.app')

@section('title')
    Forgot Password
@endsection

@section('contents')
    <div>
        <div class="bradcaump py-4">
            <div class="container">
                <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                        class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>shop</a>
                <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                        aria-hidden="true"></i></button>
                <button class="btn btn-lg btn-transparent p-3 shadow-0">
                    Forgot Password</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="offset-md-3 col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">Forgot Password</h4>

                    <form method="POST" action="{{ route('password.request') }}" class="p-relative">

                        @csrf

                        <x-input value="{{ old('email') }}" type="email" name="email" />

                        @if (session()->has('status'))
                            <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
                                {{ session('status') }}
                            </h3>
                        @endif

                        <button class="btn btn-lg btn-dark btn-block">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
