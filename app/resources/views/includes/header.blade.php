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
        <a href="./../../../shopping-cart/index.html"><i class="fa fa-solid fa-shopping-cart"></i></a>
        <a href="{{ route('login') }}"><i class="fa fa-solid fa-user"></i></a>
    </span>
</header>
