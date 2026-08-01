@extends('layouts.admin')

@section('content')

<style>
    body{
        background:#0f0f0f;
        color:#fff;
    }

    .reports-container{
        max-width:1400px;
        margin:auto;
    }

    /* HEADER */
    .report-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:25px;
    }

    .report-title{
        font-size:28px;
        font-weight:700;
        color:#fff;
    }

    .report-sub{
        color:#9ca3af;
        font-size:14px;
    }

    /* STATS */
    .stats-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
        gap:15px;
        margin-bottom:25px;
    }

    .stat-card{
        background:#0b0f19;
        border:1px solid #1f2937;
        border-radius:14px;
        padding:20px;
    }

    .stat-label{
        color:#9ca3af;
        font-size:13px;
    }

    .stat-value{
        font-size:28px;
        font-weight:700;
        margin-top:8px;
    }

    /* SECTION */
    .section-title{
        font-size:18px;
        font-weight:600;
        margin-bottom:15px;
        margin-top:20px;
    }

    /* REPORT CARDS */
    .report-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
        gap:18px;
    }

    .report-card{
        background:#0b0f19;
        border:1px solid #1f2937;
        border-radius:14px;
        padding:20px;
        transition:.25s ease;
        height:100%;
    }

    .report-card:hover{
        transform:translateY(-4px);
        border-color:#22c55e;
        box-shadow:0 10px 25px rgba(34,197,94,.12);
    }

    .card-icon{
        font-size:30px;
        margin-bottom:12px;
    }

    .report-card h3{
        font-size:17px;
        margin-bottom:8px;
        color:#fff;
    }

    .report-card p{
        color:#9ca3af;
        font-size:13px;
        line-height:1.6;
        min-height:40px;
    }

    .badge-link{
        display:inline-block;
        margin-top:12px;
        padding:8px 12px;
        background:#111827;
        border:1px solid #374151;
        border-radius:8px;
        color:#22c55e;
        font-size:12px;
        font-weight:600;
    }

    a{
        text-decoration:none;
        color:inherit;
    }

    .export-section{
        margin-top:30px;
    }

    .export-card{
        background:#111827;
        border:1px solid #1f2937;
        border-radius:14px;
        padding:20px;
    }

    .export-btn{
        background:#22c55e;
        color:#000;
        border:none;
        padding:10px 18px;
        border-radius:8px;
        font-weight:600;
    }

    @media(max-width:768px){
        .report-title{
            font-size:22px;
        }
    }
</style>

<div class="reports-container">

    <!-- HEADER -->
    <div class="report-header">

        <div>
            <div class="report-title">
                Reports & Analytics
            </div>

            <div class="report-sub">
                Monitor sales, profits, inventory performance and business growth.
            </div>
        </div>

    </div>

    <!-- QUICK STATS -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Today's Sales</div>
            <div class="stat-value">
               {{ number_format($todaySales) }} RWF
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Monthly Revenue</div>
            <div class="stat-value">
                {{ number_format($monthlyRevenue) }} RWF
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Profit</div>
            <div class="stat-value">
                {{ number_format($profit) }} RWF
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Products Sold</div>
            <div class="stat-value">
                {{ number_format($productsSold) }}
            </div>
        </div>

    </div>

    <!-- ANALYTICS -->
<div class="section-title">
    Business Reports
</div>

<div class="report-grid">

    <a href="/admin/reports/daily">
        <div class="report-card">

            <div class="card-icon">📅</div>

            <h3>
                Daily Report
            </h3>

            <p>
                View complete daily business activities including sales,
                revenue, new products added, stock increases,
                stock decreases and inventory changes.
            </p>

            <span class="badge-link">
                Open Daily Report
            </span>

        </div>
    </a>


    <a href="/admin/reports/filtered">
        <div class="report-card">

            <div class="card-icon">📊</div>

            <h3>
                Custom Date Report
            </h3>

            <p>
                Analyze sales and inventory activities between
                selected dates for business review.
            </p>

            <span class="badge-link">
                Filter Data
            </span>

        </div>
    </a>


    <a href="/admin/reports/profit">
        <div class="report-card">

            <div class="card-icon">💰</div>

            <h3>
                Profit Analysis
            </h3>

            <p>
                Monitor revenue, product costs, profit margins
                and overall business performance.
            </p>

            <span class="badge-link">
                View Profit
            </span>

        </div>
    </a>


    <a href="/admin/reports/top-products">
        <div class="report-card">

            <div class="card-icon">🏆</div>

            <h3>
                Top Selling Products
            </h3>

            <p>
                Identify products with highest sales quantity
                and revenue contribution.
            </p>

            <span class="badge-link">
                View Ranking
            </span>

        </div>
    </a>


    <a href="/admin/inventory">
        <div class="report-card">

            <div class="card-icon">📦</div>

            <h3>
                Inventory Report
            </h3>

            <p>
                Track current stock levels, low stock products,
                out of stock products and inventory movement.
            </p>

            <span class="badge-link">
                View Inventory
            </span>

        </div>
    </a>


</div>

    

    <!-- EXPORTS -->
    <div class="export-section">

        <div class="section-title">
            Export Reports
        </div>

        <div class="export-card">

            <h5 class="mb-3">
                Export Business Data
            </h5>

            <p class="text-secondary">
                Download reports as PDF or Excel for accounting, auditing and management review.
            </p>

            <div class="d-flex gap-2 flex-wrap">

                <a href="/admin/reports/daily/export">
                    <button class="export-btn">
                        Export Daily PDF
                    </button>
                </a>

                <a href="#">
                    <button class="export-btn">
                        Export Excel
                    </button>
                </a>

            </div>

        </div>

    </div>

</div>

@endsection