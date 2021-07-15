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

          @can('manage order')
            <div class="mt-3">

              <button aria-describedby="tt0" wire:click="selectAll" class="btn-responsive mdc-icon-button material-icons">
                {{ $isAllSelect == true ? 'close' : 'select_all' }}
              </button>
              <div id="tt0" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                  {{ $isAllSelect == true ? 'deselect the entire table' : 'Select the entire table' }}
                </div>
              </div>

              <button aria-describedby="tt2" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="cancelChecked"
                class="btn-responsive mdc-icon-button material-icons btn-status btn-danger">close</button>
              <div id="tt2" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                  Cancel the selected order
                </div>
              </div>

              <button aria-describedby="tt3" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="reOrderChecked"
                class="btn-responsive mdc-icon-button material-icons btn-status btn-active">undo</button>
              <div id="tt3" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                  Reorder the selected order
                </div>
              </div>

              <button aria-describedby="tt4" {{ count($selected) < 1 ? 'disabled' : '' }} wire:click="deliveredChecked"
                class="btn-responsive mdc-icon-button material-icons btn-status btn-active">done</button>
              <div id="tt4" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                <div class="mdc-tooltip__surface">
                  Order delivered
                </div>
              </div>
            </div>
          @endcan

          <p class="card-padding pb-0">All orders </p>
        </div>

        @include('admin.data-table.header-bottom')

        <div id="filterArea" class="template-demo px-4">
          <div class="mdc-layout-grid__inner">

            @include('livewire.child.data-filter', ['title' => 'Added On', 'from' => 'addedOnFrom',
            'to' =>
            'addedOnTo'])
            @include('livewire.child.data-filter', ['title' => 'Cancel On', 'from' => 'cancelOnFrom',
            'to' =>
            'cancelOnTo'])
            @include('livewire.child.data-filter', ['title' => 'Delivered On', 'from' =>
            'deliveredOnFrom',
            'to' =>
            'deliveredOnTo'])

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
              <div class="d-flex align-items-center">
                Payment
                @include('livewire.child.checkbox', ['id' => 'paymentSuccess', 'label' => 'Success',
                'model'
                => 'paymentSuccess'])

                @include('livewire.child.checkbox', ['id' => 'paymentPending', 'label' => 'Pending',
                'model'
                => 'paymentPending'])

              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
              <div class="d-flex align-items-center">
                Order
                @include('livewire.child.checkbox', ['id' => 'orderSuccess', 'label' => 'Success',
                'model'
                => 'orderSuccess'])

                @include('livewire.child.checkbox', ['id' => 'orderPending', 'label' => 'Pending',
                'model'
                => 'orderPending'])

                @include('livewire.child.checkbox', ['id' => 'orderCanceled', 'label' => 'Canceled',
                'model'
                =>
                'orderCanceled'])

              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
              <div class="d-flex align-items-center">
                Cancel Status
                <div class="mdc-form-field ml-2">
                  <div class="mdc-radio">
                    <input wire:model="cancelBy" value="all" class="mdc-radio__native-control" type="radio"
                      id="notCancel" name="radios">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="notCancel">All</label>
                </div>
                <div class="mdc-form-field ml-2">
                  <div class="mdc-radio">
                    <input wire:model="cancelBy" value="admin" class="mdc-radio__native-control" type="radio"
                      id="caneledbyadmin" name="radios">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="caneledbyadmin">Cancel by admin</label>
                </div>
                <div class="mdc-form-field">
                  <div class="mdc-radio">
                    <input wire:model="cancelBy" value="user" class="mdc-radio__native-control" type="radio"
                      id="cancelByUser" name="radios">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="cancelByUser">Cancel by user</label>
                </div>
                <div class="mdc-form-field">
                  <div class="mdc-radio">
                    <input wire:model="cancelBy" value="allcanceled" class="mdc-radio__native-control" type="radio"
                      id="allcanceled" name="radios">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="allcanceled">All canceled</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mdc-touch-target-wrapper mx-2 mb-2 text-center">

          @include('admin.data-table.basic-chips')

          @include('livewire.child.chip', ['label' => 'paymentSuccess', 'func' => 'paymentSuccess',
          'value' =>
          $paymentSuccess, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'paymentPending', 'func' => 'paymentPending',
          'value' =>
          $paymentPending, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'orderSuccess', 'func' => 'orderSuccess', 'value' =>
          $orderSuccess, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'orderPending', 'func' => 'orderPending', 'value' =>
          $orderPending, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'orderCanceled', 'func' => 'orderCanceled', 'value'
          =>
          $orderCanceled, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'cancelBy', 'func' => 'cancelBy', 'value' =>
          $cancelBy,
          'defaultVal' => 'all'])
          @include('livewire.child.chip', ['label' => 'cancelOnFrom', 'func' => 'cancelOnFrom', 'value' =>
          $cancelOnFrom, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'cancelOnTo', 'func' => 'cancelOnTo', 'value' =>
          $cancelOnTo, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'deliveredOnFrom', 'func' => 'deliveredOnFrom',
          'value'
          =>
          $deliveredOnFrom, 'defaultVal' => ''])
          @include('livewire.child.chip', ['label' => 'deliveredOnTo', 'func' => 'deliveredOnTo', 'value'
          =>
          $deliveredOnTo, 'defaultVal' => ''])

          @if ($paymentSuccess != '' || $paymentPending != '' || $orderSuccess != '' || $orderPending != '' || $orderCanceled != '' || $cancelBy != 'all' || $search != '' || $addedOnFrom != '' || $addedOnTo != '' || $cancelOnFrom != '' || $cancelOnTo != '' || $deliveredOnFrom != '' || $deliveredOnTo != '')
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

                  <th class="mdc-data-table__header-cell ">
                    final price
                    <button wire:click="sort('final_price   ', 'asc')"
                      class="{{ $sorted == 'final_priceasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                    <button wire:click="sort('final_price', 'desc')"
                      class="{{ $sorted == 'final_pricedesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                  </th>


                  <th class="mdc-data-table__header-cell img-th">
                    Staus
                  </th>

                  <th class="mdc-data-table__header-cell">
                    Delivered On
                    <button wire:click="sort('delivered_on', 'asc')"
                      class="{{ $sorted == 'delivered_onasc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort ml-2">arrow_upward</button>
                    <button wire:click="sort('delivered_on', 'desc')"
                      class="{{ $sorted == 'delivered_ondesc' ? 'active' : '' }} mdc-button icon-button shaped-button material-icons btn-sort">arrow_downward</button>
                  </th>

                  @include('admin.data-table.basic-thead-right')
                </tr>
              </thead>
              <tbody class="mdc-data-table__content">
                @foreach ($items as $item)
                  <tr class="mdc-data-table__row {{ $item->in_home_page != 0 ? 'home-page-tr' : '' }}"
                    wire:key='{{ $item->id }}' aria-selected="false">
                    @include('admin.data-table.basic-tbody-left')

                    <td class="mdc-data-table__cell ">
                      {{ $item->name }}
                    </td>
                    <td class="mdc-data-table__cell ">
                      {{ $item->slug }}
                    </td>
                    <td class="mdc-data-table__cell img-td">
                      <button aria-describedby="tt_payment_{{ $item->id }}" class="mdc-button mdc-button--raised icon-button


                                                   @if ($item->payment_status == 'pending') filled-button--warning
                      @elseif($item->payment_status == 'success')
                        filled-button--success @endif
                        mdc-ripple-upgraded">
                        @if ($item->payment_status == 'pending')
                          PP
                        @elseif($item->payment_status == 'success')
                          PS
                        @endif
                      </button>
                      <div id="tt_payment_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                        <div class="mdc-tooltip__surface">
                          @if ($item->payment_status == 'pending')
                            Payment Pending
                          @elseif($item->payment_status == 'success')
                            Payment Success
                          @endif
                        </div>
                      </div>
                      <button aria-describedby="tt_order_{{ $item->id }}" class="mdc-button mdc-button--raised icon-button

                                                                   @if ($item->order_status ==
                        'pending') filled-button--warning
                      @elseif($item->order_status == 'success')
                        filled-button--success
                      @elseif($item->order_status == 'canceled')
                        filled-button--danger
                      @elseif($item->order_status == 'waiting')
                        filled-button--info @endif
                        mdc-ripple-upgraded">
                        @if ($item->order_status == 'pending')
                          OP
                        @elseif($item->order_status == 'success')
                          OS
                        @elseif($item->order_status == 'canceled')
                          OC
                        @elseif($item->order_status == 'waiting')
                          OW
                        @endif
                      </button>
                      <div id="tt_order_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                        <div class="mdc-tooltip__surface">
                          @if ($item->order_status == 'pending')
                            Order Pending
                          @elseif($item->order_status == 'success')
                            Order Success
                          @elseif($item->order_status == 'canceled')
                            Order canceled
                          @elseif($item->order_status == 'waiting')
                            Order waiting
                          @endif
                        </div>
                      </div>
                    </td>

                    <td class="mdc-data-table__cell ">
                      {{ $item->delivered_on }}
                      <br>
                      {{ $item->delivered_on }}
                    </td>
                    <td class="mdc-data-table__cell ">
                      {{ dataTableDate($item->created_at) }}
                      <br>
                      {{ dataTableTime($item->created_at) }}
                    </td>

                    <td class="mdc-data-table__cell mdc-data-table__cell--numeric">
                      @can('manage order')
                        @if ($item->cancel_by == '' && $item->order_status != 'success' && $item->order_status != 'waiting')
                          <button aria-describedby="tt_table_cancel_{{ $item->id }}"
                            wire:click='cancel({{ $item->id }})'
                            class="mdc-icon-button btn-status btn-responsive material-icons btn-circle">close</button>
                          <div id="tt_table_cancel_{{ $item->id }}" class="mdc-tooltip" role="tooltip"
                            aria-hidden="true">
                            <div class="mdc-tooltip__surface">
                              Cancel this {{ $that }}
                            </div>
                          </div>
                        @endif
                        @if ($item->cancel_by == 'admin')
                          <button aria-describedby="tt_table_reorder_{{ $item->id }}"
                            wire:click='reorder({{ $item->id }})'
                            class="mdc-icon-button btn-active btn-responsive material-icons btn-circle">undo</button>
                          <div id="tt_table_reorder_{{ $item->id }}" class="mdc-tooltip" role="tooltip"
                            aria-hidden="true">
                            <div class="mdc-tooltip__surface">
                              reorder this {{ $that }}
                            </div>
                          </div>
                        @endif
                        @if ($item->order_status == 'pending')
                          <button aria-describedby="tt_table_delivered_{{ $item->id }}"
                            wire:click='delivered({{ $item->id }})'
                            class="mdc-icon-button btn-active btn-responsive material-icons btn-circle">done</button>
                          <div id="tt_table_delivered_{{ $item->id }}" class="mdc-tooltip" role="tooltip"
                            aria-hidden="true">
                            <div class="mdc-tooltip__surface">
                              Order Delivered
                            </div>
                          </div>
                        @endif
                      @endcan
                      <a aria-describedby="tt_table_pdf_{{ $item->id }}" href="{{ route('pdf', $item->id) }}"
                        class="mdc-icon-button btn-responsive material-icons">book</a>
                      <div id="tt_table_pdf_{{ $item->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                        <div class="mdc-tooltip__surface">
                          Download PDF invoice
                        </div>
                      </div>
                      <a aria-describedby="tt_table_detail_{{ $item->id }}"
                        href="{{ route('dashboard.order.detail', $item->id) }}"
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
