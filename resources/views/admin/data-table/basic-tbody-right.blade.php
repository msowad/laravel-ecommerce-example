<td class="mdc-data-table__cell ">
    {{ dataTableDate($item->created_at) }}
    <br>
    {{ dataTableTime($item->created_at) }}
</td>

@can('edit ' . $that)
    @if ($item->deleted_at != '')

        <td class="mdc-data-table__cell ">
            {{ dataTableDate($item->deleted_at) }}
            <br>
            {{ dataTableTime($item->deleted_at) }}
        </td>

    @endif

    <td class="mdc-data-table__cell mdc-data-table__cell--numeric">
        @if ($onlyTrashed)
            <button aria-describedby="tt_table_restore_{{ $item->id }}" wire:click='restoreRow({{ $item->id }})'
                class="mdc-icon-button btn-responsive material-icons btn-circle">
                restore
            </button>
            <div id="tt_table_restore_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Restore This {{ $that }}
                </div>
            </div>
            <button aria-describedby="tt_table_force_delete_{{ $item->id }}" wire:click='forceDelete({{ $item->id }})'
                class="mdc-icon-button btn-responsive material-icons">delete_forever</button>
            <div id="tt_table_force_delete_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Permanently delete this {{ $that }}
                </div>
            </div>
        @else
            <button aria-describedby="tt_table_status_{{ $item->id }}"
                wire:click='status({{ $item->id }}, {{ $item->status }})'
                class="mdc-icon-button btn-status btn-responsive material-icons btn-circle {{ $item->status == 1 ? 'btn-active' : '' }}">{{ $item->status == 1 ? 'arrow_upward' : 'arrow_downward' }}</button>
            <div id="tt_table_status_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    @if ($item->status == 1)
                        Deactivate this {{ $that }}
                    @else
                        Activate this {{ $that }}
                    @endif
                </div>
            </div>

            <a aria-describedby="tt_table_edit_{{ $item->id }}"
                href="{{ route('dashboard.' . $that . '.edit', $item->id) }}"
                class="mdc-icon-button btn-responsive material-icons">edit</a>
            <div id="tt_table_edit_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Edit this {{ $that }}
                </div>
            </div>
            <button aria-describedby="tt_table_delete_{{ $item->id }}" wire:click='delete({{ $item->id }})'
                class="mdc-icon-button btn-responsive material-icons">delete</button>
            <div id="tt_table_delete_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                    Delete this {{ $that }}
                </div>
            </div>
        @endif

    </td>
@endcan
