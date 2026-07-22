<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ubuntu Shop</title>


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">



<style>


*,
*::before,
*::after{

    margin:0;
    padding:0;
    box-sizing:border-box;

}



:root{

    --bg:#0f1724;
    --surface:#0b1220;
    --card:#111827;
    --border:#1f2937;
    --muted:#9ca3af;
    --accent:#22c55e;

}



html,body{

    min-height:100%;

}



body{

    background:var(--bg);

    color:#e5e7eb;

    font-family:'Inter',sans-serif;

    overflow-x:hidden;

    -webkit-font-smoothing:antialiased;

}



.page-wrapper{

    min-height:100vh;

    display:flex;

    flex-direction:column;

}



.main-content{

    width:min(1180px,100%);

    margin:auto;

    flex:1;

}



/* ================= HEADER ================= */


.header{

    background:var(--surface);

    border-bottom:1px solid var(--border);

    position:sticky;

    top:0;

    z-index:1000;

    box-shadow:0 5px 20px rgba(0,0,0,.35);

}



.header-content{

    max-width:1180px;

    margin:auto;

    padding:18px 20px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

}



/* BRAND */


.brand{

    display:flex;

    align-items:center;

    gap:14px;

}



.brand img{

    width:50px;

    height:50px;

    border-radius:12px;

    object-fit:cover;

}



.brand-text h1{

    font-size:20px;

    font-weight:800;

    margin:0;

}



.brand-text p{

    font-size:12px;

    color:var(--muted);

}



.trust-line{

    font-size:12px;

    color:var(--accent);

}



/* NAVIGATION */


.nav-wrapper{

    display:flex;

    align-items:center;

}



.nav-menu{

    display:flex;

    align-items:center;

    gap:8px;

}



.nav-menu a{

    text-decoration:none;

    color:var(--muted);

    font-size:13px;

    font-weight:600;

    padding:10px 14px;

    border-radius:8px;

    transition:.2s;

}



.nav-menu a:hover,
.nav-menu a.active{

    color:var(--accent);

    background:rgba(34,197,94,.1);

}



.nav-separator{

    width:1px;

    height:25px;

    background:var(--border);

}



.actions{

    display:flex;

    align-items:center;

}



.cta{

    padding:9px 16px;

    border-radius:10px;

    text-decoration:none;

    font-weight:700;

}



.cta-primary{

    background:var(--accent);

    color:#000;

}



.cta-secondary{

    border:1px solid var(--border);

    color:white;

}





/* USER DROPDOWN */


.user-dropdown{

    position:absolute;

    right:0;

    top:45px;

    width:200px;

    background:var(--card);

    border:1px solid var(--border);

    border-radius:12px;

    padding:10px;

    display:none;

}



.user-dropdown.open{

    display:block;

}



.user-dropdown a{

    display:block;

    padding:10px;

}



.btn-primary{

    background:var(--accent);

    border:none;

    padding:9px 15px;

    border-radius:10px;

    font-weight:700;

}





/* HAMBURGER */


.nav-toggle{

    display:none;

    background:none;

    border:none;

    color:white;

    font-size:25px;

}





/* ================= HERO ================= */


.hero{

    margin:25px 20px;

    padding:35px;

    background:linear-gradient(
        90deg,
        rgba(12,14,22,.8),
        rgba(8,10,16,.8)
    );

    border:1px solid var(--border);

    border-radius:18px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

}



.hero h2{

    font-size:32px;

    font-weight:800;

}



.hero p{

    color:var(--muted);

    margin-top:10px;

}



.hero-illustration{

    width:220px;

    height:130px;

    border-radius:15px;

    border:1px solid var(--border);

    display:flex;

    align-items:center;

    justify-content:center;

    color:var(--muted);

}





/* ================= SEARCH ================= */


.search-box{

    padding:15px 20px 25px;

}



.search-input-wrapper{

    max-width:800px;

    margin:auto;

    display:flex;

    align-items:center;

    gap:10px;

    background:var(--card);

    border:1px solid var(--border);

    padding:8px 12px;

    border-radius:50px;

}



.search-input-wrapper input{

    flex:1;

    background:none;

    border:none;

    outline:none;

    color:white;

    font-size:15px;

}



.search-input-wrapper button{

    background:var(--accent);

    border:none;

    padding:10px 16px;

    border-radius:10px;

    font-weight:700;

}





/* ================= MOBILE ================= */


@media(max-width:768px){


.header-content{

    padding:15px;

}



.brand img{

    width:42px;

    height:42px;

}



.brand-text h1{

    font-size:17px;

}



.trust-line{

    display:none;

}



/* menu */


.nav-toggle{

    display:block;

}



.nav-menu{

    position:absolute;

    top:70px;

    left:0;

    width:100%;

    background:var(--surface);

    padding:20px;

    display:none;

    flex-direction:column;

    border-bottom:1px solid var(--border);

}



.nav-menu.open{

    display:flex;

}



.nav-menu a{

    width:100%;

}



/* hero */


.hero{

    margin:15px;

    padding:25px 18px;

    flex-direction:column;

    text-align:center;

}



.hero h2{

    font-size:24px;

}



.hero-illustration{

    width:100%;

    height:120px;

}



/* search */


.search-box{

    padding:10px 15px 20px;

}



.search-input-wrapper{

    border-radius:15px;

    flex-wrap:wrap;

}



.search-input-wrapper button{

    width:100%;

}


}



@media(max-width:400px){


.brand-text p{

    display:none;

}


.hero h2{

    font-size:21px;

}


}



</style>


</head>


<body>


<div class="page-wrapper">



<!-- HEADER -->

<div class="header">


<div class="header-content">



<div class="brand">


<img src="{{ asset('images/logo.png') }}" 
alt="Ubuntu Shop Logo">



<div class="brand-text">

<h1>Ubuntu Shop</h1>

<p>Electronics you can trust</p>

<div class="trust-line">
✔ Verified Local Store
</div>


</div>


</div>




<nav class="nav-wrapper">


<button class="nav-toggle" id="nav-toggle">

☰

</button>



<div class="nav-menu" id="main-nav">


<a href="/" class="active">
Home
</a>


<a href="/#about">
About
</a>


<a href="/#contact">
Contact
</a>



<div class="nav-separator"></div>



<div class="actions">


@auth


<div style="position:relative">


<button id="user-toggle" class="btn-primary">

{{ auth()->user()->name ?? 'Account' }}

</button>



<div id="user-dropdown" class="user-dropdown">


<a href="/profile">
Profile
</a>


<a href="/admin">
Admin
</a>


<form method="POST" action="{{ route('logout') }}">

@csrf


<button class="cta cta-primary w-100">

Logout

</button>


</form>


</div>


</div>


@else


<a href="/login" class="cta cta-primary">
Login
</a>


@endauth


</div>



</div>


</nav>


</div>


</div>





<!-- SEARCH -->


<div class="search-box">


<form method="GET" action="/">


<div class="search-input-wrapper">


<input 
type="search"
name="search"
placeholder="Search products..."
value="{{ request('search') }}">



<button>

Search

</button>


</div>


</form>


</div>
