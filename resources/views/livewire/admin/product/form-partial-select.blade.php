<div class="mdc-text-field">
    <select wire:model.defer='attributes.{{ $loopIndex }}.status' class="mdc-text-field__input">
        <option value="1" {{ $attribute['status'] == 1 ? 'selected' : '' }}>
            Activated
        </option>
        <option value="0" {{ $attribute['status'] == 0 ? 'selected' : '' }}>
            Deactivated
        </option>
    </select>
    <label class="mdc-floating-label mdc-floating-label--float-above">Status<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.status')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror

<div class="mdc-text-field">
    <select wire:model.defer='attributes.{{ $loopIndex }}.color' class="mdc-text-field__input">
        <option value="">

        </option>
        @foreach ($colorsDt as $colorDt)
            <option {{ $attribute['color'] == $colorDt['id'] ? 'selected' : '' }} value="{{ $colorDt['id'] }}">
                {{ $colorDt['value'] }}
            </option>
        @endforeach
    </select>
    <label class="mdc-floating-label mdc-floating-label--float-above">Color<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.color')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror

<div class="mdc-text-field">
    <select wire:model.defer='attributes.{{ $loopIndex }}.size' class="mdc-text-field__input">
        <option value="">

        </option>
        @foreach ($sizesDt as $sizeDt)
            <option {{ $attribute['size'] == $sizeDt['id'] ? 'selected' : '' }} value="{{ $sizeDt['id'] }}">
                {{ $sizeDt['size'] }}
            </option>
        @endforeach
    </select>
    <label class="mdc-floating-label mdc-floating-label--float-above">Size<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.size')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror
