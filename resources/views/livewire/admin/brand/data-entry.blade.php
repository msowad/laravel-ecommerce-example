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
                                        <input class="mdc-text-field__input" wire:model.defer='name' id="name">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="name"
                                            class="mdc-floating-label {{ $name != '' ? 'mdc-floating-label--float-above' : '' }}">Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('name')

                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-form-field">
                                        <div class="mdc-checkbox">
                                            <input type="checkbox" id="basic-disabled-checkbox"
                                                class="mdc-checkbox__native-control" wire:model.defer="in_home_page">
                                            <div class="mdc-checkbox__background">
                                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                    <path class="mdc-checkbox__checkmark-path" fill="none"
                                                        d="M1.73,12.91 8.1,19.28 22.79,4.59"></path>
                                                </svg>
                                                <div class="mdc-checkbox__mixedmark"></div>
                                            </div>
                                        </div>
                                        <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">
                                            Show in home page
                                        </label>
                                    </div>
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
