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
                                        <input class="mdc-text-field__input" wire:model.defer='title' id="title">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="title"
                                            class="mdc-floating-label {{ $title != '' ? 'mdc-floating-label--float-above' : '' }}">Title<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('title')

                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='code' id="code">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="code"
                                            class="mdc-floating-label {{ $code != '' ? 'mdc-floating-label--float-above' : '' }}">Code<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('code')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='limit' id="limit">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="limit"
                                            class="mdc-floating-label {{ $limit != '' ? 'mdc-floating-label--float-above' : '' }}">Limit</label>
                                    </div>
                                    @error('limit')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='value' id="value">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="value"
                                            class="mdc-floating-label {{ $value != '' ? 'mdc-floating-label--float-above' : '' }}">Value<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('value')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='cart_min_value'
                                            id="cart_min_value">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="cart_min_value"
                                            class="mdc-floating-label {{ $cart_min_value != '' ? 'mdc-floating-label--float-above' : '' }}">Cart
                                            Min Value<span class="text-danger">*</span></label>
                                    </div>
                                    @error('cart_min_value')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="d-flex align-items-center mt-3">
                                        Type<span class="text-danger">*</span>
                                        <div class="mdc-form-field ml-2">
                                            <div class="mdc-radio">
                                                <input wire:model.defer="type" value="P"
                                                    class="mdc-radio__native-control" type="radio" id="P" name="radios">
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                                <div class="mdc-radio__ripple"></div>
                                            </div>
                                            <label for="P">Percent</label>
                                        </div>
                                        <div class="mdc-form-field">
                                            <div class="mdc-radio">
                                                <input wire:model.defer="type" value="F"
                                                    class="mdc-radio__native-control" type="radio" id="fixed"
                                                    name="radios">
                                                <div class="mdc-radio__background">
                                                    <div class="mdc-radio__outer-circle"></div>
                                                    <div class="mdc-radio__inner-circle"></div>
                                                </div>
                                                <div class="mdc-radio__ripple"></div>
                                            </div>
                                            <label for="fixed">Fixed</label>
                                        </div>
                                    </div>
                                    @error('type')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" type="date" wire:model.defer='expired_on'
                                            id="expired_on">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="expired_on"
                                            class="mdc-floating-label mdc-floating-label--float-above">Expired
                                            On</label>
                                    </div>
                                    @error('expired_on')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button class="tup mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
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
