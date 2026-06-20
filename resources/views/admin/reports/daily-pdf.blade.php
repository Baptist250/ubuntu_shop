<!DOCTYPE html>
<html>
<head>
    <title>Daily Sales Report</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>

<h2>Daily Sales Report</h2>

<p>Date: {{ now()->format('Y-m-d') }}</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Amount</th>
                    <th>Time</th>
        </tr>
    </thead>
    <tbody>

@forelse($sales as $sale)

    @foreach($sale->items as $item)

        <tr>
            <td>#{{ $sale->id }}</td>

            <td>
                {{ $item->product->name ?? 'Deleted Product' }}
            </td>
            <td>
                {{ $item->quantity }}
            </td>
            <td>
                {{ number_format($item->price) }} RWF
            </td>
            <td>
                {{ number_format($item->price * $item->quantity) }} RWF
            </td>

            <td>
                {{ $sale->created_at->format('Y-m-d H:i') }}
            </td>
        </tr>

    @endforeach

@empty
    <tr>
        <td colspan="4" class="empty">
            No sales found for today
        </td>
    </tr>
@endforelse

</tbody>
</table>

</body>
</html>