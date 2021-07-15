@can('edit ' . $that)
    <div class="d-flex justify-content-center align-items-center mt-4">

        <button aria-describedby="tt0" wire:click="selectAll" class="btn-responsive mdc-icon-button material-icons">
            {{ $isAllSelect == true ? 'close' : 'select_all' }}
        </button>
        <div id="tt0" class="mdc-tooltip" role="tooltip" aria-hidden="true">
            <div class="mdc-tooltip__surface">
                {{ $isAllSelect == true ? 'deselect the entire table' : 'Select the entire table' }}
            </div>
        </div>

        @if ($onlyTrashed)
            <button aria-describedby="tt_force_restore_checked" {{ count($selected) < 1 ? 'disabled' : '' }}
                wire:click="restoreChecked" class="btn-responsive mdc-icon-button material-icons">restore</button>
            <div id="tt_force_restore_checked" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Restore the selected row
                </div>
            </div>
            <button aria-describedby="tt_force_delete_checked" {{ count($selected) < 1 ? 'disabled' : '' }}
                wire:click="forceDeleteChecked"
                class="btn-responsive mdc-icon-button material-icons">delete_forever</button>
            <div id="tt_force_delete_checked" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Permanently Delete the selected row
                </div>
            </div>
        @else
            <button aria-describedby="tt1" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="deleteChecked"
                class="btn-responsive mdc-icon-button material-icons">delete</button>
            <div id="tt1" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Delete the selected row
                </div>
            </div>

            <button aria-describedby="tt_direct_force_delete_checked" {{ count($selected) < 1 ? 'disabled' : '' }}
                wire:click="directForceDeleteChecked"
                class="btn-responsive mdc-icon-button material-icons">delete_forever</button>
            <div id="tt_direct_force_delete_checked" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Permanently Delete the selected row
                </div>
            </div>

            <button aria-describedby="tt2" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="activeChecked"
                class="btn-responsive mdc-icon-button material-icons btn-status btn-active">arrow_upward</button>
            <div id="tt2" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Activate the selected row
                </div>
            </div>

            <button aria-describedby="tt3" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="deactiveChecked"
                class="btn-responsive mdc-icon-button material-icons btn-status">arrow_downward</button>
            <div id="tt3" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Deactive the selected row
                </div>
            </div>
        @endif

    </div>
@endcan
