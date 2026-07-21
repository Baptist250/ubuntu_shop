@extends('layouts.admin')

@section('content')

<style>

body{
    background:#0f0f0f;
    color:#fff;
}

.report-wrapper{
    padding:20px;
}

.report-card{
    background:#111827;
    border:1px solid #1f2937;
    border-radius:14px;
    padding:20px;
    margin-bottom:25px;
}


.report-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
}


.report-title{
    font-size:25px;
    font-weight:bold;
}


.btn{
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}


.btn-back{
    background:#374151;
    color:white;
}


.btn-export{
    background:#22c55e;
    color:black;
}



.summary-grid{

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:15px;
    margin-top:20px;

}


.summary-box{

    background:#0b1220;
    border:1px solid #1f2937;
    border-radius:10px;
    padding:15px;

}


.label{
    color:#9ca3af;
    font-size:13px;
}


.value{

    font-size:25px;
    font-weight:bold;
    margin-top:8px;

}



.section-title{

    margin:25px 0 15px;
    font-size:20px;
    font-weight:bold;

}



table{

    width:100%;
    border-collapse:collapse;

}



thead{

    background:#0b1220;

}



th,td{

    padding:12px;
    border:1px solid #1f2937;
    text-align:left;

}



tbody tr:hover{

    background:#172033;

}



.empty{

    text-align:center;
    color:#9ca3af;
    padding:20px;

}


.badge{

    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}


.green{

    background:#166534;
    color:#bbf7d0;

}


.red{

    background:#991b1b;
    color:#fecaca;

}


</style>


<div class="report-wrapper">


<div class="report-card">


<div class="report-header">

<div>

<a href="/admin/reports" class="btn btn-back">
← Back
</a>


<h2 class="report-title">
Daily Business Report
</h2>


<p style="color:#9ca3af;">
Complete daily sales and inventory activity
</p>


</div>



<a href="/admin/reports/daily/export" class="btn btn-export">
Export PDF
</a>


</div>





<!-- SUMMARY -->

<div class="summary-grid">


<div class="summary-box">

<div class="label">
Today's Revenue
</div>

<div class="value">
{{number_format($total)}} RWF
</div>

</div>



<div class="summary-box">

<div class="label">
Number Of Sales
</div>

<div class="value">
{{count($sales)}}
</div>

</div>



<div class="summary-box">

<div class="label">
New Products
</div>

<div class="value">
{{count($newProducts)}}
</div>

</div>



<div class="summary-box">

<div class="label">
Inventory Changes
</div>

<div class="value">
{{count($inventoryChanges)}}
</div>

</div>



</div>





<!-- SALES -->

<h3 class="section-title">
🛒 Sales Transactions
</h3>


<table>

<thead>

<tr>

<th>Sale ID</th>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
<th>Cashier</th>
<th>Time</th>

</tr>

</thead>


<tbody>


@forelse($sales as $sale)


@foreach($sale->items as $item)


<tr>


<td>
#{{$sale->id}}
</td>


<td>
{{$item->product->name ?? 'Deleted Product'}}
</td>


<td>
{{$item->quantity}}
</td>


<td>
{{number_format($item->price)}} RWF
</td>


<td>
{{number_format($item->price*$item->quantity)}} RWF
</td>


<td>
{{$sale->cashier->name ?? 'Admin'}}
</td>


<td>
{{$sale->created_at->format('H:i')}}
</td>


</tr>


@endforeach


@empty

<tr>
<td colspan="7" class="empty">
No sales today
</td>
</tr>

@endforelse


</tbody>


</table>






<!-- NEW PRODUCTS -->

<h3 class="section-title">
📦 New Products Added
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Brand</th>
<th>Quantity</th>
<th>Added</th>

</tr>

</thead>



<tbody>


@forelse($newProducts as $product)


<tr>

<td>
{{$product->name}}
</td>


<td>
{{$product->brand}}
</td>


<td>
{{$product->quantity}}
</td>


<td>
{{$product->created_at->format('H:i')}}
</td>


</tr>


@empty


<tr>
<td colspan="4" class="empty">
No new products added today
</td>
</tr>


@endforelse


</tbody>


</table>







<!-- STOCK IN -->


<h3 class="section-title">
🟢 Stock Increased
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Old Qty</th>
<th>New Qty</th>
<th>Changed By</th>
<th>Time</th>


</tr>

</thead>


<tbody>


@forelse($stockIn as $item)


<tr>


<td>
{{$item->product->name ?? 'Deleted Product'}}
</td>


<td>
{{$item->old_quantity}}
</td>


<td>
{{$item->new_quantity}}
</td>


<td>
{{$item->user->name ?? 'System'}}
</td>


<td>
{{$item->created_at->format('H:i')}}
</td>


</tr>


@empty

<tr>
<td colspan="5" class="empty">
No stock increased today
</td>
</tr>


@endforelse


</tbody>


</table>







<!-- STOCK OUT -->


<h3 class="section-title">
🔴 Stock Decreased
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Old Qty</th>
<th>New Qty</th>
<th>Changed By</th>
<th>Time</th>


</tr>


</thead>



<tbody>


@forelse($stockOut as $item)


<tr>


<td>
{{$item->product->name ?? 'Deleted Product'}}
</td>


<td>
{{$item->old_quantity}}
</td>


<td>
{{$item->new_quantity}}
</td>


<td>
{{$item->user->name ?? 'System'}}
</td>


<td>
{{$item->created_at->format('H:i')}}
</td>


</tr>


@empty


<tr>

<td colspan="5" class="empty">
No stock decreased today
</td>

</tr>


@endforelse


</tbody>


</table>







<!-- LOW STOCK -->

<h3 class="section-title">
⚠ Low Stock Products
</h3>



<table>

<thead>

<tr>

<th>Product</th>
<th>Available</th>
<th>Status</th>

</tr>

</thead>


<tbody>


@forelse($lowStockProducts as $product)


<tr>


<td>
{{$product->name}}
</td>


<td>
{{$product->quantity}}
</td>


<td>

<span class="badge green">
Low Stock
</span>


</td>


</tr>



@empty


<tr>

<td colspan="3" class="empty">
No low stock products
</td>

</tr>


@endforelse


</tbody>


</table>







<!-- OUT OF STOCK -->


<h3 class="section-title">
❌ Out Of Stock Products
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Status</th>

</tr>


</thead>



<tbody>


@forelse($outOfStockProducts as $product)


<tr>

<td>
{{$product->name}}
</td>


<td>

<span class="badge red">
Out Of Stock
</span>

</td>


</tr>



@empty


<tr>

<td colspan="2" class="empty">
No out of stock products
</td>

</tr>


@endforelse


</tbody>


</table>




</div>


</div>


@endsection