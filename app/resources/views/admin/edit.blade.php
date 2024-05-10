<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head', ['title' => 'Login'])
    @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin/add_product/content.css') }}">
    <link href="{{ asset('/css/content.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/popup.css') }}" rel="stylesheet">
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

    <div class="content-container">
        <nav class="primary-navigation">
            <div>
                <a class="link" href="{{ route('add') }}">Pridať produkt</a>
            </div>

            <div>
                <a class="link" href="{{ route('edit') }}">Upraviť produkt</a>
            </div>

            <form method="POST" id="login-form" action="{{ route('logout') }}">
                @csrf
                <div>
                    <button type="submit" class="clickable-button">
                        {{ __('Odhlásiť sa') }}
                    </button>
                </div>
            </form>
        </nav>

        <div class="auto-grid" id="product-list-container">
        @foreach ($books as $book)
            <x-edit-product-card :book="$book" />
        @endforeach
    </div>
    </div>

    <footer>
        <div>Logo made by <a href="https://www.designevo.com/" title="Free Online Logo Maker">DesignEvo free logo creator</a></div>
    </footer>   

    <script src="{{ asset('/js/product/index.js') }}"></script>
<script src="{{ asset('/js/index.js') }}"></script>
</body>
</html>
