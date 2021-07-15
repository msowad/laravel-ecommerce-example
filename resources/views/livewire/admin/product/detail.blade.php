<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
    <input wire:model='photo' accept="image/*" wire:loading.attr='disabled' type="file" wire:target='photo'
        class="d-none" id="photo">
    <label for="photo" wire:loading.class='disabled' wire:target='photo'
        class="mdc-button mdc-button--unelevated filled-button--dark mdc-ripple-upgraded text-uppercase w-100 py-4">
        {{ $editId != '' ? 'change' : 'choose' }} image</label>
</div>
@if ($photo)
    {{-- @json($photos) --}}
    {{-- <div class="d-flex"> --}}
        {{-- @foreach ($photos as $photo)
            --}}
            {{-- <div wire:key='{{ $loop->index }}'
                class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop"> --}}
                <img src="{{ $photo->temporaryUrl() }}" alt="" class="img-fluid">
                {{--
            </div> --}}
            {{-- @endforeach --}}

        {{--
    </div> --}}
@endif
