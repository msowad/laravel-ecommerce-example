@if ($editId == '')
    @section($that . '-add')
        active
    @endsection
@endif
@section('title')
    @if ($editId != '') Edit @else Add @endif {{ $thatUp }}
@endsection
<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">
                            @if ($editId != '') Edit @else Add @endif {{ $thatUp }}
                        </h6>
                        <a href="{{ route('dashboard.' . $that) }}" class="">All</a>
                    </div>
                    <div class="template-demo">
                        <form wire:submit.prevent='submit'>

                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='heading' id="heading">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="heading"
                                            class="mdc-floating-label {{ $heading != '' ? 'mdc-floating-label--float-above' : '' }}">Heading<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('heading')

                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='sub_heading'
                                            id="sub_heading">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="sub_heading"
                                            class="mdc-floating-label {{ $sub_heading != '' ? 'mdc-floating-label--float-above' : '' }}">Sub
                                            Heading<span class="text-danger">*</span></label>
                                    </div>
                                    @error('sub_heading')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='order_id' type="number"
                                            min="1" id="order_id">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="order_id"
                                            class="mdc-floating-label {{ $order_id != '' ? 'mdc-floating-label--float-above' : '' }}">Order
                                            Id<span class="text-danger">*</span></label>
                                    </div>
                                    @error('order_id')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-8-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='link' id="link">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="link"
                                            class="mdc-floating-label {{ $link != '' ? 'mdc-floating-label--float-above' : '' }}">Link<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('link')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-4-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='link_text'
                                            id="link_text">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="link_text"
                                            class="mdc-floating-label {{ $link_text != '' ? 'mdc-floating-label--float-above' : '' }}">Link
                                            Text<span class="text-danger">*</span></label>
                                    </div>
                                    @error('link_text')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                @include('admin.form.photo-input')

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button wire:loading.attr='disabled'
                                        class="text-uppercase mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('admin.progress-indicator')
                </div>
            </div>
        </div>
    </div>
</div>
