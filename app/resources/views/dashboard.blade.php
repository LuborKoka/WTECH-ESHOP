
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
            <a href="../shopping-cart/index.html"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <i class="fa fa-solid fa-user"></i>
        </span>
    </header>

    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" id="login-form" action="{{ route('logout') }}">
    @csrf
    <div>
         <h3 style="padding-bottom: 10px;">Si prihlásený!</h3>
    </div>

    <div>
        <button type="submit" class="clickable-button">
            {{ __('Odhlásiť sa') }}
        </button>
    </div>
    
</form>


</body>
</html>
