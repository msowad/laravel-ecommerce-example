@section('title')
    Coupon
@endsection

@section('coupon')
    active
@endsection
<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner p-relative">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title card-padding pb-0">{{ $model }}</h6>

                    @include('admin.data-table.header-center')

                    @can('add coupon')
                        <a href="{{ route('dashboard.' . $that . '.add') }}" class="card-padding pb-0">Add</a>
                    @endcan
                </div>

                @include('admin.data-table.header-bottom')

                <div id="filterArea" class="template-demo px-4">
                    <div class="mdc-layout-grid__inner">

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                            <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">

                                <h1 class="mb-0 mdc-typography--headline6">Expired On From :</h1>
                                <input wire:model="expiredOnFrom" class="mdc-text-field__input" type="date"
                                    id="text-field-hero-input">

                                <h1 class="mb-0 mdc-typography--headline6">To :</h1>
                                <input wire:model="expiredOnTo" class="mdc-text-field__input" type="date"
                                    id="text-field-hero-input">

                                <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                                    <div class="mdc-notched-outline__leading"></div>
                                    <div class="mdc-notched-outline__trailing"></div>
                                </div>
                            </div>
                        </div>

                        @include('admin.data-table.basic-filter')
                    </div>
                </div>

                <div class="mdc-touch-target-wrapper mx-2 mb-2 text-center">

                    @if ($expiredOnFrom != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">expired on from:"{{ $expiredOnFrom }}"</span>
                                    <button wire:click="clear('expiredOnFrom')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif

                    @if ($expiredOnTo != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">expired on to:"{{ $expiredOnTo }}"</span>
                                    <button wire:click="clear('expiredOnTo')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif

                    @include('admin.data-table.basic-chips')

                    @if ($search != '' || $addedOnFrom != '' || $addedOnTo != '' || $deletedAtFrom != '' || $deletedAtTo != '' || $status != '' || $expiredOnFrom != '' || $expiredOnTo != '')
                        @include('admin.data-table.clear-all-chip')
                    @endif
                </div>

                @include('admin.data-table.success-msg')

                @include('admin.data-table.top-filter')

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

                                    @include('admin.data-table.th', ['name' => 'title'])
                                    @include('admin.data-table.th', ['name' => 'code'])
                                    @include('admin.data-table.th', ['name' => 'value'])

                                    <th aria-describedby="th_table_cmv" class="mdc-data-table__header-cell ">
                                        CMV
                                        <button wire:click="sort('cart_min_value', 'asc')"
                                            class="{{ $sorted == 'cart_min_valueasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                        <button wire:click="sort('cart_min_value', 'desc')"
                                            class="{{ $sorted == 'cart_min_valuedesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                        <div id="th_table_cmv" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                                            <div class="mdc-tooltip__surface">
                                                Cart Min Value
                                            </div>
                                        </div>
                                    </th>

                                    @include('admin.data-table.th', ['name' => 'type'])
                                    @include('admin.data-table.th', ['name' => 'limit'])
                                    @include('admin.data-table.th', ['name' => 'used'])

                                    <th class="mdc-data-table__header-cell ">
                                        expired on
                                        <button wire:click="sort('expired_on', 'asc')"
                                            class="{{ $sorted == 'expired_onasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                        <button wire:click="sort('expired_on', 'desc')"
                                            class="{{ $sorted == 'expired_ondesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                    </th>

                                    @include('admin.data-table.basic-thead-right')
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($items as $item)
                                    <tr class="mdc-data-table__row" wire:key='{{ $item->id }}' aria-selected="false">
                                        @include('admin.data-table.basic-tbody-left')

                                        <td class="mdc-data-table__cell ">
                                            {{ $item->title }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->code }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->value }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->cart_min_value }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->type }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            @if ($item->limit != '')
                                                {{ $item->limit }}
                                            @else
                                                <button aria-describedby="tt_product_featured_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--primary mdc-ripple-upgraded">U</button>
                                                <div id="tt_product_featured_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Unlimited
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->used }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->expired_on }}
                                        </td>

                                        @include('admin.data-table.basic-tbody-right')
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
