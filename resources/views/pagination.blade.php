<h6 class="text-center mb-4 smallest-font f-500">Showing {{ $paginator->firstItem() }} to
    {{ $paginator->lastItem() }} of
    {{ $paginator->total() }} items
</h6>
@if ($paginator->hasPages())
    <div class="d-flex justify-content-center">
        <button wire:click='previousPage' @if ($paginator->onFirstPage()) disabled @endif class="mr-2 btn btn-light btn-floating">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </button>
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <button wire:click='gotoPage({{ $page }})'
                        class="btn btn-light btn-floating mr-2 {{ $page == $paginator->currentPage() ? 'btn__primary' : '' }}">{{ $page }}</button>
                @endforeach
            @endif
        @endforeach

        <button wire:click='nextPage'
            class="btn btn-light btn-floating {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </button>
    </div>
@endif
