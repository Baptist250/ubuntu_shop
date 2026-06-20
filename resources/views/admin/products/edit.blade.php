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

    .full-row {
        grid-column: span 2;
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

    .image-row {
        display: flex;
        gap: 20px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .image-box {
        flex: 1;
        min-width: 200px;
        background: #111827;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #374151;
    }

    .image-box p {
        margin-bottom: 8px;
        color: #e5e7eb;
        font-size: 13px;
    }

    .previewable-image {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        border: 1px solid #374151;
        object-fit: cover;
        cursor: pointer;
        transition: 0.3s;
    }

    .previewable-image:hover {
        transform: scale(1.05);
    }

    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(0,0,0,0.95);
        justify-content: center;
        align-items: center;
    }

    .modal-image {
        max-width: 90%;
        max-height: 90%;
        border-radius: 12px;
        border: 2px solid #374151;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 40px;
        cursor: pointer;
        font-weight: bold;
    }
</style>

<div class="form-wrapper">

    <div class="form-card">

        <h2 class="form-title">Edit Product</h2>

        <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <input type="text" name="name" value="{{ $product->name }}" class="form-input">
                <input type="text" name="brand" value="{{ $product->brand }}" class="form-input">

                <input type="text" name="buying_price" value="{{ $product->buying_price }}" class="form-input">
                <input type="text" name="selling_price" value="{{ $product->selling_price }}" class="form-input">

                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-input">

                <input type="file" name="image" id="imageInput" class="form-input">

                {{-- DESCRIPTION (FIXED — was missing in your system) --}}
                <textarea name="description" class="form-input full-row" rows="3"
                    placeholder="Product description">{{ $product->description }}</textarea>

            </div>

            {{-- IMAGE COMPARISON --}}
            <div class="image-row">

                <div class="image-box">
                    <p>Current Image</p>

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="previewable-image"
                             onclick="openImageModal(this.src)">
                    @else
                        <p style="color:#9ca3af;">No image</p>
                    @endif
                </div>

                <div class="image-box">
                    <p>New Image Preview</p>

                    <img id="previewImg"
                         class="previewable-image"
                         style="display:none;"
                         onclick="openImageModal(this.src)">
                </div>

            </div>

            <button class="btn-save">Update Product</button>

        </form>

    </div>

</div>

{{-- MODAL --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="close-modal">&times;</span>
    <img id="modalImage" class="modal-image">
</div>

<script>
    const imageInput = document.getElementById('imageInput');
    const previewImg = document.getElementById('previewImg');

    if (imageInput) {
        imageInput.addEventListener('change', function (e) {
            if (!e.target.files.length) return;

            const reader = new FileReader();
            reader.onload = function () {
                previewImg.src = reader.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    }

    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').style.display = 'flex';
    }

    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeImageModal();
    });
</script>

@endsection