@extends('layouts.app')

@section('title')
  Login
@endsection

@section('contents')
  <div>
    <div class="bradcaump py-4">
      <div class="container">
        <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
            class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>shop</a>
        <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
            aria-hidden="true"></i></button>
        <button class="btn btn-lg btn-transparent p-3 shadow-0">
          Login</button>
      </div>
    </div>
    <div class="container py-4 mt-4">
      <div class="row">
        <div class="offset-md-3 col-md-6 col-sm-12">
          <form method="POST" action="{{ route('login') }}" class="p-relative" id="login-form">
            @csrf

            <x-input value="{{ old('email') ?? 'ecom@mail.com' }}" type="email" name="email" />
            <x-input value="secret" type="password" name="password" />

            <a href="{{ route('password.request') }}" class="text-black smaller-font float-end mt-2">Forgot
              password?</a>

            <div class="form-check mb-4 ml-3">
              <input name="remember" class="form-check-input" type="checkbox" id="rememberMe" />
              <label class="form-check-label" for="rememberMe">
                Remember me
              </label>
            </div>

            @if (session()->has('status'))
              <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
                {{ session('status') }}
              </h3>
            @endif

            <button class="btn btn-lg btn-dark btn-block">submit</button>
            <a href="{{ route('register') }}" class="text-black smaller-font float-end mt-2">New here?
              Register</a>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

<script>
  document.addEventListener('livewire:load', function() {
    document.querySelector("#login-form").addEventListener('submit', function(e) {
      e.preventDefault();
      const checkbox = document.querySelector("#rememberMe");
      checkbox.value = checkbox.checked;
      document.querySelector("#login-form").submit();
    });
  });

</script>
