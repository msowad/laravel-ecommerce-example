@if (count($selected) > 0)
    <p class="mdc-typography--button px-4 py-1 m-0 success-msg mb-2">You have selected
        {{ count($selected) }}
        of
        {{ $items->total() }}
    </p>
@endif
@if (session()->has('success_msg'))
    <p class="mdc-typography--button m-0 px-4 py-1 success-msg mb-2">{{ session('success_msg') }}
    </p>
@endif
