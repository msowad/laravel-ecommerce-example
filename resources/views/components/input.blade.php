<div class="form-group mb-4 p-relative">
    <label class="form-label">{{ $label }}</label>

    <input value="{{ $value }}" {{ $autofocus ? 'autofocus' : null }} type="{{ $type }}" name="{{ $name }}"
        class="{{ $type == 'password' ? 'f-pwd' : null }} form-control">

    @if ($name == 'password')
        <button type="button" class="btn pwd-toggle btn-floating btn-sm"><i class="fa fa-eye"
                aria-hidden="true"></i></button>
    @endif

    @error($name)
        <p class="text-danger smaller-font">{{ $message }}</p>
    @enderror
</div>
