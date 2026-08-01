<x-guest-layout>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#0f172a;
            font-family:Arial, Helvetica, sans-serif;
        }

        .auth-wrapper{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
            background:linear-gradient(135deg,#0f172a,#111827,#1e293b);
        }

        .auth-card{
            width:100%;
            max-width:470px;
            background:#ffffff;
            border-radius:18px;
            padding:35px;
            box-shadow:0 20px 50px rgba(0,0,0,.35);
            animation:fadeUp .6s ease;
        }

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(40px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        @keyframes shake{
            10%,90%{transform:translateX(-2px);}
            20%,80%{transform:translateX(4px);}
            30%,50%,70%{transform:translateX(-6px);}
            40%,60%{transform:translateX(6px);}
        }

        .shake{
            animation:shake .6s;
        }

        .auth-header{
            text-align:center;
            margin-bottom:30px;
        }

        .auth-header img{
            width:80px;
            height:80px;
            border-radius:50%;
            object-fit:cover;
            border:4px solid #2563eb;
            margin-bottom:15px;
        }

        .auth-title{
            font-size:28px;
            color:#111827;
            font-weight:700;
            margin-bottom:8px;
        }

        .auth-sub{
            color:#6b7280;
            font-size:15px;
            line-height:1.6;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#374151;
            font-weight:600;
            font-size:14px;
        }

        input[type=email],
        input[type=password]{
            width:100%;
            padding:14px 18px;
            border:1px solid #d1d5db;
            border-radius:10px;
            background:#f9fafb;
            font-size:15px;
            transition:.3s;
        }

        input[type=email]:focus,
        input[type=password]:focus{
            outline:none;
            border-color:#2563eb;
            background:#fff;
            box-shadow:0 0 0 4px rgba(37,99,235,.15);
        }

        .pw-toggle{
            position:absolute;
            right:15px;
            top:50%;
            transform:translateY(-50%);
            border:none;
            background:none;
            cursor:pointer;
            font-size:18px;
            color:#6b7280;
        }

        .pw-toggle:hover{
            color:#2563eb;
        }

        .block.mt-4{
            margin-top:20px;
        }

        .remember{
            display:flex;
            align-items:center;
            gap:10px;
            color:#4b5563;
            font-size:14px;
        }

        .forgot-link{
            color:#2563eb;
            text-decoration:none;
            font-size:14px;
            font-weight:600;
        }

        .forgot-link:hover{
            text-decoration:underline;
        }

        .btn-submit{
            background:#2563eb;
            color:#fff;
            border:none;
            padding:13px 30px;
            border-radius:10px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .btn-submit:hover{
            background:#1d4ed8;
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(37,99,235,.35);
        }

        .bottom-area{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-top:25px;
            flex-wrap:wrap;
            gap:15px;
        }

        @media(max-width:500px){

            .auth-card{
                padding:25px;
            }

            .bottom-area{
                flex-direction:column;
                align-items:flex-start;
            }

            .btn-submit{
                width:100%;
            }
        }

    </style>

    <div class="auth-wrapper">

        <div class="auth-card" id="auth-card">

            <div class="auth-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">

                <h2 class="auth-title">
                    Welcome Back
                </h2>

                <div class="auth-sub">
                    Log in to manage orders and access exclusive deals.
                </div>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4" style="position:relative;">

                    <x-input-label
                        for="password"
                        :value="__('Password')" />

                    <div style="position:relative;">

                        <x-text-input
                            id="password"
                            class="block mt-1 w-full pr-10"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password" />

                        <button
                            type="button"
                            id="pw-toggle"
                            class="pw-toggle">👁</button>

                    </div>

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2" />

                </div>

                <div class="block mt-4">

                    <label class="remember">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember">

                        <span>
                            {{ __('Remember me') }}
                        </span>

                    </label>

                </div>

                <div class="bottom-area">

                    <div>
                        @if (Route::has('password.request'))
                            <a class="forgot-link"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">
                        {{ __('Log in') }}
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded',function(){

            @if($errors->any())
                const card=document.getElementById('auth-card');
                card.classList.add('shake');
                setTimeout(()=>{
                    card.classList.remove('shake');
                },600);
            @endif

            const toggle=document.getElementById('pw-toggle');
            const password=document.getElementById('password');

            toggle.addEventListener('click',function(){

                if(password.type==="password"){
                    password.type="text";
                    toggle.innerHTML="🙈";
                }else{
                    password.type="password";
                    toggle.innerHTML="👁";
                }

            });

        });
    </script>

</x-guest-layout>
