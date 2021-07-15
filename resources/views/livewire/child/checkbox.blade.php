<div class="mdc-form-field mdc-checkbox-field">
    <div class="mdc-checkbox">
        <input type="checkbox" class="mdc-checkbox__native-control" wire:model='{{ $model }}' id="{{ $id }}" />
        <div class="mdc-checkbox__background">
            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
            </svg>
            <div class="mdc-checkbox__mixedmark"></div>
        </div>
    </div>
    <label for="{{ $id }}">{{ $label }}</label>
</div>
