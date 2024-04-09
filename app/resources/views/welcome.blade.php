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
    <link href="{{ asset('/css/content.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/popup.css') }}" rel="stylesheet">
    <title>E-SHOP</title>
    <script src="{{ asset('/js/index.js') }}" ></script>
    <script src="{{ asset('/js/menucko.js') }}" ></script>
    <script src="{{ asset('/js/popup.js') }}" ></script>

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
            <a href="./shopping-cart/index.html"><i class="fa fa-solid fa-shopping-cart"></i></a>
            <a href="./auth/login.html"><i class="fa fa-solid fa-user"></i></a>
        </span>
    </header>

    <div class="content-container">
        <nav class="primary-navigation">
            <div>
                <a class="link" href="./index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="./index.html">CATEGORY 13</a>
            </div>
            <div>
                <a class="link" href="./index.html">CATEGORY 1658</a>
            </div>
            <div>
                <a class="link" href="./index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="./index.html">CATEGORY</a>
            </div>
            <div>
                <a class="link" href="./index.html">CATEGORY</a>
            </div>
        </nav>

        <main>
            <div class="sort-by-header">
                <span class="active">Odporúčané</span>
                <span>Najnovšie</span>
                <span>Najlacnejšie</span>
                <span>Najdrahšie</span>

                <div class="clickable-button" id="filter" style="padding: .75rem 1.5rem; width: auto;">
                    <i class="fa-solid fa-filter"></i> Filter
                </div>
            </div>

            

            <template id="product-card">
                <div class="card">
                    <a class="link" href="{{ route('product') }}">
                        <img src="{{ asset('/images/product-placeholder.png') }}" alt="product-placeholder" width="120px">
                    </a>
                    <a class="link" href="{{ route('product') }}"> 
                        <strong>Kúzelníčka z Arandoru</strong>
                    </a>

                    <b class="price">19.99€</b>

                    <button class="clickable-button buy">
                        Pridať do košíka <i class="fa fa-solid fa-shopping-cart"></i>
                    </button>
                </div>
            </template>


            <div class="auto-grid" id="product-list-container"></div>

            <div class="filter-window-framefix">
                <div class="filter-animation-frame">
                    <div class="filter-window">
                        <div class="filter-expand">
                            <i class="fa-solid fa-caret-down"></i>
                            <span>Typ</span>
                        </div>
    
                        <div class="filter-content">
                            <div>
                                <div>
                                    <input type="checkbox" name="book_type" id="printed">
                                    <label for="printed">Tlačené knihy</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="book_type" id="electronic">
                                    <label for="electronic">Elektronické knihy</label>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="filter-expand">
                            <i class="fa-solid fa-caret-down"></i>
                            <span>Vydavateľstvá</span>
                        </div>
                        
                        <div class="filter-content">
                            <div>
                                <div>
                                    <input type="checkbox" name="book_publisher" id="slovart">
                                    <label for="slovart">slovart</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="book_publisher" id="fragment">
                                    <label for="fragment">Fragment</label>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div>Logo made by <a href="https://www.designevo.com/" title="Free Online Logo Maker">DesignEvo free logo creator</a></div>
    </footer>   

    <script src="./menucko.js"></script>
    <script src="./popup.js"></script>
</body>
</html>