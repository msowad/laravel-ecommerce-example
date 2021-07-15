@extends('layouts.app')

@section('title')
    Verify Email
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
                    Verify Email</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="offset-md-3 col-md-6 col-sm-12">
                    <form method="POST" action="{{ route('verification.send') }}" class="p-relative">
                        @csrf

                        <div class="p-4 bg-white rounded-5 shadow-5-strong mb-4">
                            <div class="p-4 text-center text-uppercase text-danger">
                                <i style="font-size: 110px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                <h3 class="small-font f-500 p-4">
                                    You need to verify your email to access this page.
                                </h3>
                            </div>
                        </div>


                        @if (session()->has('status') == 'verification-link-sent')
                            <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
                                We have send verification link to your email. Check your email.
                            </h3>
                        @endif

                        <button class="btn btn-lg btn-dark btn-block">resend email</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
