<th class="mdc-data-table__header-cell ">
    {{ $name }}
    <button wire:click="sort('{{ $name }}', 'asc')"
        class="{{ $sorted == $name . 'asc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
    <button wire:click="sort('{{ $name }}', 'desc')"
        class="{{ $sorted == $name . 'desc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
</th>
