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
            color:#fff;
            font-family:'Segoe UI',sans-serif;
            min-height:100vh;
        }

        /* HEADER */

        .top-header{
            background:#0f0f0f;
            border-bottom:1px solid rgba(148,163,184,.12);
            padding:16px 24px;
            position:sticky;
            top:0;
            z-index:1000;
        }

        .logo-img{
            width:48px;
            height:48px;
            border-radius:14px;
            object-fit:cover;
            border:1px solid rgba(255,255,255,.08);
        }

        .brand-title{
            font-size:24px;
            font-weight:800;
            margin:0;
            color:#f8fafc;
        }

        .brand-sub{
            color:#94a3b8;
            font-size:13px;
            margin-top:4px;
        }

        .top-header-right{
            display:flex;
            align-items:center;
            gap:16px;
            flex-wrap:wrap;
        }

        .user-card{
            background:#111827;
            border:1px solid rgba(148,163,184,.15);
            border-radius:14px;
            padding:10px 14px;
            display:flex;
            align-items:center;
            gap:12px;
        }

        .user-avatar{
            width:44px;
            height:44px;
            border-radius:50%;
            background:#0f172a;
            color:#22c55e;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:16px;
        }

        .user-meta{
            display:flex;
            flex-direction:column;
            gap:2px;
        }

        .user-name{
            color:#f8fafc;
            font-weight:700;
            font-size:14px;
        }

        .profile-link{
            color:#cbd5e1;
            font-size:13px;
            text-decoration:none;
        }

        .profile-link:hover{
            color:#22c55e;
            text-decoration:none;
        }

        /* SEARCH */

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

        /* ADMIN BADGE */

        .admin-badge{
            background:#14532d;
            color:#86efac;
            padding:8px 14px;
            border-radius:50px;
            font-size:13px;
            font-weight:600;
        }

        /* LOGOUT */

        .logout-btn{
            border-radius:10px;
        }

        /* NAVIGATION */

        .menu-bar{
            background: #0f0f0f;;
            border-bottom:1px solid #1e293b;
            display:flex;
            flex-wrap:wrap;
            gap:5px;
            padding:0 15px;
        }

        .menu-link{
            color:#cbd5e1;
            text-decoration:none;
            padding:16px 20px;
            display:flex;
            align-items:center;
            gap:8px;
            transition:.3s;
            border-bottom:3px solid transparent;
        }

        .menu-link:hover{
            background:#111827;
            color:#22c55e;
        }

        .menu-active{
            color:#22c55e !important;
            border-bottom:3px solid #22c55e;
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

            .search-box{
                width:100%;
            }

            .menu-link{
                padding:12px;
                font-size:14px;
            }

            .page-content{
                padding:15px;
            }
        }

    </style>
</head>

<body>

<!-- HEADER -->
<div class="top-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo.png') }}"
                 class="logo-img"
                 alt="Ubuntu Shop">

            <div>
                <h4 class="brand-title">Ubuntu Shop</h4>
                <div class="brand-sub">Modern Electronics & Inventory Management</div>
            </div>
        </div>

        <div class="top-header-right">
            <input type="text"
                   class="form-control search-box"
                   placeholder="Search products...">

            <div class="user-card">
                @if(auth()->user()->profile_photo_url)
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar" class="user-avatar" />
                @else
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                @endif
                <div class="user-meta">
                    <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <a href="{{ route('profile.edit') }}" class="profile-link">Account Settings</a>
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
</div>

<!-- NAVIGATION -->
<div class="menu-bar">

    <a href="/admin"
       class="menu-link {{ request()->is('admin') ? 'menu-active' : '' }}">
        Dashboard
    </a>

    <a href="/admin/pos"
       class="menu-link {{ request()->is('admin/pos*') ? 'menu-active' : '' }}">
        POS
    </a>

    <a href="/admin/products"
       class="menu-link {{ request()->is('admin/products*') ? 'menu-active' : '' }}">
        Products
    </a>

    <a href="/admin/inventory"
       class="menu-link {{ request()->is('admin/inventory*') ? 'menu-active' : '' }}">
        Inventory
    </a>

    <a href="/admin/sales"
       class="menu-link {{ request()->is('admin/sales*') ? 'menu-active' : '' }}">
        Sales
    </a>

    <a href="/admin/reports"
       class="menu-link {{ request()->is('admin/reports*') ? 'menu-active' : '' }}">
        Reports
    </a>

</div>

<!-- PAGE CONTENT -->
<div class="page-content">
    @yield('content')
</div>

@stack('scripts')

</body>
</html>
