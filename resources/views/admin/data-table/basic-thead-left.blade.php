<th class="pl-1 w-0 mdc-data-table__header-cell mdc-data-table__header-cell--checkbox" role="columnheader" scope="col">
    <div class="mdc-form-field">
        <div class="mdc-checkbox">
            <input wire:model="selectPage" type="checkbox" class="mdc-checkbox__native-control" id="checkbox-all" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
    </div>
</th>
<th class="mdc-data-table__header-cell ">Id
    <button wire:click="sort('id', 'asc')"
        class="{{ $sorted == 'idasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
    <button wire:click="sort('id', 'desc')"
        class="{{ $sorted == 'iddesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
</th>
