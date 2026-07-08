@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }

    .report-wrapper {
        padding: 20px;
    }

    .report-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 20px;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .report-title {
        font-size: 22px;
        font-weight: bold;
    }
    .btn-back {
    background: #1f2937;
    color: #ffffff;
    padding: 10px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    border: 1px solid #374151;
    transition: 0.2s;
}

.btn-back:hover {
    background: #16a34a;
    transform: translateY(-1px);
}

    .btn-export {
        background: #22c55e;
        color: black;
        padding: 10px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-export:hover {
        background: #16a34a;
        color: white;
    }

    .total-box {
        background: #0b1220;
        border: 1px solid #1f2937;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        font-size: 18px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #0f0f0f;
    }

    table thead {
        background: #111827;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #1f2937;
        text-align: left;
    }

    table tbody tr:hover {
        background: #111827;
    }

    .empty {
        text-align: center;
        color: #9ca3af;
        padding: 20px;
    }
</style>

<div class="report-wrapper">

    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header">

    <div style="display:flex; align-items:center; gap:12px;">
        <a href="/admin/reports" class="btn-back">
            ← Back
        </a>

        <div class="report-title">
            Daily Audit Report
        </div>
    </div>

    <a href="/admin/reports/daily/export" class="btn-export">
        Export PDF
    </a>

</div>

        <!-- TOTAL -->
        <div class="total-box">
            <strong>Total Revenue:</strong>
            {{ number_format($total) }} RWF
        </div>

        <!-- TABLE -->
        <h3 style="margin-top: 20px;">Sales Entries</h3>
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

        <h3 style="margin-top: 20px;">Inventory Actions</h3>
        @if($inventoryChanges->isEmpty())
            <div class="empty">No inventory actions recorded today.</div>
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

    </div>

</div>

@endsection