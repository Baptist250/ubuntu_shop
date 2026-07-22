<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ubuntu Shop</title>


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
    --card:#111827;
    --border:#1f2937;
    --glass:rgba(255,255,255,0.03);
}


body{

    font-family:'Inter',ui-sans-serif,system-ui,-apple-system,
    'Segoe UI',Roboto,'Helvetica Neue',Arial;

    background:var(--bg);
    color:#e5e7eb;

    overflow-x:hidden;

}


/* ================= PAGE ================= */

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

    padding:18px 20px;

    border-bottom:1px solid var(--border);

    position:sticky;

    top:0;

    z-index:80;

}


.header-content{

    max-width:1180px;

    margin:auto;

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:20px;

}



.brand{

    display:flex;

    align-items:center;

    gap:15px;

}



.brand img{

    width:45px;

    height:45px;

    border-radius:12px;

    object-fit:cover;

}



.brand-text h1{

    margin:0;

    font-size:18px;

    font-weight:800;

}


.brand-text p{

    margin:2px 0;

    font-size:12px;

    color:var(--muted);

}



.trust-line{

    color:var(--accent);

    font-size:12px;

}



/* ================= NAV ================= */


.nav-wrapper{

    display:flex;

    align-items:center;

}


.nav-menu{

    display:flex;

    align-items:center;

    gap:10px;

}



.nav-menu a{

    color:var(--muted);

    text-decoration:none;

    font-size:13px;

    font-weight:600;

    padding:10px 14px;

    border-radius:8px;

}



.nav-menu a:hover,

.nav-menu a.active{

    color:var(--accent);

    background:rgba(34,197,94,.12);

}



.nav-separator{

    width:1px;

    height:25px;

    background:var(--border);

}



/* ================= BUTTONS ================= */


.cta{

    padding:8px 14px;

    border-radius:10px;

    text-decoration:none;

    font-weight:700;

}



.cta-primary{

    background:var(--accent);

    color:black;

}



.cta-secondary{

    border:1px solid var(--border);

    color:var(--muted);

}



.btn-primary{

    background:var(--accent);

    color:#000;

    padding:8px 14px;

    border-radius:10px;

    border:none;

    font-weight:700;

}



/* ================= HAMBURGER ================= */


.nav-toggle{

    display:none;

    background:none;

    border:none;

    cursor:pointer;

}



.hamburger{

    display:flex;

    flex-direction:column;

    gap:5px;

}



.hamburger span{

    width:24px;

    height:2px;

    background:white;

}



/* ================= SEARCH ================= */


.search-box{

    padding:20px;

}



.search-box input{

    max-width:100%;

}



/* ================= PRODUCTS ================= */


.container{

    width:100%;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(230px,1fr));

    gap:15px;

    padding:20px;

}



.card{

    background:var(--card);

    border:1px solid var(--border);

    border-radius:12px;

    overflow:hidden;

}



.card img{

    width:100%;

    height:180px;

    object-fit:cover;

}



.card-body{

    padding:12px;

}



.whatsapp-btn{

    width:100%;

}



/* ================= FOOTER ================= */


.footer-grid{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:25px;

}



/* ================= PAGINATION ================= */


.pagination-wrapper{

    display:flex;

    justify-content:center;

    align-items:center;

    flex-wrap:wrap;

    gap:10px;

    margin:40px 0;

}


.pagination-wrapper a,
.pagination-wrapper span{

    min-width:38px;

    padding:9px;

}





/* ================================================= */
/* ================= MOBILE ======================== */
/* ================================================= */


@media(max-width:768px){



.header{

    padding:15px;

}



.header-content{

    flex-direction:row;

    align-items:center;

}



.brand{

    gap:10px;

}



.brand img{

    width:42px;

    height:42px;

}



.brand-text h1{

    font-size:16px;

}



.brand-text p,

.trust-line{

    display:none;

}




/* MOBILE MENU */


.nav-toggle{

    display:flex;

}



.nav-menu{

    display:none;

    position:absolute;

    top:75px;

    left:0;

    right:0;

    background:#0b1220;

    padding:20px;

    flex-direction:column;

    border-bottom:1px solid var(--border);

}



.nav-menu.open{

    display:flex;

}



.nav-menu a{

    width:100%;

    text-align:center;

}



/* SEARCH */


.search-box{

    padding:15px 10px;

}


.search-input-wrapper{

    width:100%;

}



#search-button{

    padding:8px 10px!important;

}





/* PRODUCTS */


.container{

    grid-template-columns:

    repeat(2,1fr);

    padding:10px;

    gap:10px;

}



.card img{

    height:140px;

}



.card h3{

    font-size:14px;

}




/* FOOTER */


.footer{

    padding:35px 15px 20px;

}



.footer-grid{

    grid-template-columns:1fr;

    text-align:center;

}





/* PAGINATION */


.pagination-wrapper{

    padding:0 10px;

}


.pagination-wrapper a,
.pagination-wrapper span{

    font-size:12px;

    padding:8px;

}


}




@media(max-width:420px){


.container{

    grid-template-columns:1fr;

}



.card img{

    height:200px;

}



.brand-text h1{

    font-size:15px;

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
