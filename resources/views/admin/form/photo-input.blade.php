<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
    <input wire:loading.attr='disabled' type="file" wire:target='photo' class="d-none" wire:model='photo' id="photo">
    <label for="photo" wire:loading.class='disabled' wire:target='photo'
        class="mdc-button mdc-button--unelevated filled-button--dark mdc-ripple-upgraded text-uppercase w-100 py-4">
        {{ $editId != '' ? 'change' : 'choose' }} image</label>
</div>

@if ($photo)
    @if ($photoPreview == '')
        <div class="mdc-layout-grid__cell--span-3-desktop"></div>
    @endif
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
        <img src="{{ $photo->temporaryUrl() }}" alt="" width="100%">
    </div>
    @if ($photoPreview == '')
        <div class="mdc-layout-grid__cell--span-3-desktop"></div>
    @endif
@endif


@if ($photoPreview != '')
    @if (!$photo)
        <div class="mdc-layout-grid__cell--span-3-desktop"></div>
    @endif
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop p-relative">
        <p class="previous-photo-text text-dark text-center bg-light m-0 py-2">Previous Photo</p>
        <img src="{{ $photoPreview }}" alt="" width="100%">
    </div>
    @if (!$photo)
        <div class="mdc-layout-grid__cell--span-3-desktop"></div>
    @endif
@endif

@error('photo')
    <div class="text-center bg-danger mx-0 py-2 mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
        <p class="text-light m-0">{{ $message }}</p>
    </div>
@enderror
