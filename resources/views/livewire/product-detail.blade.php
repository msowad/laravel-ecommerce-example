@section('title')
  {{ $product->name }}
@endsection
<div>
  <div class="p-relative">
    @include('partial.component-loading')
    <div class="bradcaump py-4">
      <div class="container">
        <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
            class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Shop</a>
        <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
            aria-hidden="true"></i></button>
        <button class="btn btn-lg btn-transparent p-3 shadow-0">
          Product detail</button>
      </div>
    </div>

    @livewire('child.product-detail-partial', ['product' => $product])

  </div>
  <div class="mt-4 pt-4 product-detail-detail">
    <h5 class="small-font text__primary text-decoration-underline text-uppercase">Description</h5>
    <div class="readall-text editor-text">
      {!! $product->description !!}
    </div>
  </div>
  @if ($product->technical_specification != '')
    <div class="pt-4 product-detail-detail">
      <h5 class="small-font text__primary text-decoration-underline text-uppercase">Technical Specification</h5>
      <div class="readall-text editor-text">
        {!! $product->technical_specification !!}
      </div>
    </div>
  @endif
  @if ($product->usage != '')
    <div class="pt-4 product-detail-detail">
      <h5 class="small-font text__primary text-decoration-underline text-uppercase">Usage</h5>
      <div class="readall-text editor-text">
        {!! $product->usage !!}
      </div>
    </div>
  @endif
  @if ($product->warrenty != '')
    <div class="pt-4 product-detail-detail">
      <h5 class="small-font text__primary text-decoration-underline text-uppercase">Warrenty</h5>
      <div class="readall-text editor-text">
        {!! $product->warrenty !!}
      </div>
    </div>
  @endif

  <div class="mt-4 pt-4 product-detail-detail">
    <h5 class="small-font text__primary text-decoration-underline text-uppercase">Rating and review</h5>
    <div class="my-4 py-4">
      <div class="col-md-12 col-sm-12">
        <h4 class="small-font mb-2">User Rating</h4>
        @for ($i = 1; $i <= 5; $i++)
          <div class="d-flex stars mb-2 mt-1 align-items-center">
            @include('partial.star',['star' => $i])
            <h4 class="small-font text-black mb-0 f-500 ml-4">{{ $rate[$i] }}</h4>
          </div>
        @endfor
      </div>
      <div class="col-md-12 col-sm-12 mt-4 py-4">
        <h4 class="small-font mb-4">Has {{ $reviews->count() }}
          {{ $reviews->count() > 1 ? 'reviews' : 'review' }}
        </h4>
        @foreach ($reviews as $review)
          <div class="my-2">
            <div class="review-detail">
              <div class="d-flex mb-1 justify-content-between">
                <div class="d-flex align-items-center">
                  <button
                    class="btn btn-floating mr-3 btn-dark btn-lg">{{ substr($review->user->name, 0, 1) }}</button>
                  <div>
                    <p class="small-font m-0">{{ $review->user->name }}</p>
                    @include('partial.star',['star' => $review->rate])
                  </div>
                </div>
                <span class="f-500 smaller-font">{{ $review->created_at->diffForHumans() }}</span>
              </div>
              <p class="small-font mt-1 ml-4 w-100">{{ $review->comment }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<script>
  $(".readall-text").readall({
    showheight: 120,
    showrows: 3
  });

  $(".readall-button").click(function() {
    let isHide = $(this).prev('.readall').hasClass('readall-hide');
    if (isHide) {
      let offset = $(this).parent().offset()
      $(window).scrollTop(offset.top - 120, 100);
    }
  })

</script>
@push('extra-js')
  <script type="text/javascript" src="{{ asset('front/vendor/readmore/jquery.readall.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front/vendor/readmore/jquery.readall.min.js') }}"></script>
@endpush
