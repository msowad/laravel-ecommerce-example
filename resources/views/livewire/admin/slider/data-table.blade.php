@section('title')
    slider
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

                    @include('admin.data-table.header-center')

                    @if (can('add slider'))
                        <a href="{{ route('dashboard.' . $that . '.add') }}" class="card-padding pb-0">Add</a>
                    @endcan
            </div>

            @include('admin.data-table.header-bottom')

            <div id="filterArea" class="template-demo px-4">
                <div class="mdc-layout-grid__inner">

                    @include('admin.data-table.basic-filter')
                </div>
            </div>

            <div class="mdc-touch-target-wrapper mx-2 mb-2 text-center">

                @include('admin.data-table.basic-chips')

                @if ($search != '' || $addedOnFrom != '' || $addedOnTo != '' || $deletedAtFrom != '' || $deletedAtTo != '' || $status != '')
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

                                @include('admin.data-table.th', ['name' => 'heading'])

                                <th class="mdc-data-table__header-cell ">
                                    Sub heading
                                    <button wire:click="sort('sub_heading', 'asc')"
                                        class="{{ $sorted == 'sub_headingasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                    <button wire:click="sort('sub_heading', 'desc')"
                                        class="{{ $sorted == 'sub_headingdesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                </th>

                                @include('admin.data-table.th', ['name' => 'link'])

                                <th class="mdc-data-table__header-cell img-th">
                                    Image
                                </th>

                                <th class="mdc-data-table__header-cell ">
                                    Order Id
                                    <button wire:click="sort('order_id', 'asc')"
                                        class="{{ $sorted == 'order_idasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                    <button wire:click="sort('order_id', 'desc')"
                                        class="{{ $sorted == 'order_iddesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                </th>

                                @include('admin.data-table.basic-thead-right')
                            </tr>
                        </thead>
                        <tbody class="mdc-data-table__content">
                            @foreach ($items as $item)
                                <tr class="mdc-data-table__row" wire:key='{{ $item->id }}' aria-selected="false">
                                    @include('admin.data-table.basic-tbody-left')

                                    <td class="mdc-data-table__cell ">
                                        {{ $item->heading }}
                                    </td>
                                    <td class="mdc-data-table__cell ">
                                        {{ $item->sub_heading }}
                                    </td>
                                    <td class="mdc-data-table__cell ">
                                        <a target="_blank" href="{{ $item->link }}">{{ $item->link_text }}</a>
                                    </td>
                                    <td class="mdc-data-table__cell img-td">
                                        <img observe='true' observe-src="{{ $item->photo->url }}" alt=""
                                            class="img-fluid">
                                    </td>
                                    <td class="mdc-data-table__cell product-status-td">
                                        <button
                                            class="mdc-button mdc-button--raised icon-button filled-button--dark mdc-ripple-upgraded">{{ $item->order_id }}</button>
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
