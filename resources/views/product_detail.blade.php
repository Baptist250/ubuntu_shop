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
            width: calc(100% - 30px);
            margin: 30px auto;
            background: #111827;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #1f2937;
        }


        h1 {
            margin-top: 15px;
            word-break: break-word;
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
            word-break: break-word;
        }


        /* SMALL PRODUCT IMAGE */
        .product-image {

            width: 150px;
            height: 150px;

            object-fit: cover;

            display: block;

            margin: 0 auto;

            border-radius: 10px;

            border: 1px solid #1f2937;

            max-width:100%;

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

            text-align:center;

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





        /* MOBILE RESPONSIVE ONLY */

        @media(max-width:600px){


            .container{

                width:calc(100% - 20px);

                margin:10px auto;

                padding:15px;

                border-radius:10px;

            }



            .product-image{

                width:120px;

                height:120px;

            }



            h1{

                font-size:24px;

                text-align:center;

            }



            .brand,
            .stock{

                font-size:15px;

            }



            .desc{

                font-size:15px;

                line-height:1.6;

            }



            .whatsapp-btn{

                width:100%;

                padding:14px;

                font-size:15px;

            }



            .back{

                display:block;

                text-align:center;

                margin-top:18px;

            }


        }





        @media(max-width:360px){


            .container{

                padding:12px;

            }



            .product-image{

                width:100px;

                height:100px;

            }



            h1{

                font-size:21px;

            }



            .whatsapp-btn{

                font-size:14px;

            }


        }


    </style>

</head>


<body>


<div class="container">


    @if($product->image)

        <a href="{{ asset('storage/' . $product->image) }}" target="_blank">

            <img 
                class="product-image"
                src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}">

        </a>

    @endif



    <h1>
        {{ $product->name }}
    </h1>



    <p class="brand">

        <strong>Brand:</strong> 

        {{ $product->brand }}

    </p>


    <p class="stock">

        Stock available: 

        {{ $product->quantity }}

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




    <a class="back" href="/">

        ← Back to shop

    </a>



</div>


</body>

</html>
