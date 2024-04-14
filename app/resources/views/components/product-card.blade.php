<div class="card">
    <a class="link" href="{{ route('book', ['name' => urlencode($book->title)]) }}">
        <img src="{{ asset('images/product-placeholder.png') }}" alt="product-placeholder" width="120px">
    </a>
    <a class="link" href="{{ route('book', ['name' => urlencode($book->title)]) }}">
        <strong>{{ $book->title }}</strong>
    </a>

    <b class="price">{{ $book->cost }}€</b>

    <x-clickable-button buy>
        Pridať do košíka <i class="fa fa-solid fa-shopping-cart"></i>
    </x-clickable-button>
</div>
