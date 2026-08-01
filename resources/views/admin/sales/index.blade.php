@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }
    .card-box {
        background: #0f0f0f;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #1f2937;
        
    }

    table {
        width: 100%;
        color: white;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #1f2937;
    }

    th {
        color: #9ca3af;
        text-align: left;
    }

    tr:hover {
        background: #111827;
    }

    .btn-view {
        background: #3b82f6;
        padding: 6px 10px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        font-size: 12px;
    }
</style>

<div class="card-box">

    <h3 style="color:white;">Sales History</h3>

    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>#{{ $sale->id }}</td>
                    <td>{{ $sale->total_amount }} RWF</td>
                    <td>{{ $sale->created_at->timezone(config('app.timezone'))->format('d M Y H:i') }}</td>
                    <td>
                        <a href="/admin/sales/{{ $sale->id }}" class="btn-view">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection