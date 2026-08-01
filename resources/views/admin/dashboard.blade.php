@extends('layouts.admin')

@section('content')

<style>
    .dashboard-card {
        background: #1b1b1b;
        border: 1px solid #2b2b2b;
        border-radius: 15px;
        color: white;
        padding: 24px;
        transition: transform .2s ease, border .2s ease, background .2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        border-color: #00b26b;
        background: #232323;
    }

    .dashboard-title {
        color: white;
        font-weight: 800;
        letter-spacing: .02em;
    }

    .dashboard-subtitle {
        color: #b5b5b5;
        font-size: 14px;
        margin-top: 6px;
    }

    .dashboard-section {
        margin-top: 1.5rem;
    }

    .stat-label {
        color: #d8c08a;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: .75rem;
    }

    .stat-number {
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
    }

    .stat-caption {
        color: #adb5bd;
        font-size: 13px;
        margin-top: .5rem;
        display: block;
    }

    .text-success-soft {
        color: #8fd19e;
    }

    .green {
        color: #00b26b;
    }

    .danger {
        color: #ff6b6b;
    }

    .dark-btn {
        background: #252525;
        color: white;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 9px 18px;
        transition: background .2s ease, border-color .2s ease;
    }

    .dark-btn:hover {
        background: #00b26b;
        border-color: #00b26b;
        color: #111;
    }

    .dashboard-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #2f2f2f;
    }

    .dashboard-item:last-child {
        border-bottom: none;
    }

    .badge-stock {
        background: #f4d6a0;
        color: #222;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
    }

    .summary-line {
        color: #c1c1c1;
        margin-top: 10px;
        font-size: 14px;
    }
</style>

<div class="mb-4">
    <h2 class="dashboard-title">Admin Dashboard</h2>
    <div class="dashboard-subtitle">
        {{ now()->format('D, j M Y') }} · Kigali Store
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Today Revenue</div>
            <div class="stat-number">RWF {{ number_format($todayRevenue) }}</div>
            <span class="stat-caption">{{ $todaySalesCount }} transactions completed today</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Monthly Revenue</div>
            <div class="stat-number">RWF {{ number_format($monthlyRevenue) }}</div>
            <span class="stat-caption">{{ $monthlySalesCount }} transactions this month</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Products with Low qty in Stock</div>
            <div class="stat-number danger">{{ $lowStockCount }}</div>
            <span class="stat-caption">Products below reorder threshold</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="stat-label">Total Sales completed</div>
            <div class="stat-number">{{ $totalSales }}</div>
            <span class="stat-caption">All-time completed sales</span>
        </div>
    </div>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-6 col-lg-4">
        <div class="dashboard-card">
            <div class="stat-label">Product Catalog</div>
            <div class="stat-number">{{ $totalProducts }}</div>
            <span class="stat-caption">Total active products in inventory</span>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="dashboard-card">
            <div class="stat-label">Customers</div>
            <div class="stat-number">{{ $totalCustomers }}</div>
            <span class="stat-caption">Unique customers with saved details</span>
        </div>
    </div>
</div>

<div class="row g-4 dashboard-section">
    <div class="col-lg-6">
        <div class="dashboard-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">Recent Sales</h4>
                    <p class="summary-line">Latest transactions with amount and time.</p>
                </div>
                <a href="/admin/pos" class="dark-btn text-decoration-none">Open POS</a>
            </div>

            @forelse($recentSales as $sale)
                <div class="dashboard-item" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                    <div class="d-flex justify-content-between align-items-start w-100">
                        <div>
                            <strong>#TXN-{{ $sale->id }}</strong>
                            <div class="text-secondary" style="font-size:13px;">{{ $sale->created_at->format('d M Y H:i') }}</div>
                        </div>
                        <div class="green">RWF {{ number_format($sale->total_amount) }}</div>
                    </div>
                    <div class="text-secondary" style="font-size:13px;">
                        Customer: {{ $sale->customer_name ?: 'Walk-in' }}
                        @if($sale->customer_phone)
                            · {{ $sale->customer_phone }}
                        @endif
                        @if($sale->customer_email)
                            · {{ $sale->customer_email }}
                        @endif
                    </div>
                    <div class="text-secondary" style="font-size:13px;">
                        Items: @if($sale->items->isNotEmpty())
                            {{ $sale->items->map(fn($item) => $item->quantity . 'x ' . ($item->product->name ?? 'Unknown'))->join(', ') }}
                        @else
                            No items available
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted">No recent sales recorded yet.</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-6">
        <div class="dashboard-card h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">Stock Alerts</h4>
                    <p class="summary-line">Products that need restocking soon.</p>
                </div>
                <a href="/admin/products" class="dark-btn text-decoration-none">Manage Products</a>
            </div>

            @forelse($lowStockProducts as $product)
                <div class="dashboard-item">
                    <strong>{{ $product->name }}</strong>
                    <span class="badge-stock">{{ $product->quantity }} units</span>
                </div>
            @empty
                <div class="text-success-soft">No low stock alerts right now.</div>
            @endforelse
        </div>
    </div>
</div>

<div class="dashboard-section">
    <div class="dashboard-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Best Customer</h4>
                <p class="summary-line">Customer with the highest total spend.</p>
            </div>
        </div>

        @if($bestCustomer)
            <div class="dashboard-item">
                <div>
                    <strong>{{ $bestCustomer->customer_name }}</strong>
                    <div class="text-secondary" style="font-size:13px;">
                        {{ $bestCustomer->customer_email ?? 'No email provided' }}
                        @if($bestCustomer->customer_phone)
                            · {{ $bestCustomer->customer_phone }}
                        @endif
                    </div>
                </div>
                <div class="text-success-soft">
                    RWF {{ number_format($bestCustomer->total_spent) }}
                </div>
            </div>
            <div class="summary-line">
                {{ $bestCustomer->orders_count }} orders placed
            </div>
        @else
            <p class="text-muted">No customer purchase data available yet.</p>
        @endif
    </div>

    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Top Selling Products</h4>
                <p class="summary-line">The best-selling products based on quantity sold.</p>
            </div>
        </div>

        @forelse($topProducts as $item)
            <div class="dashboard-item">
                <strong>{{ $item->product->name }}</strong>
                <span class="badge-stock">{{ $item->total_qty }} sold</span>
            </div>
        @empty
            <p class="text-muted">No top selling products available yet.</p>
        @endforelse
    </div>
</div>

@endsection