<div class="row p-relative">
    @include('partial.component-loading')
    <div class="product-detail-images col-md-5 col-sm-12">

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            @foreach ($product->details as $attr)
                <div class="tab-pane fade {{ $attr->id == $attribute ? 'show active' : '' }}" id="img{{ $attr->id }}"
                    role="tabpanel" aria-labelledby="img{{ $attr->id }}">
                    <img observe="true" observe-src="{{ $attr->photo->url }}" class="img-fluid" alt="">
                    <div style="height: 450px;" class="img-progress">
                        <div class="spinner-border text__primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Tabs content -->

        <!-- Tabs navs -->
        <ul class="nav nav-tabs d-flex mb-3 justify-content-center mt-4" id="ex1" role="tablist">
            @foreach ($product->details as $attr)
                <li class="nav-item" role="presentation">
                    <a wire:click='attribute({{ $attr->id }})'
                        class="nav-link {{ $attr->id == $attribute ? 'active' : '' }} btn p-0 btn-transparent"
                        id="img-link{{ $attr->id }}" data-mdb-toggle="tab" href="#img{{ $attr->id }}" role="tab"
                        aria-selected="true">
                        <img observe="true" observe-src="{{ $attr->photo->url }}" class="img-fluid"
                            alt="">
                        <div style="height: 10px;" class="img-progress">
                            <div class="spinner-border text__primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <!-- Tabs navs -->
    </div>

    <div class="col-md-7 col-sm-12">
        <h5 class="small-font text-uppercase text-black">
            {{ $product->name }}
        </h5>

        <div class="d-flex stars mb-2">
            @include('partial.star',['star' => $rate])
        </div>

        <div class="d-flex">
            <p class="smaller-font mr-3 text-gray text-line-through">${{ $attributeArr->price }}
            </p>
            <p class="smaller-font text-black">${{ $attributeArr->price }}</p>
        </div>

        <div class="mb-2 editor-text">
            {!! $product->short_description !!}
        </div>

        <p class="mb-2 smaller-font text-black f-400"><span class="f-600">Avalivality:</span> In Stock</p>
        <p class="mb-2 smaller-font text-black f-400"><span class="f-600">Category:
            </span>{{ $product->category->name }}</p>
        <p class="mb-2 smaller-font text-black f-400"><span class="f-600">Brand: </span>{{ $product->brand->name }}</p>
        @if ($product->model != '')
            <p class="mb-2 smaller-font text-black f-400"><span class="f-600">Model: </span>{{ $product->model }}</p>
        @endif
        @if ($product->keywords != '')
            <p class="mb-3 smaller-font text-black f-400"><span class="f-600">Keywords:</span> {{ $product->keywords }}
            </p>
        @endif

        <div class="d-flex mt-1">
            <p style="margin-right: 28px;" class="smaller-font text-black f-600">Size:</p>
            @foreach ($product->details as $attr)
                <button wire:click='attribute({{ $attr->id }})'
                    class="btn btn-floating mr-2 btn-sm btn-dark {{ $attr->id == $attribute ? 'attr-active' : '' }}">{{ $attr->size->size }}</button>
            @endforeach
        </div>

        <div class="d-flex mt-1">
            <p class="smaller-font mr-3 text-black f-600">Color:</p>
            @foreach ($product->details as $attr)
                <button wire:click='attribute({{ $attr->id }})'
                    class="btn mr-2 btn-floating btn-sm {{ $attr->id == $attribute ? 'attr-active' : '' }}"
                    style="background: {{ $attr->color->value }};"></button>
            @endforeach
        </div>
        <div class="d-flex align-items-center mb-1">
            <p class="smaller-font mr-3 mt-2 text-black f-600">Quantity: </p>
            <input type="number" style="width: 80px;" wire:model.defer="qty" min="1" max="{{ $attributeArr->qty }}"
                class="form-control py-1 px-3 bg-transparent">
        </div>
        <button wire:click="addToCart" class="btn btn-dark rounded-0">Add to
            cart</button>
        <button wire:click="addTowishlist" class="btn btn__primary rounded-0">Add to wishlist</button>

        @if (session()->has('product_success_msg'))
            <p class="py-2 px-4 mt-2 bg-secondary text-light">{{ session('product_success_msg') }}</p>
        @endif
        @if (session()->has('product_error_msg'))
            <p class="py-2 px-4 mt-2 bg-danger text-light">{{ session('product_error_msg') }}</p>
        @endif
    </div>
</div>
