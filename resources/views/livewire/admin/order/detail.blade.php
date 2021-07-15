@section('title')
  Order Detail
@endsection

@section('order')
  active
@endsection
<div class="mdc-layout-grid">
  <div class="mdc-layout-grid__inner p-relative d-flex justify-content-center">
    <div class="mdc-layout-grid__cell stretch-card">
      <div class="mdc-card px-4 pt-0 pb-4">
        @include('admin.progress-indicator')
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="card-title card-padding px-3 py-4">Order Detail</h6>
          <div class="">
            @can('manage order')
              @if ($order->cancel_by == '' && $order->order_status != 'success')
                <button aria-describedby="tt_table_cancel_{{ $order->id }}" wire:click='cancel({{ $order->id }})'
                  class="mdc-icon-button btn-status btn-responsive material-icons btn-circle">close</button>
                <div id="tt_table_cancel_{{ $order->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                  <div class="mdc-tooltip__surface">
                    Cancel this order
                  </div>
                </div>
              @endif
              @if ($order->cancel_by == 'admin')
                <button aria-describedby="tt_table_reorder_{{ $order->id }}" wire:click='reorder({{ $order->id }})'
                  class="mdc-icon-button btn-active btn-responsive material-icons btn-circle">undo</button>
                <div id="tt_table_reorder_{{ $order->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                  <div class="mdc-tooltip__surface">
                    reorder this Order
                  </div>
                </div>
              @endif
              @if ($order->order_status == 'pending')
                <button aria-describedby="tt_table_delivered_{{ $order->id }}"
                  wire:click='delivered({{ $order->id }})'
                  class="mdc-icon-button btn-active btn-responsive material-icons btn-circle">done</button>
                <div id="tt_table_delivered_{{ $order->id }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
                  <div class="mdc-tooltip__surface">
                    Order Delivered
                  </div>
                </div>
              @endif
            @endcan
          </div>
        </div>

        <table class="mdc-data-table__table">
          <thead>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell img-th">Image</th>
              <th class="mdc-data-table__header-cell">Product</th>
              <th class="mdc-data-table__header-cell">Qty</th>
              <th class="mdc-data-table__header-cell text-right">Final price</th>
            </tr>
          </thead>
          <tbody class="mdc-data-table__content">
            @foreach ($order->orderDetail as $detail)
              <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell img-td"><a
                    href="{{ route('dashboard.product.edit', $detail->product->id) }}">
                    <img src="{{  $detail->productDetails->photo->url }}" class="img-fluid" alt="">
                  </a></td>
                <td class="mdc-data-table__cell">
                  <h4 class="text-nowrap">{{ $detail->product->name }}</h4>
                  <p class="smaller-font">${{ $detail->productDetails->price }}</p>
                </td>
                <td class="mdc-data-table__cell">
                  {{ $detail->qty }}
                </td>
                <td class="mdc-data-table__cell text-right">
                  ${{ $detail->productDetails->price * $detail->qty }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <table class="user-table mdc-data-table__table border-1">
          <thead>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Name
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->name }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Email
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->email }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Mobile
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->mobile }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Address
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->address }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                city
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->city }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                state
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->state }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                zip
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->zip }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                company
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->company }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Total Price
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->total_price }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                coupon
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->coupon }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                tax
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->tax }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Final Price
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->final_price }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Cancel By
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->cancel_by }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Cancel On
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->cancel_on }}
              </th>
            </tr>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell">
                Delivered On
              </th>
              <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric">
                {{ $order->delivered_on }}
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
