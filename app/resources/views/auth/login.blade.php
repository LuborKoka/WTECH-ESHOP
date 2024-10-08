<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/auth/login.css') }}">
<html lang="en">
<head>
    @include('includes.head', ['title' => 'Login'])
    @yield('head')
</head>

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
            <a href="{{ route('shopping-cart') }}"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <a href="{{ route('login') }}"><i class="fa fa-solid fa-user"></i></a>
        </span>
    </header>

    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" id="login-form" action="{{ route('login') }}">
        @csrf
        <h2>Prihlásenie</h2>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Heslo')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="clickable-button">
                {{ __('Prihlásiť sa') }}
            </x-primary-button>
        </div>
    </form>

    <p class="alternative">Ešte nemáte účet? <a class="link" id="plink" href="{{ route('register') }}">Zaregistrovať sa</a></p>
</body>
</html>
