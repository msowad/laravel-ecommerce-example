@section('title')
    Product
@endsection

@section('product')
    active
@endsection
<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner p-relative">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title card-padding pb-0">{{ $model }}</h6>

                    @include('admin.data-table.header-center')

                    @can('add product')
                        <a href="{{ route('dashboard.' . $that . '.add') }}" class="card-padding pb-0">Add</a>
                    @endcan
                </div>

                @include('admin.data-table.header-bottom')

                <div id="filterArea" class="template-demo px-4">
                    <div class="mdc-layout-grid__inner">

                        @include('admin.data-table.basic-filter')

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-form-field mdc-checkbox-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control" wire:model='promotional'
                                        id="promotional" />
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="promotional">Promotional</label>
                            </div>
                            <div class="mdc-form-field mdc-checkbox-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control" wire:model='featured'
                                        id="featured" />
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="featured">Featured</label>
                            </div>
                            <div class="mdc-form-field mdc-checkbox-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control" wire:model='trending'
                                        id="trending" />
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="trending">Trending</label>
                            </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <div class="mdc-form-field mdc-checkbox-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control" wire:model='discounted'
                                        id="discounted" />
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="discounted">Discounted</label>
                            </div>
                            <div class="mdc-form-field mdc-checkbox-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control" wire:model='best_seller'
                                        id="best_seller" />
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="best_seller">Best Seller</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdc-touch-target-wrapper mx-2 mb-2 text-center">

                    @include('admin.data-table.basic-chips')

                    @if ($promotional != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">promotional:"{{ $promotional }}"</span>
                                    <button wire:click="clear('promotional')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($featured != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">featured:"{{ $featured }}"</span>
                                    <button wire:click="clear('featured')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($best_seller != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">best_seller:"{{ $best_seller }}"</span>
                                    <button wire:click="clear('best_seller')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($discounted != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">discounted:"{{ $discounted }}"</span>
                                    <button wire:click="clear('discounted')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif
                    @if ($trending != '')
                        <div class="mdc-chip mdc-chip--touch">
                            <div class="mdc-chip__ripple"></div>
                            <span role="gridcell">
                                <span role="button" tabindex="0" class="mdc-chip__primary-action">
                                    <div class="mdc-chip__touch"></div>
                                    <span class="mdc-chip__text">trending:"{{ $trending }}"</span>
                                    <button wire:click="clear('trending')"
                                        class="btn-chip mdc-icon-button material-icons">close</button>
                                </span>
                            </span>
                        </div>
                    @endif

                    @if ($search != '' || $addedOnFrom != '' || $addedOnTo != '' || $deletedAtFrom != '' || $deletedAtTo != '' || $status != '' || $trending != '' || $best_seller != '' || $discounted != '' || $promotional != '' || $featured != '')
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

                                    @include('admin.data-table.th', ['name' => 'name'])

                                    <th class="mdc-data-table__header-cell ">
                                        category
                                    </th>
                                    <th class="mdc-data-table__header-cell ">
                                        brand
                                    </th>
                                    <th class="mdc-data-table__header-cell ">
                                        Attribute
                                        <button wire:click="sort('product_details_count', 'asc')"
                                            class="{{ $sorted == 'product_details_countasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                                        <button wire:click="sort('product_details_count', 'desc')"
                                            class="{{ $sorted == 'product_details_countdesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                                    </th>


                                    @include('admin.data-table.basic-thead-right')
                                </tr>
                            </thead>
                            <tbody class="mdc-data-table__content">
                                @foreach ($items as $item)
                                    <tr class="mdc-data-table__row" wire:key='{{ $item->id }}' aria-selected="false">
                                        @include('admin.data-table.basic-tbody-left')

                                        <td class="mdc-data-table__cell ">
                                            {{ $item->name }}
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            <a
                                                href="{{ route('dashboard.category.edit', $item->category->id) }}">{{ $item->category->name }}</a>
                                        </td>
                                        <td class="mdc-data-table__cell ">
                                            <a
                                                href="{{ route('dashboard.brand.edit', $item->brand->id) }}">{{ $item->brand->name }}</a>
                                        </td>
                                        <td class="mdc-data-table__cell product-status-td">
                                            <button aria-describedby="tt_product_status_{{ $item->id }}"
                                                class="mdc-button mdc-button--raised icon-button filled-button--dark mdc-ripple-upgraded">
                                                {{ $item->productDetails->count() }}
                                            </button>
                                            <div id="tt_product_status_{{ $item->id }}" class="mdc-tooltip"
                                                role="tooltip" aria-hidden="true">
                                                <div class="mdc-tooltip__surface">
                                                    Attributes
                                                </div>
                                            </div>

                                            @if ($item->featured == 1)
                                                <button aria-describedby="tt_product_featured_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--success mdc-ripple-upgraded">F</button>
                                                <div id="tt_product_featured_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Featured
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->best_seller == 1)
                                                <button aria-describedby="tt_product_best_seller_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--secondary mdc-ripple-upgraded">B</button>
                                                <div id="tt_product_best_seller_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Best Seller
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->promo == 1)
                                                <button aria-describedby="tt_product_promo_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--primary mdc-ripple-upgraded">P</button>
                                                <div id="tt_product_promo_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Promotional
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->trending == 1)
                                                <button aria-describedby="tt_product_trending_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded">T</button>
                                                <div id="tt_product_trending_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Trending
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->discounted == 1)
                                                <button aria-describedby="tt_product_discoun_{{ $item->id }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--light mdc-ripple-upgraded">D</button>
                                                <div id="tt_product_discoun_{{ $item->id }}" class="mdc-tooltip"
                                                    role="tooltip" aria-hidden="true">
                                                    <div class="mdc-tooltip__surface">
                                                        Discounted
                                                    </div>
                                                </div>
                                            @endif
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
