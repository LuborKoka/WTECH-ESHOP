<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/header.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/auth/login.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/content.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/nav.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/document.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/layouts/layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/clickable-button.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/hamburgers.css') }}"> <!--src: https://github.com/jonsuh/hamburgers-->
<script src="https://kit.fontawesome.com/4e34836926.js" crossorigin="anonymous"></script>

<body>

    <header>
        <button class="hamburger hamburger--emphatic" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
        </button>

        <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" ></a>
    </div>
        
        <div class="search">
            <form>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Hľadaj">
                <button></button>
            </form>
        </div>
        
        <span class="icons">
            <a href="../shopping-cart/index.html"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <i class="fa fa-solid fa-user"></i>
        </span>
    </header>

    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" id="login-form" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me 
        <div>
            <label for="remember_me">
                <input  type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>-->

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="clickable-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

        <p class="alternative">Ešte nemáte účet? <a class="link", id="plink" , href="{{ route('register') }}">Zaregistrovať sa</a></p>
        <p class="alternative"><a class="link", id="plink" , href="../admin/add_product/add.html">Prihlásiť sa</a> ako Administrátor </p>
    

</body>
