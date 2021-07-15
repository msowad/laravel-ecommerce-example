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
                        <form wire:submit.prevent="submit">
                            <div class=" mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                                <p class="text-primary text-uppercase">Enter color name or choose a color</p>
                            </div>
                            <div class="mdc-layout-grid__inner">
                                <div
                                    class="mdc-layout-grid__cell d-flex align-items-center mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer='value' id="value">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="value"
                                            class=" {{ $value != '' ? 'mdc-floating-label--float-above' : '' }} mdc-floating-label">Color
                                            Name</label>
                                    </div>
                                    @error('value')
                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <div id="colorPreview"></div>
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" type="color" wire:model='value'
                                            id="colorPicker">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="colorPicker"
                                            class="mdc-floating-label--float-above mdc-floating-label">Pick a color
                                        </label>
                                    </div>
                                </div>

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button
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
@section('extra-js')
    <script>
        document.addEventListener('livewire:load', () => {
            document.querySelector("#value").addEventListener('keyup', () => {
                let value = document.querySelector("#value").value;
                document.querySelector('#colorPreview').style.backgroundColor = value;
            });
        });

    </script>
@endsection
