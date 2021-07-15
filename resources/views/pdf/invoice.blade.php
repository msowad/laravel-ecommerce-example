<style>
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #c43b68;
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left;
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right;
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #c43b68
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #c43b68
    }

    a {
        color: #c43b68;
        text-decoration: none;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #c43b68;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #c43b68
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #c43b68;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #c43b68;
        font-size: 1.4em;
        border-top: 1px solid #c43b68
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    a {
        font-family: 'Poppins';
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }

</style>
<div id="invoice">

    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="{{ route('home') }}">
                                {{ config('app.name') }}
                            </a>
                        </h2>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{ $order->name }}</h2>
                        <div class="address">{{ $order->city }}, {{ $order->state }}</div>
                        <div class="address">{{ $order->address }}({{ $order->zip }})</div>
                        <div class="email">{{ $order->email }}</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE #{{ $order->id }}</h1>
                        <div class="date">Date of Invoice: {{ dataTableDate($order->created_at) }}</div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Final price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetail as $item)
                            <tr>
                                <td class="text-left">
                                    <h4>{{ $item->product->name }}</h4>
                                    <p>${{ $item->productDetails->price }}</p>
                                </td>
                                <td class="unit">
                                    <p class="small-font text-black f-300">{{ $item->qty }}</p>
                                </td>
                                <td class="qty">
                                    <p class="small-font text-black f-300">
                                        ${{ $item->productDetails->price * $item->qty }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">SUBTOTAL</td>
                            <td>${{ $order->total_price }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">TAX 25%</td>
                            <td>$0.00</td>
                        </tr>
                        @if ($order->total_price - $order->final_price > 0)
                            <tr>
                                <td colspan="2">Discount</td>
                                <td>${{ $order->total_price - $order->final_price }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>${{ $order->final_price }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
