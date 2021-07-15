<div class="animated-carousel slide__container slider__activation__wrap home-slider owl-carousel">
  @if ($sliders->count() > 0)
    @foreach ($sliders as $key => $slider)

      <div wire:key='{{ $key }}' class="single__slide animation__style01 slider__fixed--height">
        <div class="container">
          <div class="row align-items__center">
            <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
              <div class="slide">
                <div class="slider__inner">
                  <h2 class="big-font">{{ $slider->sub_heading }}</h2>
                  <h1>{{ $slider->heading }}</h1>
                  <a class="btn btn-lg btn-light btn__primary"
                    href="{{ $slider->link }}">{{ $slider->link_text }}</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
              <div class="slide__thumb">
                <img class="img-fluid" src="{{ $slider->photo->url }}">
              </div>
            </div>
          </div>
        </div>
      </div>

    @endforeach
  @endif
</div>
