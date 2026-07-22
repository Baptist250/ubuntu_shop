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
    position:sticky;
    top:0;
    z-index:1000;

}



.header-container{

    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;

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



/* RIGHT AREA */


.header-actions{

    display:flex;
    align-items:center;
    gap:15px;

}



.search-box{

    width:280px;
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



.user-card{

    display:flex;
    align-items:center;
    gap:10px;

    background:#111827;
    border:1px solid #334155;

    padding:8px 14px;
    border-radius:14px;

}



.user-avatar{

    width:45px;
    height:45px;

    border-radius:50%;

    background:#0f172a;
    color:#22c55e;

    display:flex;
    justify-content:center;
    align-items:center;

    font-weight:bold;

}



.user-name{

    font-weight:700;
    font-size:14px;

}


.profile-link{

    color:#94a3b8;
    text-decoration:none;
    font-size:13px;

}



.logout-btn{

    border-radius:10px;

}




/* MENU */


.menu-bar{

    display:flex;

    gap:5px;

    background:#0f0f0f;

    border-bottom:1px solid #1e293b;

    padding:0 20px;

    overflow-x:auto;

}



.menu-link{

    color:#cbd5e1;

    text-decoration:none;

    padding:16px 20px;

    white-space:nowrap;

    border-bottom:3px solid transparent;

}



.menu-link:hover{

    color:#22c55e;
    background:#111827;

}



.menu-active{

    color:#22c55e!important;

    border-bottom-color:#22c55e;

    background:#111827;

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

        flex-direction:column;

        align-items:stretch;

    }



    .brand-area{

        flex-direction:column;

        text-align:center;

    }



    .logo-img{

        width:70px;
        height:70px;

    }



    .brand-title{

        font-size:22px;

    }



    .header-actions{

        flex-direction:column;

        width:100%;

    }



    .search-box{

        width:100%;

        height:45px;

    }



    .user-card{

        width:100%;

        justify-content:center;

    }



    .logout-btn{

        width:100%;

        padding:12px;

    }



    .menu-bar{

        padding:0;

    }



    .menu-link{

        padding:14px 18px;

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


    <!-- BRAND -->

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




    <!-- ACTIONS -->


    <div class="header-actions">


        <input type="text"
               class="form-control search-box"
               placeholder="Search products...">



        <div class="user-card">


            <div class="user-avatar">

                {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}

            </div>


            <div>

                <div class="user-name">

                    {{ auth()->user()->name ?? 'Admin' }}

                </div>


                <a href="{{ route('profile.edit') }}"
                   class="profile-link">

                    Account Settings

                </a>


            </div>


        </div>




        <form method="POST" action="/logout">

            @csrf

            <button class="btn btn-outline-danger logout-btn">

                Logout

            </button>


        </form>


    </div>


</div>


</header>




<nav class="menu-bar">


<a href="/admin" class="menu-link">
Dashboard
</a>


<a href="/admin/pos" class="menu-link">
POS
</a>


<a href="/admin/products" class="menu-link">
Products
</a>


<a href="/admin/inventory" class="menu-link">
Inventory
</a>


<a href="/admin/sales" class="menu-link">
Sales
</a>


<a href="/admin/reports" class="menu-link">
Reports
</a>


</nav>




<div class="page-content">

@yield('content')

</div>



@stack('scripts')


</body>

</html>
