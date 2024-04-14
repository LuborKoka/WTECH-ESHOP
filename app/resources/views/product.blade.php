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
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/product/content.css') }}" >
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
            <a href="{{ route('cart') }}"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <a href="../auth/login.html"><i class="fa fa-solid fa-user"></i></a>
        </span>
    </header>

    <div class="content-container">
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

        <main>

            <h2>Kúzelníčka z Arandoru</h2>

            <div class="product-info">
                <section class="carousel">
                    <div class="carousel-active-element">
                        <div class="carousel-item-container">
                            <img class="image" alt="product" src="{{ asset('/images/product/img_01.jpg') }}">
                        </div>
                        <div class="carousel-item-container to-right">
                            <img class="image" alt="product" src="{{ asset('/images/product/img_02.avif') }}">
                        </div>
                        <div class="carousel-item-container to-right">
                            <img class="image" alt="product" src="{{ asset('/images/product/img_03.jpg') }}">
                        </div>
                        <div class="carousel-item-container to-right">
                            <img class="image" alt="product" src="{{ asset('/images/product/img_04.jpg') }}">
                        </div>
                        <div class="carousel-item-container to-right">
                            <img class="image" alt="product" src="{{ asset('/images/product/img_05.avif') }}">
                        </div>
                    </div>
                    <span class="swipe left"><i class="fa-solid fa-circle-left"></i></span>
                    <span class="swipe right"><i class="fa-solid fa-circle-right"></i></span>
                </section>

                <section class="product-details">
                    <ul>
                        <li>
                            <b>Autor</b>: Emilia Hawthorne
                        </li>
                        <li>
                            <b>Žáner</b>: Fantazy
                        </li>
                        <li>
                            <b>Vydavateľstvo</b>: Moonlit Press
                        </li>
                        <li>
                            <b>Rok vydania</b>: 2022
                        </li>
                        <li>
                            <b>Detailny popis</b>:
                            V mystickej krajine Arandor, kde draky lietajú na nebi a kúzla pulzujú zeme, mladá kúzelníčka menom Elara objaví skrytú moc v sebe, ktorá by mohla zmeniť osud jej sveta. Ako sa vydáva na nebezpečnú cestu, aby ovládla svoje schopnosti, stretáva zvláštne stvorenia, starodávne proroctvá a temnú silu, ktorá hrozí zničiť všetko, čo má rada. S pomocou nepravdepodobných spojencov a múdreho starca musí Elara čeliť svojim obavám a prijať svoj osud, kým nie je príliš neskoro. "Kúzelníčka z Arandoru" je epický príbeh o odvahe, priateľstve a vytrvalosti nádeje v tvári tmy.
                        </li>
                    </ul>

                    <div style="display: flex; justify-content: space-between; padding-top: 1rem;">
                        <span>
                            Na sklade:  <strong>> 10ks</strong>
                        </span>
                        <strong>
                            25.69€
                        </strong>
                    </div>

                    <button style="padding: 1rem 2rem; font-size: 1.2rem; margin-top: 2rem;" class="clickable-button">
                        Pridať do košíka <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </section>
            </div>

        </main>

    </div>


    <script src="{{ asset('/js/product/index.js') }}"></script>
    <script src="{{ asset('/js/index.js') }}"></script>
</body>
</html>
