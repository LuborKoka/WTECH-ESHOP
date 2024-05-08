<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head', ['title' => 'Login'])
    @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/admin/add_product/content.css') }}">

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


    <div class="content-container">
        <nav class="primary-navigation">
            <div>
                <a class="link" href="./add.html">Pridať produkt</a>
            </div>
            <div>
                <a class="link" href="../edit_product/index.html">Upraviť produkt</a>
            </div>

        </nav>

        <main>

            <h2>Pridať produkt</h2>

            <form method="POST" action="{{ route('book.store') }}">
                @csrf

                <div class="product-info">
                    <section class="product-details">
                        <ul>
                            <li>
                                <label for="title">Názov produktu:</label>
                                <input type="text" id="title" name="title" required>
                            </li>
                            <li>
                                <label for="author_id">Autor:</label>
                                <input type="text" id="author_id" name="author_id" required>
                            </li>
                            <li>
                                <label for="genre_id">Žáner:</label>
                                <input type="text" id="genre_id" name="genre_id" required>
                            </li>
                            <li>
                                <label for="publisher">Vydavateľstvo:</label>
                                <input type="text" id="publisher" name="publisher" required>
                            </li>
                            <li>
                                <label for="released_at">Rok vydania:</label>
                                <input type="text" id="released_at" name="released_at" required>
                            </li>
                            <li>
                                <label for="description">Detailný popis:</label>
                                <textarea id="description" name="description" rows="4" required>
                            </textarea>
                            </li>
                            <li>
                                <label for="stock">Na sklade:</label>
                                <input type="text" id="stock" name="stock" required>
                            </li>
                            <li>
                                <label for="cost">Cena:</label>
                                <input type="text" id="cost" name="cost" required>
                            </li>
                            <li>
                                <label class="clickable-button low-prio" style="padding: .75rem 1.5rem">
                                    <span><i class="fa-solid fa-file-import" style="padding-right: .5rem;"></i> Pridať
                                        obrázok</span>
                                    <input style="display: none;" type="file" id="product-image-upload"
                                        name="product-image-upload" accept="image/*" multiple>
                                </label>
                                <!--<label for="product-image-upload">Nahrať obrázok:</label>-->

                            </li>
                        </ul>



                        <button type="submit" style="padding: 1rem 2rem; font-size: 1.2rem; margin-top: 2rem;"
                            class="clickable-button">
                            Pridať produkt
                        </button>
                    </section>
                </div>
            </form>
        </main>

    </div>


    <script src="{{ asset('/js/product/index.js') }}"></script>
    <script src="{{ asset('/js/index.js') }}"></script>

</body>

</html>
