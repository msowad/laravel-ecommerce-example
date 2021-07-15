<form wire:submit.prevent='submit' class="p-relative row">

    @include('partial.component-loading')

    <div class="form-group mb-4">
        <input wire:model.defer="name" type="text" placeholder="Name" class="form-control">
        @error('name')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4">
        <input wire:model.defer="email" type="text" disabled placeholder="Email" class="form-control">
        <p class="text-dark smaller-font m-0">Email shouldn't be changed</p>
    </div>
    <div class="form-group mb-4 col-6">
        <input wire:model.defer="mobile" type="text" placeholder="Mobile" class="form-control">
        @error('mobile')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4 col-6">
        <input wire:model.defer="zip" type="text" placeholder="Zip" class="form-control">
        @error('zip')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4">
        <input wire:model.defer="address" type="text" placeholder="Address" class="form-control">
        @error('address')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4 col-6">
        <input wire:model.defer="city" type="text" placeholder="City" class="form-control">
        @error('city')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4 col-6">
        <input wire:model.defer="state" type="text" placeholder="State" class="form-control">
        @error('state')
            <p class="text-danger smaller-font">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-4">
        <input wire:model.defer="company" type="text" placeholder="Company" class="form-control">
        @error('company')
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
