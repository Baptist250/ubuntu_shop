@extends('layouts.admin')

@section('content')

<style>
    body {
        background: #0f0f0f;
        color: white;
    }

    .page-wrapper {
        padding: 20px;
    }

    .page-header {
        /* display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px; */
        max-width: 1200px;
        margin: auto;
    }
    .subtitle {
        margin-bottom: 25px;
    }
    .top-title {
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    


    .title {
        font-size: 22px;
        font-weight: 700;
    }

    .subtitle {
        color: #9ca3af;
        font-size: 14px;
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

    .card-dark {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-dark-custom {
        width: 100%;
        border-collapse: collapse;
        color: white;
    }

    .table-dark-custom thead {
        background: #0b0f19;
    }

    .table-dark-custom th,
    .table-dark-custom td {
        padding: 14px;
        border-bottom: 1px solid #1f2937;
    }

    .table-dark-custom tbody tr:hover {
        background: #1f2937;
        transition: 0.2s;
    }

    .badge-sales {
        background: #22c55e;
        color: black;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .empty-state {
        padding: 30px;
        text-align: center;
        color: #9ca3af;
    }
</style>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header" >
            <a href="{{ url()->previous() }}" class="btn-back">
             ← Back
             </a>

            <h1 class="top-title">Top Selling Products</h1>
            <div class="subtitle">Products ranked by total sales volume</div>
    </div>

    <!-- TABLE -->
    <div class="card-dark">

        <table class="table-dark-custom">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Total Sold</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <span class="badge-sales">
                                {{ $product->total_sold ?? 0 }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty-state">
                            No sales data available
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection