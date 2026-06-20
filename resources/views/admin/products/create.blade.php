@extends('layouts.admin')

@section('content')

<style>
    body {
        background-color: #0f0f0f;
        color: #ffffff;
    }

    .form-wrapper {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .form-card {
        width: 100%;
        max-width: 800px;
        background: #0b0f19;
        border: 1px solid #1f2937;
        border-radius: 12px;
        padding: 25px;
    }

    .form-title {
        color: #fff;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-input {
        width: 100%;
        background: #111827;
        border: 1px solid #374151;
        color: #fff;
        padding: 10px 12px;
        border-radius: 8px;
        outline: none;
    }

    .form-input:focus {
        border-color: #22c55e;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
    }

    .error-text {
        color: #ef4444;
        font-size: 12px;
    }

    .error-box {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid #ef4444;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .preview-box {
        margin-top: 15px;
    }

    .preview-box img {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        border: 1px solid #374151;
        display: none;
        object-fit: cover;
    }

    .btn-save {
        margin-top: 20px;
        width: 100%;
        background: #22c55e;
        border: none;
        padding: 12px;
        border-radius: 8px;
        color: #000;
        font-weight: 600;
        cursor: pointer;
    }
</style>

<div class="form-wrapper">

    <div class="form-card">

        <h2 class="form-title">Add Product</h2>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/admin/products" enctype="multipart/form-data" id="productForm">
            @csrf

            <div class="form-grid">

                <input type="text" name="name" placeholder="Product Name"
                    class="form-input" value="{{ old('name') }}">

                <input type="text" name="brand" placeholder="Brand"
                    class="form-input" value="{{ old('brand') }}">

                <input type="text" id="buying_price" name="buying_price" placeholder="Buying Price"
                    class="form-input" value="{{ old('buying_price') }}">

                <input type="text" id="selling_price" name="selling_price" placeholder="Selling Price"
                    class="form-input" value="{{ old('selling_price') }}">

                <input type="number" name="quantity" placeholder="Quantity"
                    class="form-input" value="{{ old('quantity') }}">

                <!-- FIX: description was missing -->
                <textarea name="description"
                    placeholder="Product Description"
                    class="form-input"
                    style="grid-column: span 2; height: 90px;">{{ old('description') }}</textarea>

                <input type="file" name="image" id="imageInput" class="form-input">

            </div>

            {{-- Image preview --}}
            <div class="preview-box">
                <img id="previewImg">
            </div>

            <button type="submit" class="btn-save">Save Product</button>

        </form>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const imageInput = document.getElementById('imageInput');
    const previewImg = document.getElementById('previewImg');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }

    function cleanNumber(value) {
        return value ? value.replace(/,/g, '') : '';
    }

    const buying = document.getElementById("buying_price");
    const selling = document.getElementById("selling_price");

    function format(input) {
        let value = input.value.replace(/,/g, '');
        if (!isNaN(value) && value !== '') {
            input.value = Number(value).toLocaleString();
        }
    }

    if (buying) buying.addEventListener("blur", () => format(buying));
    if (selling) selling.addEventListener("blur", () => format(selling));

    document.getElementById("productForm").addEventListener("submit", function () {
        if (buying) buying.value = cleanNumber(buying.value);
        if (selling) selling.value = cleanNumber(selling.value);
    });

});
</script>

@endsection