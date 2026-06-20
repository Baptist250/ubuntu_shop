@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .sub-title {
        color: #9ca3af;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #052e16;
        border: 1px solid #14532d;
        color: #22c55e;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .card-dark {
        background: #0f0f0f;
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 20px;
    }

    .table-responsive {
        border: 1px solid #1f2937;
        border-radius: 12px;
        background: #0f0f0f;
        overflow: hidden;
    }

    .table-dark-custom {
        width: 100%;
        background-color: #0f0f0f !important;
        color: #ffffff !important;
        border-collapse: collapse;
    }

    .table-dark-custom thead th {
        background-color: #0f0f0f !important;
        color: #e5e7eb !important;
        border-bottom: 1px solid #374151 !important;
    }

    .table-dark-custom td {
        background-color: #0f0f0f !important;
        color: #ffffff !important;
        border-top: 1px solid #1f2937 !important;
        vertical-align: middle;
    }

    .table-dark-custom tbody tr:hover td {
        background-color: #111827 !important;
    }

    .img-thumb {
        border-radius: 8px;
        border: 1px solid #374151;
        object-fit: cover;
    }

    .btn-group-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .btn-add {
        background: #22c55e;
        color: #000;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-add:hover {
        background: #16a34a;
    }

    .empty-state {
        text-align: center;
        padding: 30px;
        color: #9ca3af;
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="top-bar">
        <div>
            <div class="page-title">Products Inventory</div>
            <div class="sub-title">Manage all store products</div>
        </div>

        <a href="/admin/products/create" class="btn-add">
            + Add Product
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-dark">

        <div class="table-responsive">

            <table class="table table-dark-custom table-hover align-middle">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Image</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr>
                        <td>{{ $product->name }}</td>

                        <td>
                            {{ $product->brand ?? '—' }}
                        </td>

                        <td>
                            {{ number_format($product->selling_price) }} RWF
                        </td>

                        <td>
                            @if($product->quantity <= 5)
                                <span style="color:#ef4444;font-weight:600;">
                                    {{ $product->quantity }}
                                </span>
                            @else
                                {{ $product->quantity }}
                            @endif
                        </td>

                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     width="55"
                                     height="55"
                                     class="img-thumb">
                            @else
                                <span style="color:#6b7280;">No image</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <div class="btn-group-actions">

                                <a href="/admin/products/{{ $product->id }}/edit"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="/admin/products/{{ $product->id }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this product?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty-state">
                            No products available yet
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection