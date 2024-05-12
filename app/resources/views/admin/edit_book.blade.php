<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head', ['title' => 'Upraviť produkt'])
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
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
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

        <main>

            <h2>Upraviť produkt</h2>

            <div class="product-info">
                @include('components.carousel', ['images' => explode(';', $book->images), 'isAdmin' => true])
                <form method="POST" class="product-info"
                    action="{{ route('book.update', ['name' => urlencode($book->title)]) }}">
                    @csrf
                    @method('PUT')
                    <section class="product-details">
                        <ul>

                            <li>
                                <b>Názov produktu:</b> <input type="text" id="product-name" name="title" value="{{ $book->title }}" required>
                            </li>

                            <li>
                                <b>Autor:</b> <input type="text" name="author" value="{{ $book->author->name }}">
                            </li>

                            <li>
                            <b>Žáner:</b>
                                <select name="genre_id">
                                    <option>Select genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </li>
                            <li>
                                <b>Vydavateľstvo:</b> <input type="text" name="publisher" value="{{ $book->publisher }}">
                            </li>
                            <li>
                                <b>Rok vydania:</b> <input type="date" name="released_at"
                                    value="{{ \Carbon\Carbon::parse($book->released_at)->toDateString() }}">
                            </li>
                            <li>
                                <b>Detailný popis:</b> <textarea name="description" rows="4">{{ $book->description }}</textarea>
                            </li>
                            <li>
                                <b>Na sklade:</b> <input name="stock" value="{{ $book->stock }}"></input>
                            </li>
                            <li>
                                <b>Cena:</b> <input name="cost" value="{{ $book->cost }}"></input>
                            </li>
                            <li>
                                <label class="clickable-button low-prio" style="padding: .75rem 1.5rem">
                                    <span><i class="fa-solid fa-file-import" style="padding-right: .5rem;"></i> Pridať
                                        obrázok</span>
                                    <input style="display: none;" type="file" id="product-image-upload"
                                        name="product-image-upload[]" accept="image/*" multiple>
                                </label>
                            </li>

                        </ul>

                        <button type="submit" style="padding: 1rem 2rem; font-size: 1.2rem; margin-top: 2rem;"
                            class="clickable-button">
                            Uložiť zmeny
                        </button>
                </form>


                <form method="POST" action="{{ route('book.delete', ['name' => urlencode($book->title)]) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 1rem 2rem; font-size: 1.2rem; margin-top: 2rem;" class="clickable-button low-prio delete">Vymazať produkt</button>
                </form>
            </section>

            </div>
        </main>
    </div>


    <script src="{{ asset('/js/product/index.js') }}"></script>
</body>

</html>
