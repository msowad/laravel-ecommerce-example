<div>

    @include('partial.component-loading')

    <h5 class="smaller-font text-uppercase text-center mb-4">your Order</h5>

    @foreach ($carts as $cart)
        <div class="my-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('product.detail', $cart->product->slug) . '?attribute=' . $cart->attribute->id }}"
                class="btn btn-transparent p-0 shadow-0">
                <img src="{{ $cart->attribute->photo->url }}" alt="" width="60px" class="img-fluid">
            </a>
            <div class="">
                <p class="smallest-font mb-0">{{ $cart->product->name }}({{ $cart->qty }})</p>
                <p class="smallest-font f-500 m-0">${{ $cart->attribute->price * $cart->qty }}</p>
            </div>
            <button data-id="{{ $cart->id }}" class="remove-button btn btn-floating shadow-0 btn-transparent">
                <i class="fa fa-trash-alt" aria-hidden="true"></i>
            </button>
        </div>
    @endforeach
    <div class="mt-4 text-uppercase">
        <div class="d-flex justify-content-between">
            <p>Cart Sub Total</p>
            <p class="f-500">${{ $subTotal }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p>TAX</p>
            <p class="f-500">${{ $this->tax }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p>Shipping</p>
            <p class="f-500">$0.00</p>
        </div>

        @if ($appliedCouponExtra > 0)
            <div class="d-flex justify-content-between">
                <p>Coupon Extra</p>
                <p class="f-500">${{ $appliedCouponExtra }}</p>
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-between">
            <p>Total</p>
            <p class="f-500">${{ $total }}</p>
        </div>
        <div>
            <form wire:submit.prevent='submit' class="d-flex">
                <input placeholder="apply coupon" wire:model.defer="coupon" type="text" class="form-control">
                <button class="btn btn-dark">Ok</button>
            </form>
            @error('coupon')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session()->has('success_msg'))
                <p class="text-success">{{ session('success_msg') }}</p>
            @endif
            @if (session()->has('error_msg'))
                <p class="text-danger">{{ session('error_msg') }}</p>
            @endif
        </div>
    </div>

</div>


<script>
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
