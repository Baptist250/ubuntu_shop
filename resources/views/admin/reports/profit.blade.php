@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
    }
    .report-container {
        max-width: 1200px;
        margin: auto;
    }

    .report-header {
        margin-bottom: 25px;
    }

    .report-title {
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .report-subtitle {
        color: #9ca3af;
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .stat-card {
        background: #0f0f0f;
        border: 1px solid #1f2937;
        border-radius: 14px;
        padding: 20px;
        transition: 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #374151;
    }

    .stat-label {
        color: #9ca3af;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 30px;
        font-weight: 700;
        color: #ffffff;
    }

    .revenue {
        border-left: 4px solid #3b82f6;
    }

    .cost {
        border-left: 4px solid #f59e0b;
    }

    .profit {
        border-left: 4px solid #22c55e;
    }

    .profit-positive {
        color: #22c55e;
    }

    .profit-negative {
        color: #ef4444;
    }

    .summary-card {
        margin-top: 25px;
        background: #0f0f0f;
        border: 1px solid #1f2937;
        border-radius: 14px;
        padding: 25px;
    }

    .summary-title {
        color: #ffffff;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .summary-text {
        color: #9ca3af;
        line-height: 1.7;
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
    display:inline-block;
    margin-bottom:15px;
    padding:8px 14px;
}

.btn-back:hover {
    background: #16a34a;
    transform: translateY(-1px);
}
</style>

<div class="report-container">

    <div class="report-header">

    <a href="{{ url()->previous() }}" class="btn-back">
        ← Back
    </a>

    <h1 class="report-title">
        Profit Report
    </h1>

    <p class="report-subtitle">
        Financial performance overview of Ubuntu Shop
    </p>
</div>

    <div class="stats-grid">

        <div class="stat-card revenue">
            <div class="stat-label">
                Total Revenue
            </div>

            <div class="stat-value">
               {{ number_format($totalRevenue) }} RWF
            </div>
        </div>

        <div class="stat-card cost">
            <div class="stat-label">
                Total Cost
            </div>

            <div class="stat-value">
                {{ number_format($totalCost) }} RWF
            </div>
        </div>

        <div class="stat-card profit">
            <div class="stat-label">
                Net Profit
            </div>

            <div class="stat-value {{ $profit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                {{ number_format($profit) }} RWF
            </div>
        </div>

    </div>

    <div class="summary-card">

        <div class="summary-title">
            Profit Summary
        </div>

        <div class="summary-text">

            Revenue generated from sales:
            <strong>{{ number_format($totalRevenue) }} RWF</strong>

            <br><br>

            Total inventory cost:
            <strong>{{ number_format($totalCost) }} RWF</strong>

            <br><br>

            Final profit earned:
            <strong class="{{ $profit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                {{ number_format($profit) }} RWF
            </strong>

        </div>

    </div>

</div>

@endsection