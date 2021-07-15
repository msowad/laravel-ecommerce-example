@section('title')
  wishlist
@endsection

<div class="p-relative">
  @include('partial.component-loading')
  <div class="bradcaump py-4">
    <div class="container">
      <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
          class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>shop</a>
      <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
          aria-hidden="true"></i></button>
      <button class="btn btn-lg btn-transparent p-3 shadow-0">
        wishlist</button>
    </div>
  </div>
  <div class="container py-4 mt-4">
    @if ($wishlists->count() > 0)

      <div class="table-container">
        <table class="table table-main table-responsive table-active rounded-3">
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th class="text-right">Action</th>
          </tr>
          @foreach ($wishlists as $wishlist)
            <tr>
              <td class="image-td"><a
                  href="{{ route('product.detail', $wishlist->product->slug) . '?attribute=' . $wishlist->attribute->id }}"
                  class="btn btn-transparent p-0 shadow-0">
                  <img src="{{ $wishlist->attribute->photo->url }}" class="img-fluid">
                </a></td>
              <td>
                <h4 class="small-font f-500 text-nowrap">{{ $wishlist->product->name }}</h4>
                <p class="smaller-font">${{ $wishlist->attribute->price }}</p>
              </td>
              <td class="text-right">
                <button data-id="{{ $wishlist->id }}" class="btn btn-floating btn-light btn-sm remove-button">
                  <i class="fas fa-times"></i></button>
              </td>
            </tr>
          @endforeach

        </table>
      </div>

    @else
      @include('partial.empty-table', ["title" => "Empty wishlist"])
    @endif
  </div>
</div>

@section('extra-js')
  <script type="text/javascript" src="{{ asset('front/js/sweetalert.js') }}"></script>
  <script>
    document.addEventListener('livewire:load', () => {
      document.querySelectorAll("button.remove-button").forEach((el) => {
        el.addEventListener('click', () => {
          swal({
              title: "Are you sure?",
              text: "You can't undo this action.",
              icon: "warning",
              buttons: true,
            })
            .then((willDelete) => {
              willDelete && Livewire.emit('remove', el.getAttribute('data-id'));
            });
        });
      });
    });

  </script>
@endsection
