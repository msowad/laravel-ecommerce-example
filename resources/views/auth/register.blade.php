@extends('layouts.app')

@section('title')
    Register
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
                    Register</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="offset-md-3 col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">Register</h4>

                    <form method="POST" action="{{ route('register') }}" class="p-relative">

                        @csrf

                        <x-input value="{{ old('name') }}" autofocus name="name" />
                        <x-input value="{{ old('email') }}" type="email" name="email" />
                        <x-input value="{{ old('mobile') }}" type="tel" name="mobile" />
                        <x-input type="password" name="password" />
                        <x-input type="password" name="password_confirmation" label="Password Confirmation" />

                        @if (session()->has('status'))
                            <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
                                {{ session('status') }}
                            </h3>
                        @endif

                        <button class="btn btn-lg btn-dark btn-block">submit</button>

                        <a href="{{ route('login') }}" class="text-black smaller-font float-end mt-2">Allready Register?
                            Login</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
