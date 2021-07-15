<div class="d-flex justify-content-between pagination-container align-items-center">
    <div class="text-center py-4 ml-4">
        {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of
        {{ $paginator->total() }}
    </div>
    @if ($paginator->hasPages())
        <ul class="d-flex align-items-center mr-3">

            {{-- Previous --}}
            <button wire:click='resetPage' @if ($paginator->onFirstPage()) disabled @endif class="mdc-icon-button btn-responsive
                material-icons">first_page</button>
            <button wire:click='previousPage' @if ($paginator->onFirstPage()) disabled @endif
                class="btn-responsive mdc-icon-button material-icons">chevron_left</button>
            {{-- Previous End --}}

            {{-- Next --}}
            <button wire:click='nextPage' @if (!$paginator->hasMorePages()) disabled @endif class="btn-responsive mdc-icon-button material-icons">chevron_right</button>
            <button wire:click='gotoPage({{ $paginator->lastPage() }})' @if (!$paginator->hasMorePages()) disabled @endif class="mdc-icon-button btn-responsive
                material-icons">last_page</button>
            {{-- Next End --}}
        </ul>
    @endif
</div>
