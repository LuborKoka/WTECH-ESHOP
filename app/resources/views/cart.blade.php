<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/nav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/document.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/clickable-button.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hamburgers.css') }}"> <!--src: https://github.com/jonsuh/hamburgers-->
    <link href="{{ asset('/css/cart/content.css') }}" rel="stylesheet">
    <title>E-SHOP</title>
    <script src="https://kit.fontawesome.com/4e34836926.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <button class="hamburger hamburger--emphatic" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
        </button>

        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('/images/logo.png') }}" alt="Logo" ></a>
        </div>
        
        <div class="search">
            <form>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Hľadaj">
                <button></button>
            </form>
        </div>
        
        <span class="icons">
            <a href="./index.html"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <a href="../auth/login.html"><i class="fa fa-solid fa-user"></i></a>
        </span>
    </header>

    <aside>
        <nav class="primary-navigation">
            <div>
                <a class="link" href="../index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="../index.html">CATEGORY 13</a>
            </div>
            <div>
                <a class="link" href="../index.html">CATEGORY 1658</a>
            </div>
            <div>
                <a class="link" href="../index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="../index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="../index.html">CATEGORY</a>
            </div>
        </nav>
    </aside>
    
    <main>
        <h2>Your Shopping Cart</h2>

        <section style="display: grid; gap: 2rem">
            <div id="items" style="display: grid; gap: 1rem;">
                <template id="cart-item-template">
                    <div class="cart-item">
                        <img alt="cart-item" src="{{ asset('/images/cart/image_01.jpeg') }}">
                        <p>
                            <a href="../product/index.html">Oznacenie produktu</a>
                        </p>
                        <b></b>
                        <input type="number" min="0">
                        <p></p>
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                </template>
            </div>

            <strong id="cart-total" style="display: flex; justify-content: flex-end; font-size: 1.2rem;"></strong>

            <div style="display: flex; justify-content: space-between; gap: 1rem;">
                <a style="padding: .75rem 1.5rem; width: auto;" class="clickable-button low-prio" href="../index.html">
                    <i style="padding-right: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-left-long"></i>Pokračovať v nákupe
                </a>

                <a style="width: auto; padding: .75rem 1.5rem;" class="clickable-button" href="../payment/index.html">
                    Dokončiť objednávku<i style="padding-left: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-right-long"></i>
                </a>

            </div>
        </section>
    </main>


    <script src="{{ asset('/js/cart/index.js') }}" ></script>
    <script src="{{ asset('js/menucko.js')}}"></script>
</body>
</html>