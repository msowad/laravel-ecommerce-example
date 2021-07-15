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

                        <button aria-describedby="tt2" {{ count($selected) < 1 ? 'disabled' : '' }}
                            wire:click="activeChecked"
                            class="btn-responsive mdc-icon-button material-icons btn-status btn-active">arrow_upward</button>
                        <div id="tt2" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                            <div class="mdc-tooltip__surface">
                                Activate the selected row
                            </div>
                        </div>

                        <button aria-describedby="tt3" {{ count($selected) < 1 ? 'disabled' : '' }}
                            wire:click="deactiveChecked"
                            class="btn-responsive mdc-icon-button material-icons btn-status">arrow_downward</button>
                        <div id="tt3" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                            <div class="mdc-tooltip__surface">
                                Deactive the selected row
                            </div>
                        </div>
                    </div>
                    <h6 class="card-title card-padding pb-0">Customer</h6>
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

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="d-flex align-items-center">
                                Status
                                <div class="mdc-form-field ml-2">
                                    <div class="mdc-radio">
                                        <input wire:model="status" value="activated" class="mdc-radio__native-control"
                                            type="radio" id="activated" name="radios">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="activated">Activated</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input wire:model="status" value="deactivated" class="mdc-radio__native-control"
                                            type="radio" id="deactivated" name="radios">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="deactivated">Deactivated</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input wire:model="status" value="" class="mdc-radio__native-control"
                                            type="radio" id="all" name="radios">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="all">All</label>
                                </div>
                            </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="d-flex align-items-center">
                                User
                                <div class="mdc-form-field ml-2">
                                    <div class="mdc-radio">
                                        <input wire:model="verified" value="1" class="mdc-radio__native-control"
                                            type="radio" id="verified">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="verified">Verified</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input wire:model="verified" value="0" class="mdc-radio__native-control"
                                            type="radio" id="not_verified">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="not_verified">Not Verified</label>
                                </div>
                                <div class="mdc-form-field">
                                    <div class="mdc-radio">
                                        <input wire:model="verified" value="" class="mdc-radio__native-control"
                                            type="radio" id="verified_all">
                                        <div class="mdc-radio__background">
                                            <div class="mdc-radio__outer-circle"></div>
                                            <div class="mdc-radio__inner-circle"></div>
                                        </div>
                                        <div class="mdc-radio__ripple"></div>
                                    </div>
                                    <label for="verified_all">All</label>
                                </div>
                            </div>
                        </div>

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
                    @if ($status != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">status:"{{ $status }}"</span>
                                    <button wire:click="clear('status')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($verified != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">verified:"{{ $verified }}"</span>
                                    <button wire:click="clear('verified')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif


                    @if ($search != '' || $addedOnFrom != '' || $addedOnTo != '' || $status != '' || $verified != '')
                        @include('admin.data-table.clear-all-chip')
                    @endif
                </div>

                @include('admin.data-table.success-msg')

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
                                    @include('admin.data-table.th', ['name' => 'mobile'])
                                    @include('admin.data-table.th', ['name' => 'city'])

                                    <th class="mdc-data-table__header-cell">
                                        Added On
                                        <button wire:click="sort('created_at', 'asc')"
                                            class="{{ $sorted == 'created_atasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                        <button wire:click="sort('created_at', 'desc')"
                                            class="{{ $sorted == 'created_atdesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                    </th>
                                    <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($items as $item)
                                    <tr class="mdc-data-table__row" wire:key='{{ $item->id }}' aria-selected=" false">
                                        @include('admin.data-table.basic-tbody-left')

                                        <td class="mdc-data-table__cell ">
                                            {{ $item->name }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->email }}
                                            @if ($item->email_verified_at)
                                                <button aria-describedby="tt_product_verified_{{ $item->id }}"
                                                    class="mdc-icon-button btn-responsive material-icons text-success">done</button>
                                                <div id="tt_product_verified_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Verified
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->mobile }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->city }}
                                        </td>

                                        <td class="mdc-data-table__cell ">
                                            {{ dataTableDate($item->created_at) }}
                                            <br>
                                            {{ dataTableTime($item->created_at) }}
                                        </td>

                                        <td class="mdc-data-table__cell mdc-data-table__cell--numeric">
                                            @can('edit user')

                                                <a aria-describedby="tt_table_edit_{{ $item->id }}"
                                                    href="{{ route('dashboard.' . $that . '.edit', $item->id) }}"
                                                    class="mdc-icon-button btn-responsive material-icons">edit</a>
                                                <div id="tt_table_edit_{{ $item->id }}" class="mdc-tooltip" role="tooltip"
                                                    aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Edit this {{ $that }}
                                                    </div>
                                                </div>
                                            @endcan
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
