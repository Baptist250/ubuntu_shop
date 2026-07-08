<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-6 md:grid-cols-[auto_1fr] md:items-center">
            <div class="flex items-center gap-4">
                <div class="inline-flex h-28 w-28 items-center justify-center rounded-full bg-slate-900 text-4xl font-semibold uppercase text-white shadow-sm">
                    {{ substr($user->name, 0, 1) ?? 'A' }}
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Avatar') }}</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Your avatar is generated from your name and cannot be uploaded.') }}</p>
                </div>
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-[auto_1fr] md:items-center">
            <div></div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('profile_photo');
        const preview = document.getElementById('profile-photo-preview');
        const cropCanvas = document.getElementById('profile-photo-canvas');
        const cropData = document.getElementById('profile_photo_data');
        const cropSection = document.getElementById('profile-photo-setup');
        const xRange = document.getElementById('crop-x');
        const yRange = document.getElementById('crop-y');
        const cropBtn = document.getElementById('crop-button');
        const resetBtn = document.getElementById('profile-photo-reset');

        let imageElement = new Image();
        let sourceUrl = null;
        let originalWidth = 0;
        let originalHeight = 0;

        function resetCrop() {
            cropSection?.classList.add('hidden');
            preview.src = preview.dataset.original || preview.src;
            cropCanvas.width = 0;
            cropCanvas.height = 0;
            cropData.value = '';
            xRange.value = 50;
            yRange.value = 50;
            if (sourceUrl) {
                URL.revokeObjectURL(sourceUrl);
                sourceUrl = null;
            }
        }

        function updateCropPreview() {
            if (!imageElement.src || !cropCanvas) {
                return;
            }

            const canvas = cropCanvas;
            const ctx = canvas.getContext('2d');
            const size = Math.min(originalWidth, originalHeight);

            const xOffset = Math.round((originalWidth - size) * (xRange.value / 100));
            const yOffset = Math.round((originalHeight - size) * (yRange.value / 100));

            canvas.width = 480;
            canvas.height = 480;
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.imageSmoothingQuality = 'high';
            ctx.drawImage(imageElement, xOffset, yOffset, size, size, 0, 0, canvas.width, canvas.height);

            const cropped = canvas.toDataURL('image/jpeg', 0.92);
            preview.src = cropped;
            cropData.value = cropped;
        }

        input?.addEventListener('change', function () {
            const file = this.files?.[0];
            if (!file) {
                resetCrop();
                return;
            }

            if (sourceUrl) {
                URL.revokeObjectURL(sourceUrl);
            }

            sourceUrl = URL.createObjectURL(file);
            imageElement = new Image();
            imageElement.onload = function () {
                originalWidth = imageElement.naturalWidth;
                originalHeight = imageElement.naturalHeight;
                cropSection?.classList.remove('hidden');
                cropData.value = '';
                updateCropPreview();
            };
            imageElement.src = sourceUrl;
        });

        cropBtn?.addEventListener('click', function (event) {
            event.preventDefault();
            updateCropPreview();
        });

        resetBtn?.addEventListener('click', function (event) {
            event.preventDefault();
            resetCrop();
            input.value = '';
        });
    });
</script>
@endpush
