<div class="product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
    <div wire:loading.delay.class='show' class="single-product-progress-spin w-100 d-flex justify-content-center z-11">
        <div class="spinner-border text__primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if (session()->has('product_success_msg'))
        <div class="message bg-secondary text-light p-2 text-uppercase f-500 smaller-font">
            {{ session('product_success_msg') }}
        </div>
    @endif
    @if (session()->has('product_error_msg'))
        <div class="message bg-danger text-light p-2 text-uppercase f-500 smaller-font">
            {{ session('product_error_msg') }}
        </div>
    @endif
    <button wire:click='addToCart' class="btn-product btn-cart btn btn-light btn-lg btn-floating">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i></button>

    <button wire:click="addTowishlist" class="btn-product btn-whislist btn btn-light btn-lg btn-floating">
        <i class="fa fa-heart" aria-hidden="true"></i></button>

    <a class="btn mb-2 btn-light p-0 shadow-0"
        href="{{ route('product.detail', [$product->slug, 'attribute=' . $product->onSaleAttributes->first()->id]) }}">
        <img observe="true" observe-src="{{ $product->onSaleAttributes->first()->photo->url }}"
            class="img-fluid my-4" alt="">
        <div style="height: 255px;" class="img-progress">
            <div class="spinner-border text__primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </a>
    <h1 class="small-font">{{ $product->name }}</h1>

    <div class="d-flex stars mb-2 justify-content-center">
        @include('partial.star',['star' => $rate])
    </div>

    <div class="h-25px d-flex justify-content-center">
        <p class="text-line-through smaller-font f-500 mr-3 text-gray">${{ $product->onSaleAttributes->first()->mrp }}
        </p>
        <p class="smaller-font text-black f-600">${{ $product->onSaleAttributes->first()->price }}</p>
    </div>
    <p class="smaller-font pb-3 {{ $moreAttr > 0 ? 'text-black' : 'invisible' }}">{{ $moreAttr }} more
        attribute{{ $moreAttr > 1 ? 's' : '' }}</p>
</div>
