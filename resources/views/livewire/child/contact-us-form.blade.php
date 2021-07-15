<form wire:submit.prevent='submit' class="my-4 py-4">
    <div class="row mb-4">
        <div class="col-md-6 mb-4 mb-md-0 col-sm-12">
            <input wire:model='name' type="text" placeholder="Name" class="form-control">
            @error('name')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6 col-sm-12">
            <input wire:model='email' type="text" placeholder="Email" class="form-control">
            @error('email')
                <p class="text-danger m-0">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mb-4">
        <input wire:model='subject' type="text" placeholder="Subject" class="form-control">
        @error('subject')
            <p class="text-danger m-0">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <textarea wire:model='message' name="" class="form-control" placeholder="Message" cols="30"
            rows="10"></textarea>
        @error('message')
            <p class="text-danger m-0">{{ $message }}</p>
        @enderror
    </div>

    @if (session()->has('success_msg'))
        <div class="p-2 text-uppercase f-500 mb-1 rounded-3 small-font bg-secondary text-light">
            {{ session('success_msg') }}
        </div>
    @endif

    <button class="btn btn-lg btn-dark mb-4 btn-block">submit</button>
</form>
