@can('edit ' . $that)
    <div class="d-flex table-top-filter">
        <button wire:click="all"
            class="mdc-button {{ $onlyTrashed ? 'filled-button--light' : '' }} mdc-ripple-upgraded">ALL</button>
        <button wire:click="trash"
            class="mdc-button {{ $onlyTrashed ? '' : 'filled-button--light' }} mdc-ripple-upgraded">TRASHED</button>
    </div>
@endcan
