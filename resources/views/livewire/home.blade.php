@section('title')
  Home
@endsection
@section('home')
  active
@endsection

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" />
@endsection

<div class="">
  {{-- @include('partial.component-loading') --}}
  <!-- Start Slider Area -->
  <div style="height: 500px;" class="mb-4 slider__container slider--one bg__cat--3">
    @livewire('child.home-slider')
  </div>
  <!-- Start Slider Area -->

  {{-- Category Area --}}
  @livewire('child.home-categories')
  {{-- ! Category Area --}}

  @if ($bestSellers->count() > 0)

    <!-- Best Seller -->
    <div class="text-center">
      <h3 class="bigger-font f-500 text-uppercase text__primary">Best Seller</h3>
    </div>
    <div class="slide__container pb-4 mb-4 slider__activation__wrap owl-carousel product-carousel">
      @foreach ($bestSellers as $bestSeller)
        <div wire:key='{{ $bestSeller->id }}' class="single__slide animation__style01 slider__fixed--height">
          <div class="container">
            <div class="row align-items__center">
              <div class="col-md-12">
                <div class="slide">
                  <div class="slider__inner">
                    @livewire('child.single-product', ['product' => $bestSeller],
                    key('best_seller_'.$bestSeller->id))
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  @if ($featureds->count() > 0 || $trendings->count() > 0 || $discounteds->count() > 0)
    <section class="">
      <!-- Tabs navs -->
      <ul class="nav nav-tabs justify-content-center" id="ex1" role="tablist">
        @if ($featureds->count() > 0)
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="featured-link" data-mdb-toggle="tab" href="#featured" role="tab"
              aria-controls="featured" aria-selected="true">Featured</a>
          </li>
        @endif
        @if ($trendings->count() > 0)
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="trending-link" data-mdb-toggle="tab" href="#trending" role="tab"
              aria-controls="trending" aria-selected="false">Trending</a>
          </li>
        @endif
        @if ($discounteds->count() > 0)
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="discounted-link" data-mdb-toggle="tab" href="#discounted" role="tab"
              aria-controls="discounted" aria-selected="false">discounted</a>
          </li>
        @endif
      </ul>
      <!-- Tabs navs -->
      <!-- Tabs content -->
      <div class="tab-content" id="ex1-content">
        @if ($featureds->count() > 0)
          <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-link">
            <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">
              @foreach ($featureds as $featured)
                <div wire:key='{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                  <div class="container">
                    <div class="row align-items__center">
                      <div class="col-md-12">
                        <div class="slide">
                          <div class="slider__inner">
                            <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                              @livewire('child.single-product', ['product' =>
                              $featured],
                              key($loop->index))
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
        @if ($trendings->count() > 0)
          <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending-link">
            <div class="row">
              <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">
                @foreach ($trendings as $trending)
                  <div wire:key='{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                      <div class="row align-items__center">
                        <div class="col-md-12">
                          <div class="slide">
                            <div class="slider__inner">
                              <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                @livewire('child.single-product', ['product' =>
                                $trending], key($loop->index))
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endif
        @if ($discounteds->count() > 0)
          <div class="tab-pane fade" id="discounted" role="tabpanel" aria-labelledby="discounted-link">
            <div class="row">
              <div class="slide__container py-4 my-4 slider__activation__wrap owl-carousel product-carousel">

                @foreach ($discounteds as $discounted)
                  <div wire:key='{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                      <div class="row align-items__center">
                        <div class="col-md-12">
                          <div class="slide">
                            <div class="slider__inner">
                              <div class="my-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                @livewire('child.single-product', ['product' =>
                                $discounted], key($loop->index))
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endif
      </div>
      <!-- Tabs content -->
    </section>
  @endif

  {{-- Brand --}}
  <section class="">
    @livewire('child.home-brands')
  </section>
  {{-- ! Brand --}}

</div>
<script>
  document.addEventListener('livewire:load', function() {
    $(".home-slider").owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      smartSpeed: 1000,
      autoplay: true,
      navText: [
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
      ],
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      items: 1,
      dots: true,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
        },
        767: {
          items: 1,
        },
        991: {
          items: 1,
        },
      },
    });
    $(".slider__container").css("height", "100%");

    $(".product-carousel").owlCarousel({
      loop: false,
      margin: 0,
      nav: true,
      smartSpeed: 1000,
      autoplay: true,
      navText: [
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
      ],
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      items: 4,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
        },
        767: {
          items: 2,
        },
        991: {
          items: 4,
        },
      },
    });

    $(".brand-carousel").owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      smartSpeed: 1000,
      autoplay: true,
      navText: [
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-left"></i>',
        '<button class="btn btn-floating btn-light"><i class="fas fa-chevron-right"></i>',
      ],
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      items: 6,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 4,
        },
        991: {
          items: 6,
        },
      },
    });

    $(".nav-tabs .nav-item .nav-link").first().addClass('active');
    $(".tab-content .tab-pane").first().addClass('show active');
  });

</script>
@section('extra-js')
  <!-- Owl Carousel -->
  <script type="text/javascript" src="{{ asset('front/vendor/owl.carousel.min.js') }}"></script>
@endsection
