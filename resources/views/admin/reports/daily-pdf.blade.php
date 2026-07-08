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

<h2>Daily Audit Report</h2>

<p>Date: {{ now()->format('Y-m-d') }}</p>

<h3>Sales Entries</h3>
<table>
    <thead>
        <tr>
            <th>Sale ID</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Cashier</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sales as $sale)
            @foreach($sale->items as $item)
                <tr>
                    <td>#{{ $sale->id }}</td>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }} RWF</td>
                    <td>{{ number_format($item->price * $item->quantity) }} RWF</td>
                    <td>{{ $sale->cashier->name ?? 'Admin' }}</td>
                    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="7" class="empty">No sales found for today</td>
            </tr>
        @endforelse
    </tbody>
</table>

<h3>Inventory Actions</h3>
@if($inventoryChanges->isEmpty())
    <p>No inventory actions recorded today.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Type</th>
                <th>From</th>
                <th>To</th>
                <th>By</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryChanges as $change)
                <tr>
                    <td>{{ optional($change->product)->name ?? 'Deleted Product' }}</td>
                    <td>{{ $change->type_label }} ({{ $change->change }})</td>
                    <td>{{ $change->old_quantity }}</td>
                    <td>{{ $change->new_quantity }}</td>
                    <td>{{ optional($change->user)->name ?? 'System' }}</td>
                    <td>{{ $change->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</body>
</html>