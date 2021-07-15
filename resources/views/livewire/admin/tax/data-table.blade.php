@section('title')
    Tax
@endsection

@section('tax')
    active
@endsection
<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner p-relative">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title card-padding pb-0">{{ $model }}</h6>

                    @include('admin.data-table.header-center')

                    @can('add tax')
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

                                    @include('admin.data-table.th', ['name' => 'value'])
                                    @include('admin.data-table.th', ['name' => 'description'])

                                    @include('admin.data-table.basic-thead-right')
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($items as $item)
                                    <tr class="mdc-data-table__row" wire:key='{{ $item->id }}' aria-selected="false">
                                        @include('admin.data-table.basic-tbody-left')

                                        <td class="mdc-data-table__cell ">
                                            {{ $item->value }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            {{ $item->description }}
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
