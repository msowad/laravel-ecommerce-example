<th class="mdc-data-table__header-cell">
    Added On
    <button wire:click="sort('created_at', 'asc')"
        class="{{ $sorted == 'created_atasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
    <button wire:click="sort('created_at', 'desc')"
        class="{{ $sorted == 'created_atdesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
</th>


@if ($onlyTrashed)
    <th class="mdc-data-table__header-cell">
        Deleted At
        <button wire:click="sort('deleted_at', 'asc')"
            class="{{ $sorted == 'deleted_atasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
        <button wire:click="sort('deleted_at', 'desc')"
            class="{{ $sorted == 'deleted_atdesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
    </th>
@endif

@can('edit ' . $that)
    <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
        Action
    </th>
@endcan
