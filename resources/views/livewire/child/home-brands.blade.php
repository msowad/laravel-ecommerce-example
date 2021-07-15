<div>
  @if ($brands->count() > 0)
    <div class="slide__container py-4 my-4 animated-carousel slider__activation__wrap brand-carousel owl-carousel">
      @foreach ($brands as $brand)

        <div wire:key='{{ $loop->index }}' class="single__slide animation__style01 slider__fixed--height">
          <div class="container">
            <div class="row align-items__center">
              <div class="col-md-12">
                <div class="slide">
                  <div class="slider__inner">
                    <img src="{{ $brand->photo->url }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      @endforeach
    </div>

  @endif
</div>
