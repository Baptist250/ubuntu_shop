<!DOCTYPE html>
<html>
<head>

<title>Daily Business Report</title>

<style>

body{
    font-family: Arial, sans-serif;
    font-size:12px;
}


h2{
    text-align:center;
}


h3{
    margin-top:25px;
}


table{

    width:100%;
    border-collapse:collapse;
    margin-top:10px;

}


th,td{

    border:1px solid #444;
    padding:6px;
    text-align:left;

}


th{

    background:#eee;

}


.summary{

    margin-top:20px;

}


.box{

    border:1px solid #444;
    padding:10px;
    margin-bottom:10px;

}


.empty{

    text-align:center;
    color:#777;

}


</style>

</head>


<body>


<h2>
Ubuntu Shop Daily Business Report
</h2>


<p>
Date:
{{ now()->format('Y-m-d') }}
</p>



<!-- SUMMARY -->

<h3>Daily Summary</h3>


<div class="box">

<p>
Total Revenue:
<strong>
{{ number_format($total) }} RWF
</strong>
</p>


<p>
Number Of Sales:
{{ count($sales) }}
</p>


<p>
New Products:
{{ count($newProducts) }}
</p>


<p>
Inventory Activities:
{{ count($inventoryChanges) }}
</p>


</div>





<!-- SALES -->

<h3>
Sales Transactions
</h3>


<table>


<thead>

<tr>

<th>ID</th>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
<th>Cashier</th>
<th>Date</th>

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
{{$sale->created_at->format('Y-m-d H:i')}}
</td>


</tr>


@endforeach


@empty

<tr>
<td colspan="7">
No sales today
</td>
</tr>

@endforelse


</tbody>


</table>







<!-- NEW PRODUCTS -->


<h3>
New Products Added
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
<td colspan="4">
No new products
</td>
</tr>

@endforelse


</tbody>


</table>







<!-- STOCK IN -->


<h3>
Stock Increased
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Before</th>
<th>After</th>
<th>Change</th>
<th>User</th>
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
+{{$item->change}}
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
<td colspan="6">
No stock increased
</td>
</tr>


@endforelse


</tbody>


</table>







<!-- STOCK OUT -->


<h3>
Stock Decreased
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Before</th>
<th>After</th>
<th>Change</th>
<th>User</th>
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
-{{$item->change}}
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
<td colspan="6">
No stock decreased
</td>
</tr>


@endforelse


</tbody>


</table>







<!-- LOW STOCK -->


<h3>
Low Stock Products
</h3>


<table>


<thead>

<tr>

<th>Product</th>
<th>Available</th>

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

</tr>


@empty

<tr>
<td colspan="2">
No low stock products
</td>
</tr>


@endforelse


</tbody>


</table>








<!-- OUT OF STOCK -->


<h3>
Out Of Stock Products
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
Out Of Stock
</td>

</tr>


@empty


<tr>
<td colspan="2">
No out of stock products
</td>
</tr>


@endforelse


</tbody>


</table>



</body>
</html>