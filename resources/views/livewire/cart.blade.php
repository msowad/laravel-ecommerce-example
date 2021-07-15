@section('title')
    Cart
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
                Cart</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        @if ($carts->count() > 0)

            <div class="table-container">
                <table class="table table-main table-responsive table-active rounded-3">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th class="text-right">Action</th>
                    </tr>
                    @foreach ($carts as $cart)
                        <tr>
                            <td class="image-td"><a
                                    href="{{ route('product.detail', $cart->product->slug) . '?attribute=' . $cart->attribute->id }}"
                                    class="btn btn-transparent p-0 shadow-0">
                                    <img src="{{ $cart->attribute->photo->url }}" class="img-fluid">
                                </a></td>
                            <td>
                                <h4 class="small-font f-500 text-nowrap">{{ $cart->product->name }}</h4>
                                <p class="smaller-font">${{ $cart->attribute->price }}</p>
                            </td>
                            <td>
                                <input type="number" data-id="{{ $cart->id }}" value="{{ $cart->qty }}"
                                    max="{{ $cart->attribute->qty }}" min="1" style="width:70px;"
                                    class="form-control qty">
                            </td>

                            <td>
                                <p class="small-font text-black f-300">${{ $cart->attribute->price * $cart->qty }}</p>
                            </td>
                            <td class="text-right">
                                <button data-id="{{ $cart->id }}"
                                    class="btn btn-floating btn-light btn-sm remove-button">
                                    <i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="col-md-6 shadow-1-strong col-sm-12 offset-md-6">
                <div class="p-4 bg-light smallest-font text-uppercase">
                    <div class="d-flex justify-content-between">
                        <p>Cart total</p>
                        <p class="f-500">${{ $total }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('shop') }}" class="btn btn-lg btn-dark">
                            <i class="fa fa-chevron-left mr-3"></i>Continue Shopping
                        </a>
                        <a href="{{ route('checkout') }}" class="btn btn-lg btn-dark">
                            Checkout<i class="fa fa-chevron-right ml-3"></i></a>
                    </div>
                </div>
            </div>

        @else

            @include('partial.empty-table', ["title" => "Empty Cart"])

        @endif
    </div>
</div>

<script>
    document.querySelectorAll("input.qty").forEach((el) => {
        el.addEventListener('change', () => {
            Livewire.emit('updateQty', el.getAttribute('data-id'), el.value);
        });
    });

    document.querySelectorAll("button.remove-button").forEach((el) => {
        el.addEventListener('click', () => {
            swal({
                    title: "Are you sure?",
                    text: "You can't undo this action.",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    willDelete && Livewire.emit('delete', el.getAttribute('data-id'));
                });
        });
    });

</script>

@section('extra-js')
    <script type="text/javascript" src="{{ asset('front/js/sweetalert.js') }}"></script>
@endsection
