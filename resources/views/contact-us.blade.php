@extends('layouts.app')

@section('title')
    Contact Us
@endsection

@section('contact-us')
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
                Contact Us</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div id="goggleMap">
                    {{ $myShop->map }}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <h5 class="big-font text-uppercase">Contact Us</h5>
                <div class="p-4 d-flex shadow-4 rounded-3">
                    <i class="fa fa-map-marker-alt p-4 bg__primary text-light biggest-font" aria-hidden="true"></i>
                    <div class="ml-3 align-self-center">
                        <div>
                            <h3 class="small-font text-black text-uppercase">Our Address</h3>
                            <p class="smallest-font m-0">{{ $myShop->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 d-flex shadow-4 rounded-3">
                    <i class="fa fa-envelope-open p-4 bg__primary text-light biggest-font" aria-hidden="true"></i>
                    <div class="ml-3 align-self-center">
                        <div>
                            <h3 class="small-font text-black text-uppercase">Email</h3>
                            <p class="smallest-font m-0">{{ $myShop->mail1 }}</p>
                            @if ($myShop->mail2 != '')
                                <p class="smallest-font m-0">{{ $myShop->mail2 }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-4 d-flex shadow-4 rounded-3">
                    <i class="fa fa-phone p-4 bg__primary text-light biggest-font" aria-hidden="true"></i>
                    <div class="ml-3 align-self-center">
                        <div>
                            <h3 class="small-font text-black text-uppercase">Phone</h3>
                            <p class="smallest-font m-0">{{ $myShop->mobile1 }}</p>
                            @if ($myShop->mobile2 != '')
                                <p class="smallest-font m-0">{{ $myShop->mobile2 }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="big-font text-uppercase">Send a Mail</h4>

        @livewire('child.contact-us-form')

    </div>
@endsection
