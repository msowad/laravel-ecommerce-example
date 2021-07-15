@section('title')
    {{ $model }}
@endsection

@section($that)
    active
@endsection
<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner p-relative">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title card-padding pb-0">{{ $model }}</h6>

                    @can('edit contacts')
                        <div class="d-flex justify-content-center align-items-center mt-4">

                            <button aria-describedby="tt0" wire:click="selectAll"
                                class="btn-responsive mdc-icon-button material-icons">
                                {{ $isAllSelect == true ? 'close' : 'select_all' }}
                            </button>
                            <div id="tt0" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                                <div class="mdc-tooltip__surface">
                                    {{ $isAllSelect == true ? 'deselect the entire table' : 'Select the entire table' }}
                                </div>
                            </div>

                            @if ($onlyTrashed)
                                <button aria-describedby="tt_force_restore_checked"
                                    {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="restoreChecked"
                                    class="btn-responsive mdc-icon-button material-icons">restore</button>
                                <div id="tt_force_restore_checked" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                                    <div class="mdc-tooltip__surface">
                                        Restore the selected row
                                    </div>
                                </div>
                                <button aria-describedby="tt_force_delete_checked"
                                    {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="forceDeleteChecked"
                                    class="btn-responsive mdc-icon-button material-icons">delete_forever</button>
                                <div id="tt_force_delete_checked" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                                    <div class="mdc-tooltip__surface">
                                        Permanently Delete the selected row
                                    </div>
                                </div>
                            @else
                                <button aria-describedby="tt1" {{ count($selected) < 1 ? 'disabled' : '' }}
                                    wire:click="deleteChecked"
                                    class="btn-responsive mdc-icon-button material-icons">delete</button>
                                <div id="tt1" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                                    <div class="mdc-tooltip__surface">
                                        Delete the selected row
                                    </div>
                                </div>

                                <button aria-describedby="tt_direct_force_delete_checked"
                                    {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="directForceDeleteChecked"
                                    class="btn-responsive mdc-icon-button material-icons">delete_forever</button>
                                <div id="tt_direct_force_delete_checked" class="mdc-tooltip" role="tooltip"
                                    aria-hidden="true">
                                    <div class="mdc-tooltip__surface">
                                        Permanently Delete the selected row
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endcan

                    <h6 class="card-title card-padding pb-0">From User</h6>
                </div>
                @include('admin.data-table.header-bottom')

                <div id="filterArea" class="template-demo px-4">
                    <div class="mdc-layout-grid__inner">

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                            <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">

                                <h1 class="mb-0 mdc-typography--headline6">Added On From :</h1>
                                <input wire:model="addedOnFrom" class="mdc-text-field__input" type="date"
                                    id="text-field-hero-input">

                                <h1 class="mb-0 mdc-typography--headline6">To :</h1>
                                <input wire:model="addedOnTo" class="mdc-text-field__input" type="date"
                                    id="text-field-hero-input">

                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>
                        @if ($onlyTrashed == 'true')
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">
                                    <h1 class="mb-0 mdc-typography--headline6">Deleted At From :</h1>
                                    <input wire:model="deletedAtFrom" class="mdc-text-field__input" type="date"
                                        id="text-field-hero-input">
                                    <h1 class="mb-0 mdc-typography--headline6">To :</h1>
                                    <input wire:model="deletedAtTo" class="mdc-text-field__input" type="date"
                                        id="text-field-hero-input">
                                    <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                        <div class="mdc-notched-outline__leading"></div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mdc-touch-target-wrapper mx-2 mb-2 text-center">

                    @if ($search != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">search:"{{ $search }}"</span>
                                    <button wire:click="clear('search')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($addedOnFrom != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">added on from:"{{ $addedOnFrom }}"</span>
                                    <button wire:click="clear('addedOnFrom')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($addedOnTo != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">added on to:"{{ $addedOnTo }}"</span>
                                    <button wire:click="clear('addedOnTo')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($deletedAtFrom != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">deleted at from:"{{ $deletedAtFrom }}"</span>
                                    <button wire:click="clear('deletedAtFrom')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($deletedAtTo != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">deleted at to:"{{ $deletedAtTo }}"</span>
                                    <button wire:click="clear('deletedAtTo')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($search != '' || $addedOnFrom != '' || $addedOnTo != '' || $deletedAtFrom != '' || $deletedAtTo != '')
                        @include('admin.data-table.clear-all-chip')
                    @endif
                </div>

                @include('admin.data-table.success-msg')

                @can('edit contacts')
                    <div class="d-flex table-top-filter">
                        <button wire:click="all"
                            class="mdc-button {{ $onlyTrashed ? 'filled-button--light' : '' }} mdc-ripple-upgraded">ALL</button>
                        <button wire:click="trash"
                            class="mdc-button {{ $onlyTrashed ? '' : 'filled-button--light' }} mdc-ripple-upgraded">TRASHED</button>
                    </div>
                @endcan

                @if ($items->total() < 1)
                    <div class="p-4 justify-content-center d-flex align-items-center">
                        <h1 class="mdc-typography--headline2 p-4">No {{ $that }} found</h1>
                    </div>
                @else
                    <div class="mdc-data-table">

                        @include('admin.progress-indicator')

                        <table wire:loading.class='opacity-5' wire:target='search' class="mdc-data-table__table">
                            <thead>
                                <tr class="mdc-data-table__header-row">
                                    @include('admin.data-table.basic-thead-left')

                                    @include('admin.data-table.th', ['name' => 'name'])
                                    @include('admin.data-table.th', ['name' => 'email'])

                                    <th class="mdc-data-table__header-cell">
                                        Message
                                    </th>
                                    @include('admin.data-table.basic-thead-right')

                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($items as $item)
                                    <tr class="mdc-data-table__row {{ $item->readed_at == '' ? 'bg-lightgray' : '' }}"
                                        wire:key='{{ $item->id }}' aria-selected=" false">
                                        @include('admin.data-table.basic-tbody-left')

                                        <td class="mdc-data-table__cell ">
                                            {{ $item->name }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->email }}
                                            @if ($item->registered == 1)
                                                <button aria-describedby="tt_product_verified_{{ $item->id }}"
                                                    class="mdc-icon-button btn-responsive material-icons text-success">done</button>
                                                <div id="tt_product_verified_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Registered
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ substr($item->body, 0, 30) }}
                                        </td>

                                        <td class="mdc-data-table__cell ">
                                            {{ dataTableDate($item->created_at) }}
                                            <br>
                                            {{ dataTableTime($item->created_at) }}
                                        </td>

                                        @if ($onlyTrashed)

                                            <td class="mdc-data-table__cell ">
                                                {{ dataTableDate($item->deleted_at) }}
                                                <br>
                                                {{ dataTableTime($item->deleted_at) }}
                                            </td>

                                        @endif

                                        <td class="mdc-data-table__cell mdc-data-table__cell--numeric">
                                            @can('edit contacts')
                                                @if ($onlyTrashed)
                                                    <button aria-describedby="tt_table_restore_{{ $item->id }}"
                                                        wire:click='restoreRow({{ $item->id }})'
                                                        class="mdc-icon-button btn-responsive material-icons btn-circle">
                                                        restore
                                                    </button>
                                                    <div id="tt_table_restore_{{ $item->id }}" class="mdc-tooltip"
                                                        role="tooltip" aria-hidden="true">
                                                        <div class="mdc-tooltip__surface">
                                                            Restore This {{ $that }}
                                                        </div>
                                                    </div>
                                                    <button aria-describedby="tt_table_force_delete_{{ $item->id }}"
                                                        wire:click='forceDelete({{ $item->id }})'
                                                        class="mdc-icon-button btn-responsive material-icons">delete_forever</button>
                                                    <div id="tt_table_force_delete_{{ $item->id }}" class="mdc-tooltip"
                                                        role="tooltip" aria-hidden="true">
                                                        <div class="mdc-tooltip__surface">
                                                            Permanently delete this {{ $that }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <button aria-describedby="tt_table_delete_{{ $item->id }}"
                                                        wire:click='delete({{ $item->id }})'
                                                        class="mdc-icon-button btn-responsive material-icons">delete</button>
                                                    <div id="tt_table_delete_{{ $item->id }}" class="mdc-tooltip"
                                                        role="tooltip" aria-hidden="true">
                                                        <div class="mdc-tooltip__surface">
                                                            Delete this {{ $that }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endcan

                                            <a aria-describedby="tt_table_detail_{{ $item->id }}"
                                                href="{{ route('dashboard.' . $that . '.detail', $item->id) }}"
                                                class="mdc-icon-button btn-responsive material-icons">chevron_right</a>
                                            <div id="tt_table_detail_{{ $item->id }}" class="mdc-tooltip" role="tooltip"
                                                aria-hidden="true">
                                                <div class="mdc-tooltip__surface">
                                                    View detail
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('admin.progress-indicator')
                    </div>

                    {{ $items->links('admin.pagination') }}
                @endif
            </div>
        </div>
    </div>
</div>
