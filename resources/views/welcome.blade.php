<!DOCTYPE html>
<html>
<head>
    <title>Ubuntu Shop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0f0f0f;
            color: #e5e7eb;
            overflow-x: hidden;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            width: min(1180px, 100%);
            margin: 0 auto;
            padding-bottom: 20px;
        }

        /* HEADER */
        .header {
            background: linear-gradient(180deg, #0b0f19 0%, #111827 100%);
            padding: 24px 20px 16px;
            border-bottom: 1px solid #1f2937;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .brand img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #1f2937;
        }

        .brand-text h1 {
            margin: 0;
            font-size: 18px;
        }

        .brand-text p {
            margin: 2px 0 0;
            font-size: 12px;
            color: #9ca3af;
        }

        .trust-line {
            font-size: 12px;
            color: #22c55e;
            margin-top: 4px;
        }

        /* HERO */
        .hero {
            flex: 1 1 360px;
            min-width: 280px;
            text-align: center;
            padding: 35px 24px;
            background: rgba(15, 23, 42, 0.9);
            border-radius: 22px;
            border: 1px solid #1f2937;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
        }

        .hero h2 {
            margin: 0;
            font-size: 28px;
            line-height: 1.15;
        }

        .hero p {
            color: #9ca3af;
            margin-top: 8px;
        }

        /* SEARCH */
        .search-box {
            text-align: center;
            padding: 20px 20px 28px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .search-box form {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box input {
            width: 350px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #374151;
            background: #111827;
            color: white;
            outline: none;
        }

        .search-box button {
            padding: 12px 18px;
            background: #475569;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .search-box button.search-active {
            background: #22c55e;
            color: black;
        }

        .search-box button:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        /* PRODUCTS GRID */
        .container {
            width: min(1180px, 100%);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .card {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 12px;
            padding: 12px;
            transition: 0.25s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            position: relative;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: #22c55e;
        }

        .card img {
            display: block;
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .whatsapp-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            text-align: center;
            background: #25D366;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .whatsapp-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .whatsapp-link svg {
            flex-shrink: 0;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-top: 12px;
            flex: 1;
        }

        .card h3 {
            margin: 8px 0 5px;
            font-size: 15px;
        }

        .card a {
            color: white;
            text-decoration: none;
        }

        .card a:hover {
            color: #22c55e;
        }

        .product-brand {
            color: #9ca3af;
            font-size: 13px;
        }

        .price {
            color: #22c55e;
            font-weight: bold;
            margin-top: 6px;
        }

        .stock {
            font-size: 12px;
            color: #9ca3af;
        }

        .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #22c55e;
            color: black;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: bold;
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            color: #9ca3af;
            padding: 60px 20px;
        }
        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            margin-top: 20px;
            padding: 12px;
            background: #25D366;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
        }

        .whatsapp-btn:hover {
            opacity: 0.9;
        }

        /* FOOTER */
.footer {
    background: linear-gradient(180deg, #0b0f19 0%, #05070c 100%);
    border-top: 1px solid #1f2937;
    padding: 50px 20px 25px;
    margin-top: auto;
    box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.4);
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    max-width: 1180px;
    margin: 0 auto;
}

.footer h3 {
    margin-bottom: 14px;
    font-size: 14px;
    color: #ffffff;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.footer p, 
.footer a {
    font-size: 13px;
    color: #9ca3af;
    text-decoration: none;
    line-height: 1.6;
    transition: 0.2s ease;
}

.footer a:hover {
    color: #22c55e;
    transform: translateX(3px);
}

.footer-bottom {
    text-align: center;
    margin-top: 30px;
    padding-top: 15px;
    font-size: 12px;
    color: #6b7280;
    border-top: 1px solid #1f2937;
}
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 2fr 2fr 1.5fr;
    gap: 20px;
}

        /* ================= PAGINATION ================= */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin: 40px 0 60px 0;
            flex-wrap: wrap;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #1f2937;
            background: #111827;
            color: #e5e7eb;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination-wrapper a:hover {
            background: #1f2937;
            border-color: #374151;
        }

        .pagination-wrapper .active {
            background: #22c55e;
            color: #000;
            border-color: #22c55e;
            font-weight: 600;
        }

        .pagination-wrapper .disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:600px){
            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="page-wrapper">

<!-- HEADER -->
<div class="header">
    <div class="header-content">

        <!-- BRAND -->
        <div class="brand">
            <img src="{{ asset('images/logo.PNG') }}" alt="Ubuntu Shop Logo">
            <div class="brand-text">
                <h1>Ubuntu Shop</h1>
                <p>Electronics you can trust</p>
                <div class="trust-line">✔ Verified Local Store</div>
            </div>
        </div>

        <!-- HERO -->
        <div class="hero">
            <h2>Find the best electronics in one place</h2>
            <p>Affordable prices • Trusted quality • Fast access</p>
        </div>
    </div>
</div>

<!-- SEARCH -->
<div class="search-box">
    <form id="search-form" method="GET" action="/">
        <input id="search-input" type="search"
               name="search"
               placeholder="Search products by name or brand"
               value="{{ request('search') }}">

        <button id="search-button" type="submit">Search</button>
    </form>
</div>

<main class="main-content">

<!-- PRODUCTS -->
<div class="container">

    @forelse($products as $product)

<div class="card">

    @if($product->quantity <= 5)
        <div class="badge">Low Stock</div>
    @endif

    <a href="/product/{{ $product->id }}">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @endif
    </a>

    <div class="card-body">

        <a href="/product/{{ $product->id }}">
            <h3>{{ $product->name }}</h3>
        </a>

        <div class="product-brand">{{ $product->brand }}</div>

        <div class="stock">
            Stock: {{ $product->quantity }}
        </div>
        <a
        class="whatsapp-btn"
        href="https://wa.me/250791108268?text=Hello%20Ubuntu%20Shop,%20I%20am%20interested%20in%20{{ urlencode($product->name) }}"
        target="_blank">

        <i class="fab fa-whatsapp"></i>
        Get Best Deal on WhatsApp
    </a>

    </div>

</div>

    @empty
        <div class="empty">
            <h3>No products found</h3>
            <p>Try a different search term</p>
        </div>
    @endforelse

</div>

<!-- PAGINATION -->
<div class="pagination-wrapper">
    @if ($products->onFirstPage())
        <span class="disabled">&larr; Previous</span>
    @else
        <a href="{{ $products->previousPageUrl() }}" class="btn-prev">&larr; Previous</a>
    @endif

    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
            <span class="active">{{ $page }}</span>
        @else
            <a href="{{ $url }}">{{ $page }}</a>
        @endif
    @endforeach

    @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="btn-next">Next &rarr;</a>
    @else
        <span class="disabled">Next &rarr;</span>
    @endif
</div>

</main>

<!-- FOOTER -->
<div class="footer">

    <div class="footer-grid">

        <!-- ABOUT -->
        <div>
            <h3>About Us</h3>
            <p>
                Ubuntu Shop provides quality electronics with warranty,
                trusted service, and fast customer support.
            </p>
        </div>

        <!-- CONTACT -->
        <div>
            <h3>Contact</h3>

            <p>
                Email:
                <a href="mailto:support@ubuntushop.com" style="color:#9ca3af; text-decoration:none;">
                    support@ubuntushop.com
                </a>
            </p>

            <p>
                Phone:
                <a href="tel:+250791108268" style="color:#9ca3af; text-decoration:none;">
                    +250791108268
                </a>
            </p>

            <p>
                WhatsApp:
                <a href="https://wa.me/250791108268?text=Hello%20Ubuntu%20Shop%20Support%2C%20I%20need%20assistance"
                   target="_blank"
                   style="color:#25D366; font-weight:bold; text-decoration:none;">
                    Chat with Support
                </a>
            </p>
        </div>

        <!-- LOCATION -->
        <div>
            <h3>Location</h3>
            <p>Kigali, Rwanda</p>
            <p>Open: Mon - Sat</p>
        </div>

        <!-- QUICK LINKS (RIGHT SIDE) -->
        <div>
            <h3>Quick Links</h3>
            <p><a href="/">Home</a></p>
            <p><a href="/login">Admin Login</a></p>
        </div>

    </div>

    <div class="footer-bottom">
        © 2026 Ubuntu Shop — All rights reserved
    </div>

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');
        const searchForm = document.getElementById('search-form');

        function updateButtonState() {
            if (!searchInput || !searchButton) return;

            if (searchInput.value.trim() === '') {
                searchButton.classList.remove('search-active');
                searchButton.textContent = 'Search';
            } else {
                searchButton.classList.add('search-active');
                searchButton.textContent = 'Search';
            }
        }

        let previousSearchValue = searchInput ? searchInput.value : '';

        function submitIfCleared() {
            if (!searchInput || !searchForm) return;

            const currentValue = searchInput.value.trim();
            if (currentValue === '' && previousSearchValue.trim() !== '') {
                searchInput.value = '';
                searchForm.submit();
            }
            previousSearchValue = searchInput.value;
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                updateButtonState();
                submitIfCleared();
            });
            searchInput.addEventListener('search', function () {
                updateButtonState();
                submitIfCleared();
            });
            searchInput.addEventListener('keyup', updateButtonState);
            setTimeout(updateButtonState, 0);
        }

        if (searchForm) {
            searchForm.addEventListener('submit', function () {
                if (searchInput && searchInput.value.trim() === '') {
                    searchInput.value = '';
                }
            });
        }
    });
</script>

</body>
</html>