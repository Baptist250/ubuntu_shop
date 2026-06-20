@extends('layouts.admin')

@section('content')

<style>
    body{
        background:#0f0f0f;
    }

    .dashboard-card{
        background:#1b1b1b;
        border:1px solid #2b2b2b;
        border-radius:15px;
        color:white;
        padding:20px;
        transition:.3s;
    }

    .dashboard-card:hover{
        transform:translateY(-2px);
    }

    .dashboard-title{
        color:white;
        font-weight:700;
    }

    .dashboard-subtitle{
        color:#b5b5b5;
        font-size:14px;
    }

    .stat-label{
        color:#d8c08a;
        font-size:14px;
    }

    .stat-number{
        font-size:35px;
        font-weight:bold;
    }

    .green{ color:#00b26b; }
    .danger{ color:#ff3b3b; }

    .dark-btn{
        background:#252525;
        color:white;
        border:1px solid #444;
        border-radius:10px;
        padding:8px 18px;
    }

    .dark-btn:hover{
        background:#00b26b;
    }

    .sales-item{
        display:flex;
        justify-content:space-between;
        padding:10px 0;
        border-bottom:1px solid #333;
    }

    .sales-item:last-child{
        border:none;
    }

    .badge-stock{
        background:#f4d6a0;
        color:#222;
        padding:4px 10px;
        border-radius:20px;
    }
</style>

<div class="mb-4">
    <h2 class="dashboard-title">Dashboard</h2>
    <div class="dashboard-subtitle">
        {{ now()->format('D d M Y') }} — Kigali Store
    </div>
</div>

<!-- STATS -->
<div class="row g-3">

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Today Revenue</div>
            <div class="stat-number">
                RWF {{ number_format($todayRevenue) }}
            </div>
            <small class="text-secondary">
                {{ $todaySalesCount }} txns
            </small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Monthly Revenue</div>
            <div class="stat-number">
                RWF {{ number_format($monthlyRevenue) }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Low Stock</div>
            <div class="stat-number danger">
                {{ $lowStockCount }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">All-time Sales</div>
            <div class="stat-number">
                {{ $totalSales }}
            </div>
        </div>
    </div>

</div>

<!-- MAIN GRID -->
<div class="row mt-4">

    <!-- RECENT SALES -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card h-100">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Recent Sales</h4>
                <a href="/admin/pos" class="dark-btn text-decoration-none">
                    View POS
                </a>
            </div>

            @forelse($recentSales as $sale)
                <div class="sales-item">
                    <strong>#TXN-{{ $sale->id }}</strong>
                    <span>{{ $sale->created_at->format('H:i') }}</span>
                    <span class="green">
                        RWF {{ number_format($sale->total_amount) }}
                    </span>
                </div>
            @empty
                <p class="text-muted">No sales yet</p>
            @endforelse

        </div>
    </div>

    <!-- STOCK ALERTS -->
    <div class="col-lg-6 mb-4">
        <div class="dashboard-card h-100">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Stock Alerts</h4>

                <a href="/admin/products" class="dark-btn text-decoration-none">
                    Manage
                </a>
            </div>

            @forelse($lowStockProducts as $product)
                <div class="sales-item">
                    <strong>{{ $product->name }}</strong>
                    <span class="badge-stock">
                        {{ $product->quantity }} units
                    </span>
                </div>
            @empty
                <div class="text-success">
                    No low stock products
                </div>
            @endforelse

        </div>
    </div>

</div>

<!-- TOP PRODUCTS -->
<div class="dashboard-card">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Top Selling Products</h4>
    </div>

    @forelse($topProducts as $item)
        <div class="sales-item">
            <strong>{{ $item->product->name }}</strong>
            <span class="badge-stock">
                {{ $item->total_qty }} sold
            </span>
        </div>
    @empty
        <p class="text-muted">No sales data yet</p>
    @endforelse

</div>

@endsection