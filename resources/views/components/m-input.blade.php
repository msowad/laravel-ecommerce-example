<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-{{ $span }}-desktop">
    <div class="mdc-text-field">
        <input class="mdc-text-field__input" type="{{ $type }}" wire:model.defer="{{ $name }}" id="{{ $id }}">
        <div class="mdc-line-ripple"></div>
        <label for="{{ $id }}"
            class="mdc-floating-label {{ $name != null ? 'mdc-floating-label--float-above' : '' }}">{{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    </div>
    @error($name)

        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div>
