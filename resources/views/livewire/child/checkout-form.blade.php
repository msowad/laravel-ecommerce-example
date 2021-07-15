<form class="p-relative" id="checkoutForm" wire:submit.prevent='$emit("formSubmit")'>

    @include('partial.component-loading')

    @guest
        <a href="{{ route('login', 'redirect_to=checkout') }}" class="btn btn__primary mb-3 rounded-0">Login</a>

        <p class="small-font">OR,</p>
    @endguest

    <div class="form-group mb-3 row">
        <div class="col-6">
            <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
            <input wire:model.defer="name" type="text" id="name" class="form-control input-control">
            @error('name')
                <p class="text-danger smaller-font">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6">
            <label class="form-label">Email<span class="text-danger">*</span></label>
            <input wire:model.defer="email" type="email" class="form-control input-control">
            @error('email')
                <p class="text-danger smaller-font">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group mb-3 row">
        <div class="col-6">
            <label class="form-label">Mobile<span class="text-danger">*</span></label>
            <input wire:model.defer="mobile" type="tel" placeholder="" class="form-control input-control">
            @error('mobile')
                <p class="text-danger smaller-font">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6">
            <label class="form-label">Zip<span class="text-danger">*</span></label>
            <input id="zip" wire:model.defer="zip" type="number" class="input-control form-control">
            @error('zip')
                <p class="text-danger smaller-font">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Address<span class="text-danger">*</span></label>
        <input id="address" wire:model.defer="address" type="text" class="form-control input-control">
        @error('address')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="form-label">City<span class="text-danger">*</span></label>
        <input id="city" wire:model.defer="city" type="text" class="form-control input-control">
        @error('city')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="form-label">State<span class="text-danger">*</span></label>
        <input id="state" wire:model.defer="state" type="text" class="form-control input-control">
        @error('state')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Company</label>
        <input wire:model.defer="company" autofocus type="text" class="form-control input-control">
        @error('company')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>

    @guest
        <div class="small-font text-center p-2 rounded-3 mb-2 bg-warning">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            <p>Create an account or login by entering the information below. If your email is not verified than After
                payment we will sent a verification link
                to your
                email. After visiting that link order will be placed. If you are a returning customer
                <a class="text-dark text-decoration-underline" href="{{ route('login', 'redirect_to=checkout') }}">please
                    login
                    here</a>
            </p>
        </div>
        <div class="form-group mb-3 p-relative">
            <label class="form-label">Account Password</label>
            <input wire:model.defer="password" type="password" placeholder="Password" class="f-pwd form-control">
            <button style="top:42px;" type="button" class="btn pwd-toggle btn-floating btn-sm"><i class="fa fa-eye"
                    aria-hidden="true"></i></button>
            @error('password')
                <p class="text-danger smaller-font">{{ $message }}</p>
            @enderror
        </div>
    @endguest

    @if (session()->has('error_msg'))
        <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg_danger smaller-font f-500 text-light">{{ session('error_msg') }}
        </h3>
    @endif

    <label class="form-label">Payment details</label>
    <div wire:ignore class="mb-1" id="card-element">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <p id="card-errors" class="mb-4 text-danger smaller-font"></p>

    @if (session()->has('card_error'))
        <p class="mb-4 text-danger smaller-font">{{ session('card_error') }}</p>
    @endif

    <button class="input-control btn btn-lg btn-dark btn-block mb-3">Pay and place order</button>
</form>

@push('extra-js')

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");

            // Create an instance of Elements.
            const elements = stripe.elements();

            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: 'Poppins,sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#888'
                    }
                },
                invalid: {
                    color: '#d43535',
                    iconColor: '#d43535'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = "";
                }
            });

            Livewire.on("formSubmit", () => {
                const form = document.querySelector("#checkoutForm")

                var options = {
                    'name': document.getElementById('name').value,
                    'address_line_1': document.getElementById('address').value,
                    'address_city': document.getElementById('city').value,
                    'address_zip': document.getElementById('zip').value,
                    'address_state': document.getElementById('state').value,
                }

                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        $("#card-errors").textContent = result.error.message;
                        form.querySelectorAll(".input-control").forEach(el => {
                            el.removeAttribute("readonly")
                            el.removeAttribute("disabled")
                        })
                    } else {
                        // Send the token to your server.
                        Livewire.emit("submit", result.token);
                    }
                });
            })
        });

    </script>
@endpush
