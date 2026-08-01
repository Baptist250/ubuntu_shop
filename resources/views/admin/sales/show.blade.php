<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $sale->invoice_number ?? "#{$sale->id}" }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            color: black;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            max-width: 400px;
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .store-name {
            font-size: 18px;
            font-weight: bold;
        }

        .tagline {
            font-size: 11px;
            color: #444;
        }

        .meta,
        .customer {
            font-size: 11px;
            margin: 10px 0;
            line-height: 1.4;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        td {
            padding: 4px 0;
            border-bottom: 1px dashed #ccc;
        }

        .total-box {
            margin-top: 10px;
            border-top: 1px solid #000;
            padding-top: 10px;
            text-align: right;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 15px;
            color: #555;
        }

        .print-btn {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="receipt">

    <!-- HEADER -->
    <div class="header">

        <!-- LOGO (put in public/images/logo.png) -->
        <img src="{{ asset('images/logo.png') }}" class="logo">

        <div class="store-name">UBUNTU SHOP</div>
        <div class="tagline">Trusted Electronics & Appliances Store</div>
    </div>

    <!-- META -->
    <div class="meta">
        <div><strong>Invoice:</strong> {{ $sale->invoice_number ?? "#{$sale->id}" }}</div>
        <div><strong>Sale ID:</strong> {{ $sale->id }}</div>
        <div><strong>Date:</strong> {{ $sale->created_at->timezone(config('app.timezone'))->format('d M Y H:i') }}</div>
        <div><strong>Cashier:</strong> {{ $sale->cashier->name ?? 'Admin' }}</div>
        <div><strong>Payment:</strong> Cash</div>
    </div>

    <div class="customer">
        <div class="section-title">Customer Details</div>
        <div><strong>Name:</strong> {{ $sale->customer_name ?? 'Walk-in Customer' }}</div>
        <div><strong>Phone:</strong> {{ $sale->customer_phone ?? 'N/A' }}</div>
        <div><strong>Email:</strong> {{ $sale->customer_email ?? 'N/A' }}</div>
        <div><strong>Address:</strong> {{ $sale->customer_address ?? 'N/A' }}</div>
    </div>

    <!-- ITEMS -->
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
        @php $grandTotal = 0; @endphp

        @foreach($sale->items as $item)

            @php
                $line = $item->price * $item->quantity;
                $grandTotal += $line;
            @endphp

            <tr>
                <td>
                    {{ optional($item->product)->name }}
                    <span class="item-subtext">Unit: {{ number_format($item->price) }} RWF</span>
                </td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($line) }} RWF</td>
            </tr>

        @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="total-box">
        TOTAL: {{ number_format($grandTotal) }} RWF
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Thank you for shopping with Ubuntu Shop<br>
        Goods once sold are not returnable
    </div>

    <button class="print-btn" onclick="window.print()">Print Again</button>

</div>

</body>
</html>