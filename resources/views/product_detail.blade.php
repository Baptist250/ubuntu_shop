<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Ubuntu Shop</title>

    <!-- WhatsApp Icon CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial;
            background: #0f0f0f;
            margin: 0;
            color: #e5e7eb;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #111827;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #1f2937;
        }

        h1 {
            margin-top: 15px;
        }

        .brand {
            color: #9ca3af;
        }

        .stock {
            color: #9ca3af;
        }

        .desc {
            margin-top: 15px;
            color: #d1d5db;
            line-height: 1.5;
        }

        /* WhatsApp Button */
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

        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #60a5fa;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            border: 1px solid #1f2937;
        }
    </style>
</head>

<body>

<div class="container">

    @if($product->image)
        <a href="{{ asset('storage/' . $product->image) }}" target="_blank">
            <img src="{{ asset('storage/' . $product->image) }}">
        </a>
    @endif

    <h1>{{ $product->name }}</h1>

    <p class="brand"><strong>Brand:</strong> {{ $product->brand }}</p>

    <!-- ❌ PRICE REMOVED -->

    <p class="stock">
        Stock available: {{ $product->quantity }}
    </p>

    <p class="desc">
        {{ $product->description }}
    </p>

    
    <a
        class="whatsapp-btn"
        href="https://wa.me/250791108268?text=Hello%20Ubuntu%20Shop,%20I%20am%20interested%20in%20{{ urlencode($product->name) }}"
        target="_blank">

        <i class="fab fa-whatsapp"></i>
        Ask Price on WhatsApp
    </a>

    <a class="back" href="/">← Back to shop</a>

</div>

</body>
</html>