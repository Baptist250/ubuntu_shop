@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
    }
    .report-card{
        background:#0f0f0f;
        border:1px solid #1f2937;
        border-radius:16px;
        padding:25px;
    }

    .report-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:25px;
    }

    .report-title{
        color:#fff;
        font-size:24px;
        font-weight:700;
        margin:0;
    }

    .report-subtitle{
        color:#9ca3af;
        font-size:14px;
        margin:0;
        
    }

    .filter-form{
        display:flex;
        gap:12px;
        flex-wrap:wrap;
        align-items:end;
        margin-bottom:25px;
    }

    .form-group{
        display:flex;
        flex-direction:column;
    }

    .form-label{
        color:#9ca3af;
        margin-bottom:6px;
        font-size:13px;
    }

    .form-input{
        background:#0f0f0f;
        border:1px solid #374151;
        color:white;
        padding:10px 14px;
        border-radius:10px;
        min-width:180px;
    }

    .form-input:focus{
        outline:none;
        border-color:#22c55e;
        box-shadow:0 0 0 3px rgba(34,197,94,.15);
    }

    .btn-filter{
        background:#22c55e;
        color:white;
        border:none;
        padding:10px 20px;
        border-radius:10px;
        font-weight:600;
        height:45px;
    }

    .btn-filter:hover{
        background:#16a34a;
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

    .summary-card{
        background:#0f0f0f;
        border:1px solid #1f2937;
        border-radius:12px;
        padding:18px;
        margin-bottom:20px;
    }

    .summary-label{
        color:#9ca3af;
        font-size:13px;
    }

    .summary-value{
        color:white;
        font-size:28px;
        font-weight:700;
    }

    .table-wrapper{
        overflow-x:auto;
    }

    .report-table{
        width:100%;
        border-collapse:collapse;
    }

    .report-table thead{
        background:#0f0f0f;
    }

    .report-table th{
        color:#d1d5db;
        padding:14px;
        border-bottom:1px solid #374151;
        font-weight:600;
    }

    .report-table td{
        color:#f9fafb;
        padding:14px;
        border-bottom:1px solid #1f2937;
    }

    .report-table tbody tr:hover{
        background:#0f0f0f;
    }

    .sale-id{
        color:#22c55e;
        font-weight:600;
    }

    .amount{
        font-weight:600;
    }

    .empty-row{
        text-align:center;
        color:#9ca3af;
        padding:30px;
    }
</style>

<div class="report-card">

    <div class="report-header">
        

        
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="/admin/reports" class="btn-back">
                ← Back
            </a>
            <h2 class="report-title">
                Sales Report
            </h2>

            <div class="report-subtitle">
                Filter sales by date range
            </div>
        </div>

    </div>

    <form method="GET" action="/admin/reports/filtered" class="filter-form">

        <div class="form-group">
            <label class="form-label">From Date</label>
            <input
                type="date"
                name="from"
                value="{{ request('from') }}"
                class="form-input"
            >
        </div>

        <div class="form-group">
            <label class="form-label">To Date</label>
            <input
                type="date"
                name="to"
                value="{{ request('to') }}"
                class="form-input"
            >
        </div>

        <button type="submit" class="btn-filter">
            Generate Report
        </button>

    </form>

    <div class="summary-card">

        <div class="summary-label">
            Total Sales Revenue
        </div>

        <div class="summary-value">
            {{ number_format($sales->sum('total_amount')) }} RWF
        </div>

    </div>

    <div class="table-wrapper">

        <table class="report-table">

            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($sales as $sale)

                    <tr>
                        <td class="sale-id">
                            #{{ $sale->id }}
                        </td>

                        <td class="amount">
                            {{ number_format($sale->total_amount) }} RWF
                        </td>

                        <td>
                            {{ $sale->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="empty-row">
                            No sales found for the selected period.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection