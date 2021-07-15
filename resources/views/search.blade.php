@extends('layouts.app')

@section('title')
    Search - {{ $term }}
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
                    {{ $term }}</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        @if ($product->onSaleAttributes->count() > 0)
                            <div class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                @livewire('child.single-product', ['product' => $product], key(time().$product->id))
                            </div>
                        @endif
                    @endforeach
                @else

                    <div class="offset-md-3 p-4 col-md-6 col-sm-12 bg-white rounded-5 shadow-5-strong">
                        <div class="p-4 text-center text-uppercase text-danger">
                            <i style="font-size: 110px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <h3 class="small-font f-500 p-4">
                                No products found with "{{ $term }}"
                            </h3>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection
