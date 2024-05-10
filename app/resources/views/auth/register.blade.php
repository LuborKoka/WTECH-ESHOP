<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/auth/login.css') }}">
<html lang="en">
<head>
    @include('includes.head', ['title' => 'Register'])
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

<x-guest-layout>
    <form method="POST" id="login-form"action="{{ route('register') }}">
        @csrf
        <h2>Registrácia</h2>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Meno:')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')"  />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail:')" />
            <x-text-input id="email"  type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')"  />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Heslo:')" />

            <x-text-input id="password" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Zopakuj heslo:')" />

            <x-text-input id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="clickable-button">
                {{ __('Registrovať') }}
            </x-primary-button>
        </div>
    </form>
    <p class="alternative">Už máte účet? <a class="link" id="plink" href="{{ route('login') }}">Prihlásiť sa</a></p>

</x-guest-layout>

</body>

</html>