<div class="mdc-layout-grid__inner">
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
        <div class="mdc-text-field">
            <input class="mdc-text-field__input" wire:model.defer='name' id="name">
            <div class="mdc-line-ripple"></div>
            <label for="name"
                class="mdc-floating-label {{ $name != '' ? 'mdc-floating-label--float-above' : '' }}">Name</label>
        </div>
        @error('name')

            <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                <p class="text-danger">{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
        <div class="mdc-text-field">
            <input class="mdc-text-field__input" wire:model.defer='slug' id="slug">
            <div class="mdc-line-ripple"></div>
            <label for="slug"
                class="mdc-floating-label {{ $slug != '' ? 'mdc-floating-label--float-above' : '' }}">Slug</label>
        </div>
        @error('slug')
            <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                <p class="text-danger">{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <button class="mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
            Save
        </button>
    </div>
</div>
