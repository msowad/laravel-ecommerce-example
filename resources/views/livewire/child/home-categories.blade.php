<div class="row my-4 py-4">
    @foreach ($categories as $category)
        <div wire:key='{{ $loop->index }}' class="my-4 col-lg-4 col-sm-6 col-xs-6">
            <div class="product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
                <a class="btn mb-1 btn-light p-0 shadow-0" href="{{ route('category', $category->slug) }}"><img
                        observe='true' observe-src="{{  $category->photo->url }}" class="img-fluid"
                        alt="">
                    <div style="height: 395px;" class="img-progress">
                        <div class="spinner-border text__primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </a>
                <h1 class="small-font my-3">{{ $category->name }}</h1>
                <p class="smaller-font pb-4">{{ $category->products_count }}
                    Product{{ $category->products_count > 1 ? 's' : '' }}</p>
            </div>
        </div>
    @endforeach
</div>
