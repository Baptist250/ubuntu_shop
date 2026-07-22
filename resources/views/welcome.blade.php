<!DOCTYPE html>
<html>
<head>
    <title>Ubuntu Shop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
      html,
body {
    margin:0;
    padding:0;
    min-height:100%;
}

*,
*::before,
*::after {
    box-sizing:border-box;
}

:root{
    --bg:#0f1724;
    --surface:#0b1220;
    --muted:#9ca3af;
    --accent:#22c55e;
    --accent-contrast:#000;
    --card:#0f1724;
    --border:#1f2937;
    --glass:rgba(255,255,255,0.03);
}


body{
    font-family:'Inter',ui-sans-serif,system-ui,-apple-system,
    'Segoe UI',Roboto,'Helvetica Neue',Arial;
    background:var(--bg);
    color:#e5e7eb;
    overflow-x:hidden;
    -webkit-font-smoothing:antialiased;
}


.page-wrapper{
    min-height:100vh;
    display:flex;
    flex-direction:column;
}


.main-content{
    flex:1;
    width:min(1180px,100%);
    margin:auto;
    padding-bottom:20px;
}



/* ================= HEADER ================= */


.header{

    background:linear-gradient(
        180deg,
        var(--surface),
        #0b1220
    );

    padding:18px 20px;

    border-bottom:1px solid var(--border);

    position:sticky;

    top:0;

    z-index:80;

    backdrop-filter:blur(6px);

    box-shadow:
    0 4px 18px rgba(2,6,23,.6);

}



.header-content{

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:24px;

    max-width:1180px;

    margin:auto;

}



.brand{

    display:flex;

    align-items:center;

    gap:16px;

}



.brand img{

    width:45px;

    height:45px;

    border-radius:10px;

    object-fit:cover;

    border:1px solid #1f2937;

}



.brand-text{

    display:flex;

    flex-direction:column;

    gap:4px;

}



.brand-text h1{

    margin:0;

    font-size:18px;

}



.brand-text p{

    margin:2px 0 0;

    font-size:12px;

    color:#9ca3af;

}



.trust-line{

    font-size:12px;

    color:#22c55e;

}



/* ================= NAV ================= */


.nav-wrapper{

    display:flex;

    align-items:center;

    gap:12px;

}



.nav-menu{

    display:flex;

    align-items:center;

    gap:12px;

    flex-wrap:wrap;

}



.nav-menu a{

    text-decoration:none;

    color:var(--muted);

    font-size:13px;

    font-weight:600;

    letter-spacing:.6px;

    text-transform:uppercase;

    padding:10px 14px;

    border-radius:8px;

    display:inline-flex;

    align-items:center;

}



.nav-menu a:hover,
.nav-menu a.active{

    color:var(--accent);

}



.nav-separator{

    width:1px;

    height:28px;

    background:var(--border);

}



.actions{

    display:flex;

    align-items:center;

    gap:10px;

}



.btn-primary{

    background:var(--accent);

    color:#000;

    padding:8px 14px;

    border-radius:10px;

    border:none;

    font-weight:700;

    cursor:pointer;

}



.cta{

    padding:8px 14px;

    border-radius:10px;

    font-weight:700;

    text-decoration:none;

}



.cta-primary{

    background:var(--accent);

    color:#000;

}



.cta-secondary{

    border:1px solid var(--border);

    color:var(--muted);

}



/* USER DROPDOWN */


.user-dropdown{

    position:absolute;

    right:0;

    top:44px;

    min-width:180px;

    background:var(--card);

    border:1px solid var(--border);

    border-radius:10px;

    padding:8px;

    display:none;

    box-shadow:
    0 10px 30px rgba(0,0,0,.6);

}



.user-dropdown.open{

    display:block;

}



.user-dropdown a{

    display:block;

    padding:10px;

    color:var(--muted);

}




/* HAMBURGER */


.nav-toggle{

    display:none;

    width:44px;

    height:44px;

    border:none;

    cursor:pointer;

    background:transparent;

    align-items:center;

    justify-content:center;

}



.hamburger{

    width:22px;

    height:16px;

    position:relative;

}



.hamburger span{

    position:absolute;

    left:0;

    right:0;

    height:2px;

    background:#e5e7eb;

    border-radius:2px;

    transition:.3s;

}



.hamburger span:nth-child(1){

    top:0;

}



.hamburger span:nth-child(2){

    top:7px;

}



.hamburger span:nth-child(3){

    top:14px;

}



.nav-toggle.open .hamburger span:nth-child(1){

    transform:translateY(7px) rotate(45deg);

}



.nav-toggle.open .hamburger span:nth-child(2){

    opacity:0;

}



.nav-toggle.open .hamburger span:nth-child(3){

    transform:translateY(-7px) rotate(-45deg);

}
        /* ================= HERO ================= */

.hero {

    flex:1 1 360px;

    min-width:280px;

    display:flex;

    gap:20px;

    align-items:center;

    justify-content:space-between;

    padding:36px 28px;

    background:
    linear-gradient(
        90deg,
        rgba(12,14,22,.6),
        rgba(8,10,16,.6)
    );

    border-radius:18px;

    border:1px solid var(--border);

    box-shadow:
    0 24px 60px rgba(0,0,0,.35);

}



.hero h2{

    margin:0;

    font-size:30px;

    font-weight:800;

}



.hero p{

    color:#9ca3af;

}



.hero-content{

    max-width:720px;

}



.hero-illustration{

    width:220px;

    height:140px;

    border-radius:12px;

    background:
    linear-gradient(
        135deg,
        var(--glass),
        rgba(255,255,255,.02)
    );

    border:1px solid var(--border);

    display:flex;

    justify-content:center;

    align-items:center;

    color:var(--muted);

}



.hero-actions{

    display:flex;

    gap:12px;

    margin-top:16px;

}



/* ================= SEARCH ================= */


.search-box{

    text-align:center;

    padding:20px;

    max-width:1180px;

    margin:auto;

}



.search-box form{

    display:flex;

    justify-content:center;

}



.search-input-wrapper{

    width:100%;

}



.search-box input{

    width:350px;

    padding:12px;

    border-radius:8px;

    border:1px solid #374151;

    background:#111827;

    color:white;

    outline:none;

}



.search-box button{

    padding:12px 18px;

    background:#475569;

    border:none;

    border-radius:8px;

    color:white;

    font-weight:bold;

    cursor:pointer;

}



.search-box button.search-active{

    background:#22c55e;

    color:#000;

}



/* ================= PRODUCTS ================= */


.container{

    width:min(1180px,100%);

    margin:auto;

    display:grid;

    grid-template-columns:
    repeat(auto-fill,minmax(230px,1fr));

    gap:15px;

    padding:20px;

}



.card{

    background:#111827;

    border:1px solid #1f2937;

    border-radius:12px;

    padding:12px;

    overflow:hidden;

    display:flex;

    flex-direction:column;

    position:relative;

    transition:.25s;

}



.card:hover{

    transform:translateY(-4px);

    border-color:#22c55e;

}



.card img{

    width:100%;

    height:180px;

    object-fit:cover;

    border-radius:10px 10px 0 0;

}



.card-body{

    display:flex;

    flex-direction:column;

    gap:10px;

    padding-top:12px;

}



.card h3{

    margin:8px 0 5px;

    font-size:15px;

}



.card a{

    color:white;

    text-decoration:none;

}



.card a:hover{

    color:#22c55e;

}



.product-brand{

    color:#9ca3af;

    font-size:13px;

}



.price{

    color:#22c55e;

    font-weight:bold;

}



.stock{

    color:#9ca3af;

    font-size:12px;

}



.badge{

    position:absolute;

    top:10px;

    right:10px;

    background:#22c55e;

    color:#000;

    padding:4px 8px;

    border-radius:20px;

    font-size:11px;

    font-weight:bold;

}



/* ================= WHATSAPP ================= */


.whatsapp-btn{

    display:flex;

    align-items:center;

    justify-content:center;

    gap:10px;

    width:100%;

    margin-top:20px;

    padding:12px;

    background:#25D366;

    color:white;

    border-radius:10px;

    font-weight:bold;

    text-decoration:none;

}



/* ================= EMPTY ================= */


.empty{

    text-align:center;

    color:#9ca3af;

    padding:60px 20px;

}



/* ================= PAGINATION ================= */


.pagination-wrapper{

    display:flex;

    justify-content:center;

    align-items:center;

    flex-wrap:wrap;

    gap:12px;

    margin:40px 0 60px;

}



.pagination-wrapper a,
.pagination-wrapper span{

    display:inline-flex;

    justify-content:center;

    align-items:center;

    min-width:40px;

    padding:10px 12px;

    border-radius:6px;

    border:1px solid #1f2937;

    background:#111827;

    color:#e5e7eb;

    text-decoration:none;

    font-size:13px;

}



.pagination-wrapper .active{

    background:#22c55e;

    color:#000;

}



.pagination-wrapper .disabled{

    opacity:.4;

}



/* ================= FOOTER ================= */


.footer{

    background:
    linear-gradient(
        180deg,
        #0b0f19,
        #05070c
    );

    border-top:1px solid #1f2937;

    padding:50px 20px 25px;

}



.footer-grid{

    display:grid;

    grid-template-columns:
    2fr 2fr 2fr 1.5fr;

    gap:20px;

    max-width:1180px;

    margin:auto;

}



.footer h3{

    color:white;

    font-size:14px;

    text-transform:uppercase;

}



.footer p,
.footer a{

    color:#9ca3af;

    font-size:13px;

    text-decoration:none;

}



.footer a:hover{

    color:#22c55e;

}



.footer-bottom{

    text-align:center;

    margin-top:30px;

    padding-top:15px;

    border-top:1px solid #1f2937;

    color:#6b7280;

    font-size:12px;

}
        /* ================= MOBILE RESPONSIVE ================= */


@media(max-width:768px){


    /* HEADER */

    .header{

        padding:12px;

    }



    .header-content{

        flex-direction:row;

        justify-content:space-between;

        align-items:center;

        gap:10px;

    }



    .brand{

        gap:10px;

        width:auto;

    }



    .brand img{

        width:42px;

        height:42px;

    }



    .brand-text h1{

        font-size:16px;

    }



    .brand-text p{

        font-size:10px;

    }



    .trust-line{

        font-size:9px;

    }





    /* MOBILE MENU BUTTON RIGHT TOP */

    .nav-wrapper{

        position:relative;

        width:auto;

        margin-left:auto;

    }



    .nav-toggle{

        display:flex;

        width:42px;

        height:42px;

        background:#111827;

        border:1px solid var(--border);

        border-radius:10px;

    }





    /* DROPDOWN MENU */

    .nav-menu{

        display:none;

        position:absolute;

        right:0;

        top:52px;

        width:230px;

        background:#0b1220;

        border:1px solid var(--border);

        border-radius:12px;

        padding:12px;

        box-shadow:

        0 15px 40px rgba(0,0,0,.6);

        z-index:9999;

    }



    .nav-menu.open{

        display:flex;

        flex-direction:column;

        gap:8px;

    }



    .nav-menu a{

        width:100%;

        justify-content:flex-start;

        padding:12px;

        font-size:13px;

    }



    .nav-separator{

        display:none;

    }



    .actions{

        width:100%;

    }



    .user-menu{

        width:100%;

    }



    .btn-primary{

        width:100%;

    }



    .user-dropdown{

        position:relative;

        width:100%;

        top:8px;

    }





    /* SEARCH MOBILE FIX */


    .search-box{

        width:100%;

        padding:12px;

    }



    .search-box form{

        width:100%;

    }



    .search-input-wrapper{

        width:100%;

        max-width:100%;

        padding:6px!important;

        border-radius:14px!important;

    }



    .search-input-wrapper svg{

        width:15px;

        height:15px;

    }



    #search-input{

        width:100%;

        min-width:0;

        font-size:13px!important;

        padding:8px 4px!important;

    }



    #search-input::placeholder{

        font-size:11px;

    }



    #search-button{

        padding:8px 10px!important;

        font-size:12px;

        white-space:nowrap;

    }





    /* HERO */


    .hero{

        flex-direction:column;

        text-align:center;

        padding:22px 16px;

        width:100%;

    }



    .hero h2{

        font-size:22px;

    }



    .hero p{

        font-size:14px;

    }



    .hero-actions{

        justify-content:center;

        flex-wrap:wrap;

    }



    .hero-illustration{

        width:100%;

        height:120px;

    }





    /* PRODUCTS */


    .container{

        grid-template-columns:

        repeat(2,1fr);

        padding:10px;

        gap:10px;

    }



    .card{

        padding:10px;

    }



    .card img{

        height:130px;

    }



    .card h3{

        font-size:13px;

    }



    .product-brand{

        font-size:11px;

    }



    .whatsapp-btn{

        font-size:11px;

        padding:9px;

    }





    /* PAGINATION */


    .pagination-wrapper{

        margin:30px 10px;

        gap:6px;

    }



    .pagination-wrapper a,
    .pagination-wrapper span{

        min-width:34px;

        padding:8px;

        font-size:12px;

    }





    /* FOOTER */


    .footer{

        padding:35px 15px 20px;

    }



    .footer-grid{

        grid-template-columns:1fr;

        text-align:center;

        gap:25px;

    }


}





/* VERY SMALL PHONES */


@media(max-width:400px){



    .brand-text h1{

        font-size:14px;

    }



    .brand-text p{

        display:none;

    }



    .container{

        grid-template-columns:1fr;

    }



    .search-input-wrapper{

        border-radius:10px!important;

    }



    #search-button{

        padding:7px!important;

        font-size:11px;

    }



    .card img{

        height:170px;

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
            <img src="{{ asset('images/logo.png') }}" alt="Ubuntu Shop Logo">
            <div class="brand-text">
                <h1>Ubuntu Shop</h1>
                <p>Electronics you can trust</p>
                <div class="trust-line">✔ Verified Local Store</div>
            </div>
        </div>

        <!-- NAV -->
        <nav class="nav-wrapper" aria-label="Main navigation">
            <button id="nav-toggle" class="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Toggle navigation">
                <span class="hamburger" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
            <div id="main-nav" class="nav-menu" role="menubar">
                <a href="/" role="menuitem">Home</a>
                <a href="/#about" role="menuitem">About</a>
                <a href="/#contact" role="menuitem">Contact</a>
                <div class="nav-separator" aria-hidden="true"></div>
                <div class="actions">
                @auth
                    <div class="user-menu" style="position:relative;">
                        <button id="user-toggle" class="btn-primary" aria-expanded="false">{{ auth()->user()->name ?? 'Account' }}</button>
                        <div id="user-dropdown" class="user-dropdown" aria-hidden="true">
                            <a href="/profile">Profile</a>
                            <a href="/admin">Admin</a>
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="cta cta-primary" style="width:100%; margin-top:6px;">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="cta cta-primary" role="menuitem"></a>
                    <a href="/" class="cta cta-secondary" role="menuitem">Browse</a>
                @endauth
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- SEARCH -->
<div class="search-box">
    <form id="search-form" method="GET" action="/" style="max-width:820px; margin:0 auto;">
        <div class="search-input-wrapper" style="display:flex; gap:8px; align-items:center; background:var(--card); padding:8px; border-radius:999px; border:1px solid var(--border); box-shadow:0 6px 18px rgba(2,6,23,0.45);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="flex-shrink:0; opacity:0.9;" xmlns="http://www.w3.org/2000/svg"><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input id="search-input" type="search" name="search" placeholder="Search products by name or brand" value="{{ request('search') }}" style="flex:1; background:transparent; border:none; outline:none; color:inherit; padding:8px 6px; font-size:15px;">
            <button id="clear-search" type="button" aria-label="Clear search" style="display:none; background:transparent; border:none; color:var(--muted); cursor:pointer;">✕</button>
            <button id="search-button" type="submit" style="background:var(--accent); color:var(--accent-contrast); padding:8px 12px; border-radius:8px; border:none; font-weight:700;">Search</button>
        </div>
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
        href="https://wa.me/250789667181?text=Hello%20Ubuntu%20Shop,%20I%20am%20interested%20in%20{{ urlencode($product->name) }}"
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
        <div id="about">
            <h3>About Us</h3>
            <p>
                Ubuntu Shop provides quality electronics with warranty,
                trusted service, and fast customer support.
            </p>
        </div>

        <!-- CONTACT -->
        <div id="contact">
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

        const clearBtn = document.getElementById('clear-search');
        function toggleClear() {
            if (!searchInput || !clearBtn) return;
            clearBtn.style.display = searchInput.value.trim() === '' ? 'none' : 'inline-block';
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                updateButtonState();
                submitIfCleared();
                toggleClear();
            });
            searchInput.addEventListener('search', function () {
                updateButtonState();
                submitIfCleared();
                toggleClear();
            });
            searchInput.addEventListener('keyup', function () { updateButtonState(); toggleClear(); });
            setTimeout(function(){ updateButtonState(); toggleClear(); }, 0);
        }

        if (clearBtn && searchInput) {
            clearBtn.addEventListener('click', function (){ searchInput.value = ''; updateButtonState(); toggleClear(); searchInput.focus(); });
        }

        if (searchForm) {
            searchForm.addEventListener('submit', function () {
                if (searchInput && searchInput.value.trim() === '') {
                    searchInput.value = '';
                }
            });
        }

        // NAV TOGGLE (animated hamburger + responsive menu)
        const navToggle = document.getElementById('nav-toggle');
        const mainNav = document.getElementById('main-nav');
        if (navToggle && mainNav) {
            navToggle.addEventListener('click', function (e) {
                e.preventDefault();
                const expanded = navToggle.getAttribute('aria-expanded') === 'true';
                navToggle.setAttribute('aria-expanded', String(!expanded));
                navToggle.classList.toggle('open');
                mainNav.classList.toggle('open');
            });

            // highlight current link when possible
            const links = mainNav.querySelectorAll('a[role="menuitem"]');
            links.forEach(function (a) {
                try {
                    const href = a.getAttribute('href');
                    if (href === window.location.pathname || href === window.location.pathname + window.location.search || (href === '/' && window.location.pathname === '/')) {
                        a.classList.add('active');
                    }
                } catch (e) {
                    // ignore
                }
            });
        }

        // USER DROPDOWN
        const userToggle = document.getElementById('user-toggle');
        const userDropdown = document.getElementById('user-dropdown');
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                const expanded = userToggle.getAttribute('aria-expanded') === 'true';
                userToggle.setAttribute('aria-expanded', String(!expanded));
                userDropdown.classList.toggle('open');
            });

            // close dropdown when clicking outside
            document.addEventListener('click', function (ev) {
                if (!userDropdown.contains(ev.target) && ev.target !== userToggle) {
                    userDropdown.classList.remove('open');
                    userToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });
</script>

</body>
</html>
