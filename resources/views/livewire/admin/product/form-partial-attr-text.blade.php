<div class="mdc-text-field">
    <input class="mdc-text-field__input" wire:model.defer='attributes.{{ $loopIndex }}.sku'>
    <label class="mdc-floating-label mdc-floating-label--float-above">Sku<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.sku')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror

<div class="mdc-text-field">
    <input class="mdc-text-field__input" wire:model.defer='attributes.{{ $loopIndex }}.mrp'>
    <label class="mdc-floating-label mdc-floating-label--float-above">Mrp<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.mrp')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror

<div class="mdc-text-field">
    <input class="mdc-text-field__input" wire:model.defer='attributes.{{ $loopIndex }}.price'>
    <label class="mdc-floating-label mdc-floating-label--float-above">Price<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.price')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror

<div class="mdc-text-field">
    <input class="mdc-text-field__input" wire:model.defer='attributes.{{ $loopIndex }}.qty'>
    <label class="mdc-floating-label mdc-floating-label--float-above">Qty<span class="text-danger">*</span></label>
</div>
@error('attributes.' . $loopIndex . '.qty')
    <p class="text-danger m-0">{{ $message }}</p>
@enderror
