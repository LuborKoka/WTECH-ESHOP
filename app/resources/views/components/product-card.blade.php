<div class="card">
    <a class="link" href="./product/index.html">
        <img src="{{ asset('images/product-placeholder.png') }}" alt="product-placeholder" width="120px">
    </a>
    <a class="link" href="./product/index.html">
        <strong>{{ $book->title }}</strong>
    </a>

    <b class="price">{{ $book->price }}</b>

    <x-clickable-button>
        Pridať do košíka <i class="fa fa-solid fa-shopping-cart"></i>
    </x-clickable-button>
</div>
