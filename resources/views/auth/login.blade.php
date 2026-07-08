<x-guest-layout>

    <style>
        .auth-wrapper{display:flex;align-items:center;justify-content:center;padding:36px 16px}
        .auth-card{width:100%;max-width:460px;background:rgba(11,17,28,0.6);border:1px solid var(--border);padding:28px;border-radius:12px;box-shadow:0 20px 40px rgba(2,6,23,0.6);transform:translateY(18px);opacity:0;transition:transform .6s cubic-bezier(.2,.9,.3,1),opacity .6s ease}
        .auth-card.entered{transform:none;opacity:1}
        @keyframes shake{10%,90%{transform:translateX(-1px)}20%,80%{transform:translateX(2px)}30%,50%,70%{transform:translateX(-4px)}40%,60%{transform:translateX(4px)}}
        .auth-card.shake{animation:shake .6s}
        .auth-header{display:flex;align-items:center;gap:14px;margin-bottom:18px}
        .auth-header img{width:56px;height:56px;border-radius:10px;object-fit:cover;border:1px solid var(--border)}
        .auth-title{font-size:20px;font-weight:800;margin:0;color:#e5e7eb}
        .auth-sub{color:var(--muted);font-size:13px;margin-top:4px}
        .auth-card input[type=email], .auth-card input[type=password]{background:transparent;border:1px solid var(--border);padding:12px 14px;border-radius:8px;transition:box-shadow .15s ease,border-color .15s ease;color:inherit}
        .auth-card input:focus{box-shadow:0 8px 24px rgba(34,197,94,0.12);border-color:var(--accent);outline:none}
        .btn-submit{background:#ffffff!important;color:var(--surface)!important;padding:12px 18px;border-radius:10px;box-shadow:0 8px 24px rgba(2,6,23,0.45);transition:transform .18s cubic-bezier(.2,.9,.3,1),box-shadow .18s ease,filter .12s ease;border:1px solid rgba(0,0,0,0.06);font-weight:700}
        .btn-submit:hover{transform:translateY(-3px) scale(1.02);box-shadow:0 22px 48px rgba(2,6,23,0.55);filter:brightness(1.02)}
        .btn-submit:active{transform:translateY(-1px) scale(0.995);box-shadow:0 8px 20px rgba(2,6,23,0.45)}
        .btn-submit:focus-visible{outline:3px solid rgba(34,197,94,0.18);outline-offset:4px}
        .pw-toggle{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:transparent;border:none;color:var(--muted);cursor:pointer}
        .forgot-link{color:#ffffff;text-decoration:none;font-size:13px;opacity:0.9}
        .forgot-link:hover{opacity:1;text-decoration:underline}
    </style>

    <div class="auth-wrapper">
        <div class="auth-card" id="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
                <div>
                    <h2 class="auth-title">Welcome back</h2>
                    <div class="auth-sub">Log in to manage orders and access exclusive deals.</div>
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" style="position:relative;">
            <x-input-label for="password" :value="__('Password')" />

            <div style="position:relative;">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="current-password" />
                <button type="button" id="pw-toggle" class="pw-toggle" aria-label="Show password">👁</button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4" style="gap:12px;flex-wrap:wrap;align-items:center;">
            <div>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <div>
                <button type="submit" class="btn-submit" style="border:none;">{{ __('Log in') }}</button>
            </div>
        </div>
    </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const card = document.getElementById('auth-card');
            setTimeout(()=> card && card.classList.add('entered'), 60);

            @if($errors->any())
                // shake on validation errors
                setTimeout(()=> { card && card.classList.add('shake'); setTimeout(()=> card.classList.remove('shake'), 700); }, 100);
            @endif

            const pwToggle = document.getElementById('pw-toggle');
            const pwInput = document.getElementById('password');
            if(pwToggle && pwInput){
                pwToggle.addEventListener('click', function(){
                    if(pwInput.type === 'password'){ pwInput.type = 'text'; pwToggle.textContent = '🙈'; }
                    else { pwInput.type = 'password'; pwToggle.textContent = '👁'; }
                    pwInput.focus();
                });
            }
        });
    </script>
</x-guest-layout>
