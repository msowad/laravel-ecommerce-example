<form wire:submit.prevent='submit' class="p-relative">

    @include('partial.component-loading')

    <div class="form-group mb-4 p-relative">
        <input wire:model.defer="old_password" type="password" placeholder="Old Password" class="f-pwd form-control">
        @error('old_password')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4 p-relative">
        <input wire:model.defer="new_password" type="password" placeholder="New Password" class="f-pwd form-control">

        @error('new_password')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    @if (session()->has('error_msg'))
        <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg_danger smaller-font f-500 text-light">{{ session('error_msg') }}
        </h3>
    @endif
    @if (session()->has('success_msg'))
        <h3 class="py-3 shadow-3 px-4 mb-2 rounded-3 bg-secondary smaller-font f-500 text-light">
            {{ session('success_msg') }}
        </h3>
    @endif
    <button class="btn btn-lg btn-dark btn-block mb-4">submit</button>
</form>
