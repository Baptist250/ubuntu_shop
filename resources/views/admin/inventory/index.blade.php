@extends('layouts.admin')

@section('content')

<style>
body {
    background-color: #0f0f0f;
    color: #ffffff;
}

.inventory-card {
    background: #0f0f0f;
    border: 1px solid #1f2937;
    border-radius: 12px;
    padding: 20px;
}

.page-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
}

.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    padding: 12px;
    color: #9ca3af;
    border-bottom: 1px solid #1f2937;
    font-size: 13px;
}

td {
    padding: 12px;
    border-bottom: 1px solid #1f2937;
}

tr:hover {
    background: #111827;
}

.status {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.in-stock { background: rgba(34,197,94,0.15); color:#22c55e; }
.low-stock { background: rgba(234,179,8,0.15); color:#eab308; }
.out-stock { background: rgba(239,68,68,0.15); color:#ef4444; }

.stock-box {
    display: flex;
    gap: 8px;
    align-items: center;
}

.stock-input {
    width: 80px;
    background: #111827;
    border: 1px solid #374151;
    color: white;
    padding: 6px;
    border-radius: 6px;
}

.btn-update {
    background: #22c55e;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
}

.alert-success {
    background: rgba(34,197,94,0.15);
    border: 1px solid #22c55e;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
}
</style>

<div class="inventory-card">

    <div class="page-title">Inventory</div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)

                    @php
                        if ($product->quantity == 0) {
                            $status = 'out-stock';
                            $label = 'Out';
                        } elseif ($product->quantity <= 5) {
                            $status = 'low-stock';
                            $label = 'Low';
                        } else {
                            $status = 'in-stock';
                            $label = 'OK';
                        }
                    @endphp

                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>

                        <td><strong>{{ $product->quantity }}</strong></td>

                        <td>
                            <span class="status {{ $status }}">
                                {{ $label }}
                            </span>
                        </td>

                        <td>
                            <form method="POST" action="{{ url('/admin/inventory/'.$product->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="stock-box">
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $product->quantity }}"
                                           class="stock-input">

                                    <button class="btn-update">
                                        Save
                                    </button>
                                </div>

                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection