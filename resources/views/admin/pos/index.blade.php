@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }
    .pos-container {
        display: flex;
        gap: 20px;
        bac
    }
    .pos-container {
        background: #0f0f0f;
        padding: 20px;
        border-radius: 12px;
    }

    .products, .cart {
        background: #171717;
        padding: 15px;
        border-radius: 12px;
    }

    .products {
        flex: 2;
    }

    .cart {
        flex: 1;
    }

    .product {
        background: #171717;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        color: #fff;
        transition: 0.2s;
    }

    .product:hover {
        background: #1f2937;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        color: #fff;
        background: #0f0f0f;
        padding: 8px;
        border-radius: 8px;
    }

    .qty-controls {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .qty-btn {
        background: #374151;
        border: none;
        color: white;
        width: 25px;
        height: 25px;
        border-radius: 5px;
        cursor: pointer;
    }

    .remove-btn {
        background: #ef4444;
        border: none;
        color: white;
        padding: 3px 6px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
    }

    .btn-checkout {
        width: 100%;
        background: #22c55e;
        border: none;
        padding: 10px;
        border-radius: 8px;
        margin-top: 10px;
        font-weight: 600;
    }
    .disabled-product {
    opacity: 0.4;
    cursor: not-allowed;
}

    .total-box {
        margin-top: 10px;
        padding: 10px;
        background: #111827;
        color: white;
        border-radius: 8px;
        font-weight: bold;
    }

    .empty {
        color: #9ca3af;
        text-align: center;
        margin-top: 20px;
    }
</style>
@if(session('success'))
    <div style="background:#16a34a;color:white;padding:10px;border-radius:8px;margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#dc2626;color:white;padding:10px;border-radius:8px;margin-bottom:10px;">
        {{ session('error') }}
    </div>
@endif

<div class="pos-container">

    <!-- PRODUCTS -->
    <div class="products">
        <h3 style="color:white;">Products</h3>

        @foreach($products as $product)

    <div class="product 
        {{ $product->quantity <= 0 ? 'disabled-product' : '' }}"
        
        @if($product->quantity > 0)
            onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->selling_price }}, {{ $product->quantity }})"
        @else
            onclick="alert('Out of stock')"
        @endif
    >
        {{ $product->name }} - {{ number_format($product->selling_price) }} RWF

        @if($product->quantity <= 0)
            <small style="color:red;">Out of stock</small>
        @endif
    </div>

@endforeach
    </div>

    <!-- CART -->
    <div class="cart">
        <h3 style="color:white;">Cart</h3>

        <div id="cart"></div>

        <div id="total" class="total-box">Total: 0 RWF</div>

        <form method="POST" action="/admin/pos/checkout" onsubmit="return prepareCart()">
    @csrf

    <input type="hidden" name="cart" id="cartInput">

    <button type="submit" class="btn-checkout">
        Checkout
    </button>
</form>
    </div>

</div>

<script>
    let cart = [];

    function addToCart(id, name, price, stock) {
    let item = cart.find(p => p.id === id);

    if (stock <= 0) {
        alert("This product is out of stock");
        return;
    }

    if (item) {
        if (item.qty >= stock) {
            alert("Not enough stock available");
            return;
        }
        item.qty++;
    } else {
        cart.push({ id, name, price, qty: 1, stock });
    }

    renderCart();
}

    function increase(id) {
    let item = cart.find(p => p.id === id);

    if (item.qty >= item.stock) {
        alert("Stock limit reached");
        return;
    }

    item.qty++;
    renderCart();
}

    function decrease(id) {
        let item = cart.find(p => p.id === id);

        if (item.qty > 1) {
            item.qty--;
        } else {
            cart = cart.filter(p => p.id !== id);
        }

        renderCart();
    }

    function removeItem(id) {
        cart = cart.filter(p => p.id !== id);
        renderCart();
    }

    function renderCart() {
    let html = '';
    let total = 0;

    if (cart.length === 0) {
        document.getElementById('cart').innerHTML =
            '<div class="empty">Cart is empty</div>';

        document.getElementById('total').innerHTML =
            'Total: 0 RWF';

        return;
    }

    cart.forEach(item => {

        let lineTotal = item.price * item.qty;
        total += lineTotal;

        html += `
            <div class="cart-item">

                <div style="flex:1;">
                    <strong>${item.name}</strong>

                    <div style="margin-top:5px;">
                        Price:
                        <input
                            type="number"
                            min="0"
                            value="${item.price}"
                            onchange="updatePrice(${item.id}, this.value)"
                            style="
                                width:100px;
                                background:#111827;
                                color:white;
                                border:1px solid #374151;
                                border-radius:6px;
                                padding:4px;
                            ">
                    </div>

                    <small>
                        Total: ${lineTotal.toLocaleString()} RWF
                    </small>
                </div>

                <div class="qty-controls">
                    <button
                        type="button"
                        class="qty-btn"
                        onclick="decrease(${item.id})">
                        -
                    </button>

                    <span>${item.qty}</span>

                    <button
                        type="button"
                        class="qty-btn"
                        onclick="increase(${item.id})">
                        +
                    </button>
                </div>

                <button
                    type="button"
                    class="remove-btn"
                    onclick="removeItem(${item.id})">
                    X
                </button>

            </div>
        `;
    });

    document.getElementById('cart').innerHTML = html;

    document.getElementById('total').innerHTML =
        'Total: ' + total.toLocaleString() + ' RWF';
}

    function prepareCart() {
        if (cart.length === 0) {
            alert("Cart is empty!");
            return false;
        }

        document.getElementById('cartInput').value = JSON.stringify(cart);
        return true;
    }
    function updatePrice(id, newPrice)
{
    let item = cart.find(p => p.id === id);

    if(item)
    {
        item.price = parseFloat(newPrice);
        renderCart();
    }
}
</script>

@endsection