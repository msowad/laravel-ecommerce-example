<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-{{ $span }}-desktop">
    <div class="mdc-form-field mt-3">
        <div class="mdc-checkbox">
            <input type="checkbox" value="{{ $value }}" id="{{ $rand }}" class="mdc-checkbox__native-control"
                wire:model.defer="{{ $name }}">
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
        <label for="{{ $rand }}">
            {{ $label }}
        </label>
    </div>
</div>
