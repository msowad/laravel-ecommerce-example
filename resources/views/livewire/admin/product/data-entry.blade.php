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

                                @include('livewire.admin.product.form-partial-top')

                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                                    <input wire:model='photos' multiple accept="image/*" wire:loading.attr='disabled'
                                        type="file" class="d-none" id="photo">
                                    <label for="photo" wire:loading.class=' disabled'
                                        class="mdc-button mdc-button--unelevated filled-button--dark mdc-ripple-upgraded text-uppercase w-100 py-4">
                                        {{ $hasAttr ? 'add more' : 'choose' }} images</label>
                                </div>

                                @if ($hasAttr)
                                    <div class="d-content" wire:sortable='resortAttr'>

                                        @foreach ($attributes as $loopIndex => $attribute)

                                            <div wire:sortable.item="{{ $loopIndex }}" wire:key='{{ $loopIndex }}'
                                                class="product-image-card p-relative mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">

                                                <button wire:sortable.handle type="button"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--dark mdc-ripple-upgraded loopIndex">
                                                    {{ $loopIndex + 1 }}</button>

                                                <input wire:model='newPhoto.{{ $loopIndex }}' accept="image/*"
                                                    wire:loading.attr='disabled' wire:target='newPhoto.{{ $loopIndex }}'
                                                    type="file" class="d-none" id="singlePhoto{{ $loopIndex }}">

                                                <label type="button" for="singlePhoto{{ $loopIndex }}"
                                                    class="editButton text-dark btn-responsive mdc-icon-button material-icons">edit</label>

                                                <button type="button"
                                                    wire:click="$emit('removeAttribute', {{ $loopIndex }})"
                                                    class="removeButton text-dark btn-responsive mdc-icon-button material-icons">close</button>

                                                <img src="{{ $attribute['src'] }}" alt="" class="img-fluid">

                                                @error('attributes.' . $loopIndex . '.photo')
                                                    <p class="text-danger m-0">{{ $message }}</p>
                                                @enderror

                                                @include('livewire.admin.product.form-partial-select')
                                                @include('livewire.admin.product.form-partial-attr-text')

                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button wire:loading.attr='disabled' id="submitBtn"
                                        class="mdc-button mdc-button--raised mdc-ripple-upgraded w-100 text-uppercase">
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
    <script src="{{ mix('js/admin-product.js') }}"></script>
    <script src="{{ asset('common/js/ckeditor.js') }}"></script>

    <script>
        let textareaData = [];

        document.addEventListener('livewire:load', () => {
            Livewire.on('removeAttribute', index => {
                if (confirm("Are you sure? This action can't be undone") == true) {
                    Livewire.emit("removeAttr", index);
                }
            });

            ckeditor();

            document.querySelector("#submitBtn").addEventListener('click', () => {
                textareaData.forEach(textarea => {
                    eval(textarea[2]).set(textarea[1], textarea[0].getData());
                });
            });
        });

        Livewire.on('setEditor', () => {
            ckeditor();
        });

        function ckeditor() {
            let textareas = document.querySelectorAll("textarea[editor='true']");

            textareas.forEach((textarea, key) => {
                ClassicEditor
                    .create(textarea, {
                        toolbar: {
                            items: [
                                'bold',
                                'italic',
                                'link',
                                '|',
                                'bulletedList',
                                'numberedList',
                                '|',
                                'outdent',
                                'indent',
                                '|',
                                'blockQuote',
                                'insertTable',
                                'mediaEmbed',
                                '|',
                                'undo',
                                'redo',
                                '|',
                                'highlight',
                                'alignment',
                                '|',
                                'fontSize',
                                'fontBackgroundColor',
                                'fontColor',
                                '|',
                                'htmlEmbed',
                                'removeFormat',
                                '|',
                                'subscript',
                                'superscript',
                                '|',
                                'underline'
                            ]
                        },
                        language: 'en',
                        table: {
                            contentToolbar: [
                                'tableColumn',
                                'tableRow',
                                'mergeTableCells'
                            ]
                        },
                        licenseKey: '',
                        title: false
                    })
                    .then(editor => {
                        textareaData[key] = [
                            editor = editor,
                            model = textarea.getAttribute("data-model"),
                            that = textarea.getAttribute("data-that")
                        ];
                        textarea.parentNode.querySelector(".ck-content h1").style.display = "none"
                    });

            });
        }

    </script>
@endsection
