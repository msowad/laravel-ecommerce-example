<div class="container py-2 p-relative">

    @include("partial.resend-code")

    @include('partial.component-loading')

    @if ($orders->count() > 0)
        <div wire:ignore style="margin-bottom: 55px;" class="d-flex justify-content-between align-items-center">
            <select class="nice-select" wire:model='sort' id="">
                <option {{ $sort == 'new' ? 'selected' : '' }} value="new">New first</option>
                <option {{ $sort == 'old' ? 'selected' : '' }} value="old">Old First</option>
                <option {{ $sort == 'low' ? 'selected' : '' }} value="low">Price low to high</option>
                <option {{ $sort == 'high' ? 'selected' : '' }} value="high">Price high to low</option>
            </select>
            <input type="number" wire:model="perPage" min="5" step="10" class="form-control py-1 px-2 w-auto">
        </div>
        <div class="table-container">
            <table class="table table-main table-responsive table-active rounded-3">
                <tr>
                    <th>Order Id</th>
                    <th>Order date</th>
                    <th>Discount</th>
                    <th>Final price</th>
                    <th>Order status</th>
                    <th>Payment status</th>
                    <th class="text-right">Action</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <p class="big-font f-500">{{ $order->id }}</p>
                        </td>
                        <td>
                            <p class="small-font mb-0 f-400 text-nowrap">{{ dataTableDate($order->created_at) }}</p>
                            <p class="smaller-font mt-0 text-nowrap">{{ dataTableTime($order->created_at) }}</p>
                        </td>
                        <td>
                            <p class="small-font text-black f-300">
                                ${{ $order->tax + $order->total_price - $order->final_price }}</p>
                        </td>
                        <td>
                            <p class="small-font text-black f-300">${{ $order->final_price }}</p>
                        </td>
                        <td>
                            <span
                                class="rounded-3 p-2 f-500 text-light text-uppercase m-0 smaller-font bg-{{ $order->order_status }}">
                                {{ $order->order_status }}
                                @if ($order->cancel_by)
                                    by {{ $order->cancel_by }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <span
                                class="rounded-3 p-2 f-500 text-light text-uppercase m-0 smaller-font bg-{{ $order->payment_status }}">{{ $order->payment_status }}</span>
                        </td>
                        <td class="action-td text-right justify-content-end align-items-center d-flex">
                            @if ($order->cancel_by && $order->cancel_by != 'admin' && $order->order_status != 'success')
                                <button wire:click="reOrder({{ $order->id }})"
                                    class="btn mr-2 btn-floating btn-light btn-sm" data-mdb-toggle="tooltip"
                                    title="Order again"><i class="fas fa-undo"></i></button>
                            @elseif($order->order_status != 'success' && $order->order_status != 'waiting' &&
                                $order->cancel_by != 'admin')
                                <button wire:click="cancelOrder({{ $order->id }})"
                                    class="btn mr-2 btn-floating btn-light btn-sm" data-mdb-toggle="tooltip"
                                    title="Cancel Order"><i class="fas fa-times"></i></button>
                            @endif
                            <a target="_self" href="{{ route('pdf', $order->id) }}"
                                class="btn mr-2 btn-floating btn-light btn-sm" data-mdb-toggle="tooltip"
                                title="Download PDF"><i class="fas fa-file-pdf"></i></a>
                            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-floating btn-light btn-lg"
                                data-mdb-toggle="tooltip" title="Order Details"><i class="fas fa-chevron-right"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="my-4 py-4">
            {{ $orders->links('pagination') }}
        </div>
    @else
        @include('partial.empty-table', ["title" => "You have not placed any order"])
    @endif
</div>
