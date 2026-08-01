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

                <div style="grid-column: span 2;">
                    <label style="display:block;margin-bottom:6px;color:#9ca3af;font-size:13px;">Select existing product</label>
                    <select id="existing_product_id" name="existing_product_id" class="form-input">
                        <option value="" {{ old('existing_product_id') ? '' : 'selected' }}>Create new product</option>
                        @foreach($products as $existing)
                            <option value="{{ $existing->id }}" {{ old('existing_product_id') == $existing->id ? 'selected' : '' }} data-name="{{ $existing->name }}" data-brand="{{ $existing->brand }}" data-buying_price="{{ $existing->buying_price }}" data-selling_price="{{ $existing->selling_price }}" data-quantity="{{ $existing->quantity }}" data-description="{{ $existing->description }}">{{ $existing->name }} - {{ $existing->brand }}</option>
                        @endforeach
                    </select>
                    <p style="margin-top:10px;color:#9ca3af;font-size:13px;line-height:1.4;">Choose an existing product to load its current values. Saving will update the selected product instead of creating a duplicate.</p>
                </div>

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

                <input type="file" name="image" id="imageInput" class="form-input" style="padding-top: 9px;">

                <!-- FIX: description was missing -->
                <textarea name="description"
                    placeholder="Product Description"
                    class="form-input"
                    style="grid-column: span 2; height: 90px;">{{ old('description') }}</textarea>

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

    const existingSelect = document.getElementById('existing_product_id');
    if (existingSelect) {
        existingSelect.addEventListener('change', function () {
            const selected = this.selectedOptions[0];
            const nameField = document.querySelector('input[name="name"]');
            const brandField = document.querySelector('input[name="brand"]');
            const buyingField = document.querySelector('input[name="buying_price"]');
            const sellingField = document.querySelector('input[name="selling_price"]');
            const quantityField = document.querySelector('input[name="quantity"]');
            const descriptionField = document.querySelector('textarea[name="description"]');

            if (!selected || !selected.value) {
                nameField.value = '';
                brandField.value = '';
                buyingField.value = '';
                sellingField.value = '';
                quantityField.value = '';
                descriptionField.value = '';
                return;
            }

            nameField.value = selected.dataset.name || '';
            brandField.value = selected.dataset.brand || '';
            buyingField.value = selected.dataset.buying_price || '';
            sellingField.value = selected.dataset.selling_price || '';
            quantityField.value = selected.dataset.quantity || '';
            descriptionField.value = selected.dataset.description || '';
        });

        if (existingSelect.value) {
            existingSelect.dispatchEvent(new Event('change'));
        }
    }

    document.getElementById("productForm").addEventListener("submit", function () {
        if (buying) buying.value = cleanNumber(buying.value);
        if (selling) selling.value = cleanNumber(selling.value);
    });

});
</script>

@endsection