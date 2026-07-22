<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ubuntu Shop Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    background:#0f0f0f;
    color:white;
    font-family:'Segoe UI',sans-serif;
    overflow-x:hidden;

}


/* HEADER */

.top-header{

    background:#0f0f0f;
    border-bottom:1px solid #1e293b;
    padding:18px 25px;

}



.header-container{

    display:flex;
    justify-content:space-between;
    align-items:center;

}


/* BRAND */


.brand-area{

    display:flex;
    align-items:center;
    gap:15px;

}


.logo-img{

    width:55px;
    height:55px;
    border-radius:15px;
    object-fit:cover;

}


.brand-title{

    font-size:25px;
    font-weight:800;
    margin:0;

}


.brand-sub{

    color:#94a3b8;
    font-size:13px;

}




/* PROFILE ICON */


.profile-dropdown{

    position:relative;

}



.profile-icon{

    width:48px;
    height:48px;

    border-radius:50%;

    background:#111827;

    border:1px solid #334155;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#22c55e;

    font-size:20px;

    cursor:pointer;

}



.profile-menu{

    position:absolute;

    right:0;

    top:60px;

    width:220px;

    background:#111827;

    border:1px solid #334155;

    border-radius:14px;

    padding:15px;

    display:none;

    z-index:2000;

}



.profile-dropdown:hover .profile-menu{

    display:block;

}



.profile-name{

    color:white;

    font-weight:700;

}



.profile-link{

    color:#cbd5e1;

    text-decoration:none;

    display:block;

    padding:10px 0;

}



.profile-link:hover{

    color:#22c55e;

}



.logout-btn{

    width:100%;

}



/* MENU */


.menu-bar{

    display:flex;

    gap:5px;

    padding:0 20px;

    border-bottom:1px solid #1e293b;

    overflow-x:auto;

}



.menu-link{

    color:#cbd5e1;

    text-decoration:none;

    padding:16px 20px;

    white-space:nowrap;

}



.menu-link:hover{

    color:#22c55e;

    background:#111827;

}



.menu-active{

    color:#22c55e!important;

    border-bottom:3px solid #22c55e;

}



/* CONTENT */


.page-content{

    padding:25px;

}




/* MOBILE */


@media(max-width:768px){


.top-header{

    padding:15px;

}


.header-container{

    flex-direction:row;

}


.brand-area{

    gap:10px;

}



.logo-img{

    width:45px;
    height:45px;

}


.brand-title{

    font-size:19px;

}


.brand-sub{

    display:none;

}


.profile-icon{

    width:42px;
    height:42px;

}


.menu-bar{

    padding:0;

}


.menu-link{

    padding:14px 16px;

    font-size:14px;

}


.page-content{

    padding:15px;

}


}



</style>

</head>


<body>



<header class="top-header">


<div class="header-container">


<div class="brand-area">


<img src="{{ asset('images/logo.png') }}"
class="logo-img"
alt="Ubuntu Shop">


<div>

<h4 class="brand-title">
Ubuntu Shop
</h4>


<div class="brand-sub">
Modern Electronics & Inventory Management
</div>


</div>


</div>




<!-- PROFILE -->

<div class="profile-dropdown">


<div class="profile-icon">

👤

</div>



<div class="profile-menu">


<div class="profile-name">

{{ auth()->user()->name ?? 'Admin' }}

</div>


<hr>


<a href="{{ route('profile.edit') }}"
class="profile-link">

Account Settings

</a>



<form method="POST" action="/logout">

@csrf

<button class="btn btn-danger logout-btn">

Logout

</button>


</form>


</div>


</div>



</div>


</header>





<nav class="menu-bar">


<a href="/admin"
class="menu-link">
Dashboard
</a>


<a href="/admin/pos"
class="menu-link">
POS
</a>


<a href="/admin/products"
class="menu-link">
Products
</a>


<a href="/admin/inventory"
class="menu-link">
Inventory
</a>


<a href="/admin/sales"
class="menu-link">
Sales
</a>


<a href="/admin/reports"
class="menu-link">
Reports
</a>


</nav>




<div class="page-content">

@yield('content')

</div>



@stack('scripts')


</body>

</html>
