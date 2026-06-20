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
            Daily Sales Report
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

    </div>

</div>

@endsection