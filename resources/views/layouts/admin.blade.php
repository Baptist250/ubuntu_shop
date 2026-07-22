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

}



/* HEADER */

.top-header{

    background:#0f0f0f;
    border-bottom:1px solid #1e293b;

    padding:18px 25px;

    position:sticky;
    top:0;

    z-index:1000;

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

    width:52px;
    height:52px;

    border-radius:14px;

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



/* RIGHT */


.header-right{

    display:flex;

    align-items:center;

    gap:20px;

}



.search-box{

    width:300px;

    background:#111827;

    border:1px solid #334155;

    color:white;

}



.search-box:focus{

    background:#111827;

    color:white;

    border-color:#22c55e;

    box-shadow:none;

}



/* PROFILE ICON */


.profile-wrapper{

    position:relative;

}



.profile-icon{

    width:45px;

    height:45px;

    border-radius:50%;

    background:#111827;

    border:1px solid #334155;

    display:flex;

    align-items:center;

    justify-content:center;

    cursor:pointer;

    color:#22c55e;

    font-size:20px;

}



.profile-icon:hover{

    background:#1e293b;

}



/* DROPDOWN */


.profile-menu{

    position:absolute;

    right:0;

    top:55px;

    width:230px;

    background:#111827;

    border:1px solid #334155;

    border-radius:14px;

    padding:15px;

    display:none;

}



.profile-wrapper:hover .profile-menu{

    display:block;

}



.profile-name{

    font-weight:700;

    color:white;

}



.profile-link{

    color:#cbd5e1;

    text-decoration:none;

    display:block;

    padding:8px 0;

}



.profile-link:hover{

    color:#22c55e;

}



.logout-btn{

    width:100%;

    margin-top:10px;

}



/* MENU */


.menu-bar{

    display:flex;

    gap:5px;

    overflow-x:auto;

    border-bottom:1px solid #1e293b;

}



.menu-link{

    padding:16px 20px;

    color:#cbd5e1;

    text-decoration:none;

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


    .header-container{

        flex-direction:column;

        gap:15px;

    }


    .brand-area{

        width:100%;

        justify-content:center;

    }


    .header-right{

        width:100%;

        justify-content:space-between;

    }


    .search-box{

        width:85%;

    }



    .profile-menu{

        right:0;

    }



    .menu-link{

        padding:14px 18px;

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



<!-- LOGO -->

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




<!-- RIGHT AREA -->


<div class="header-right">


<input type="text"
class="form-control search-box"
placeholder="Search products...">



<!-- PROFILE -->


<div class="profile-wrapper">


<div class="profile-icon">

👤

</div>



<div class="profile-menu">


<div class="profile-name">

{{ auth()->user()->name ?? 'Admin' }}

</div>



<a href="{{ route('profile.edit') }}"
class="profile-link">

⚙ Account Settings

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



</div>


</header>




<!-- NAVIGATION -->


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


<script>

</script>


</body>

</html>
