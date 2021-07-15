@extends('layouts.app')

@section('title')
    Reset Password
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
                    Reset Password</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="offset-md-3 col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">Forgot Password</h4>

                    <form method="POST" action="{{ url('/reset-password') }}" class="p-relative">

                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <x-input name='email' type='email' value="{{ old('email', $request->email) }}" />
                        <x-input name='password' type='password' label="New Password" />
                        <x-input name='password_confirmation' label='Password Confirmation' type='password' />

                        <button class="btn btn-lg btn-dark btn-block">update password</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
