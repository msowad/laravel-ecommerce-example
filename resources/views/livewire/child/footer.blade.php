<footer class="bg-dark shadow-1-strong py-4">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="logo-container">
                    <img src="{{ config('app.secondary_logo') }}" class="img-fluid" alt="e-com">
                </div>
                <p class="smallest-font text-light mt-4">{{ $myShop->short_description }}</p>
                <div class="d-flex mt-4">
                    @if ($myShop->facebook != '')
                        <a href="{{ $myShop->facebook }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-facebook bigger-font text-light"></i>
                        </a>
                    @endif
                    @if ($myShop->twitter != '')
                        <a href="{{ $myShop->twitter }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-twitter bigger-font text-light"></i>
                        </a>
                    @endif
                    @if ($myShop->instagram != '')
                        <a href="{{ $myShop->instagram }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-instagram bigger-font text-light"></i>
                        </a>
                    @endif
                    @if ($myShop->linkedin != '')
                        <a href="{{ $myShop->linkedin }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-linkedin bigger-font text-light"></i>
                        </a>
                    @endif
                    @if ($myShop->youtube != '')
                        <a href="{{ $myShop->youtube }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-youtube bigger-font text-light"></i>
                        </a>
                    @endif
                    @if ($myShop->google_plus != '')
                        <a href="{{ $myShop->google_plus }}" class="btn btn-floating btn-lg btn-dark">
                            <i class="fab fa-google-plus bigger-font text-light"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="small-font text-light text-uppercase">Information</h1>
                <div class="mt-4">
                    <a href="{{ route('aboutUs') }}" class="btn btn-transparent shadow-0 btn-lg text-light">About
                        Us</a><br>
                    <a href="{{ route('contactUs') }}" class="btn btn-transparent shadow-0 btn-lg text-light">
                        Contact Us</a><br>
                    @if ($myShop->mobile1 != '')
                        <p class="small-font text-light text-uppercase mb-0 mt-2">{{ $myShop->mobile1 }}</p><br>
                    @endif
                    @if ($myShop->mobile2 != '')
                        <p class="small-font text-light text-uppercase m-0">{{ $myShop->mobile2 }}</p><br>
                    @endif
                    @if ($myShop->mail1 != '')
                        <p class="smaller-font text-light text-uppercase m-0">{{ $myShop->mail1 }}</p><br>
                    @endif
                    @if ($myShop->mail2 != '')
                        <p class="smaller-font text-light text-uppercase m-0">{{ $myShop->mail2 }}</p><br>
                    @endif
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="small-font text-light text-uppercase">Account</h1>
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-transparent shadow-0 btn-lg text-light">Login</a><br>
                    <a href="{{ route('register') }}"
                        class="btn btn-transparent shadow-0 btn-lg text-light">Register</a><br>
                    <a href="{{ route('cart') }}" class="btn btn-transparent shadow-0 btn-lg text-light">My Cart</a><br>
                    <a href="{{ route('checkout') }}"
                        class="btn btn-transparent shadow-0 btn-lg text-light">Checkout</a><br>
                    <a href="{{ route('wishlist') }}"
                        class="btn btn-transparent shadow-0 btn-lg text-light">wishlist</a><br>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="small-font text-light text-uppercase">Newsletter</h1>
                <div class="mt-4">
                    <form wire:submit.prevent='submit' class="d-flex">
                        <input wire:model.defer="email" type="text" class="bg-dark text-light rounded form-control">
                        <button class="btn btn-dark">Send</button>
                    </form>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if (session()->has('success_msg'))
                        <p class="text-success">{{ session('success_msg') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
