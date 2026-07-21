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

    <div class="page-title">Inventory   </div>

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
                    <th>Recorded</th>
                    <th>Last Updated</th>
                    <th>Last Change</th>
                    <th>History</th>
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
                            {{ optional($product->created_at)->format('Y-m-d H:i') }}
                        </td>

                        <td>
                            @if($product->updated_at && $product->updated_at > $product->created_at)
                                <div style="display:flex;gap:8px;align-items:center;">
                                    <span>{{ $product->updated_at->format('Y-m-d H:i') }}</span>
                                    <span style="background:rgba(34,197,94,0.12);color:var(--accent);padding:4px 8px;border-radius:8px;font-weight:600;font-size:12px;">Modified</span>
                                </div>
                            @else
                                {{ optional($product->updated_at)->format('Y-m-d H:i') }}
                            @endif
                        </td>

                        <td>
                            @php $last = $product->inventoryChanges()->latest()->first(); @endphp
                            @if($last)
                                @php $sign = $last->change > 0 ? '' : ''; @endphp
                                <div style="font-size:13px;">
                                    <strong>{{ $sign . $last->change }}</strong>
                                    &nbsp;({{ $last->type_label }})
                                    <div style="color:#9ca3af; font-size:12px;">{{ $last->created_at->format('Y-m-d H:i') }} @if($last->user) by {{ $last->user->name }}@endif</div>
                                </div>
                            @else
                                <span style="color:#9ca3af;">—</span>
                            @endif
                        </td>

                        <td>
                            <button class="btn-history" data-product-id="{{ $product->id }}">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection

    <!-- Modal for inventory history -->
    <div id="inventory-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:1200;align-items:center;justify-content:center;">
        <div style="width:min(980px,96%);max-height:84vh;overflow:auto;background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:18px;position:relative;">
            <button id="modal-close" style="position:absolute;right:12px;top:12px;background:transparent;border:none;color:#fff;font-size:18px;">✕</button>
            <h3 style="margin:0 0 8px 0;color:#fff">Inventory Changes</h3>
            <div id="modal-sub" style="color:#9ca3af;font-size:13px;margin-bottom:12px"></div>
            <div id="modal-body"></div>
            <div id="modal-pager" style="margin-top:12px;display:flex;gap:8px;align-items:center;justify-content:flex-end;color:#9ca3af"></div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function(){
            const modal = document.getElementById('inventory-modal');
            const body = document.getElementById('modal-body');
            const pager = document.getElementById('modal-pager');
            const sub = document.getElementById('modal-sub');
            const closeBtn = document.getElementById('modal-close');

            function formatChangeRow(c){
                const when = new Date(c.created_at).toLocaleString();
                const user = c.user ? c.user.name : 'System';
                const sign = c.change > 0 ? '+' : '';
                return `
                    <tr>
                        <td style="padding:8px">${when}</td>
                        <td style="padding:8px"><strong>${sign}${c.change}</strong> (${c.old_quantity} → ${c.new_quantity})</td>
                        <td style="padding:8px">${c.type.charAt(0).toUpperCase() + c.type.slice(1)}</td>
                        <td style="padding:8px">${user}</td>
                        <td style="padding:8px">${c.note || '—'}</td>
                    </tr>
                `;
            }

            function renderPage(data, productName){
                let html = '';
                if(!data || !data.data || data.data.length === 0){
                    body.innerHTML = '<div style="color:#9ca3af">No recorded changes</div>';
                    pager.innerHTML = '';
                    sub.textContent = '';
                    return;
                }

                html += '<table style="width:100%;border-collapse:collapse;color:#fff">';
                html += '<thead><tr>'+
                        '<th style="text-align:left;padding:8px;color:#9ca3af">When</th>'+
                        '<th style="text-align:left;padding:8px;color:#9ca3af">Change</th>'+
                        '<th style="text-align:left;padding:8px;color:#9ca3af">Type</th>'+
                        '<th style="text-align:left;padding:8px;color:#9ca3af">By</th>'+
                        '<th style="text-align:left;padding:8px;color:#9ca3af">Note</th>'+
                    '</tr></thead><tbody>';

                data.data.forEach(function(c){ html += formatChangeRow(c); });
                html += '</tbody></table>';
                body.innerHTML = html;

                // pager
                const current = data.current_page; const last = data.last_page;
                let pagerHtml = '';
                if(current > 1){ pagerHtml += `<button data-page="${current-1}" class="page-btn">Previous</button>`; }
                pagerHtml += `<span style="opacity:0.9;padding:6px 8px">Page ${current} / ${last}</span>`;
                if(current < last){ pagerHtml += `<button data-page="${current+1}" class="page-btn">Next</button>`; }
                pager.innerHTML = pagerHtml;

                // attach handlers
                pager.querySelectorAll('.page-btn').forEach(function(b){
                    b.addEventListener('click', function(){ fetchHistory(productName, b.getAttribute('data-page')); });
                });

                sub.textContent = `Showing ${data.per_page} per page — total ${data.total}`;
            }

            function fetchHistory(productId, page=1){
                body.innerHTML = '<div style="color:#9ca3af">Loading…</div>';
                fetch(`/admin/inventory/${productId}/history?page=${page}`, { headers: { 'X-Requested-With':'XMLHttpRequest' } })
                    .then(r=>r.json())
                    .then(json=>{
                        renderPage(json, productId);
                    }).catch(err=>{
                        body.innerHTML = '<div style="color:#e88">Failed to load</div>';
                        pager.innerHTML = '';
                        console.error(err);
                    });
            }

            document.addEventListener('click', function(e){
                const btn = e.target.closest('.btn-history');
                if(btn){
                    const id = btn.getAttribute('data-product-id');
                    modal.style.display = 'flex';
                    fetchHistory(id,1);
                }
            });

            closeBtn.addEventListener('click', function(){ modal.style.display = 'none'; });
            modal.addEventListener('click', function(e){ if(e.target === modal) modal.style.display = 'none'; });

        })();
    </script>
    @endpush