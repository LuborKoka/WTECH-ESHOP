<div class="card">
    <a class="link" href="{{ route('book', ['name' => urlencode($book->title)]) }}">
        <img src="{{ asset('images/product-placeholder.png') }}" alt="product-placeholder" width="120px">
    </a>
    <a class="link" href="{{ route('book', ['name' => urlencode($book->title)]) }}">
        <strong>{{ $book->title }}</strong>
    </a>

    <b class="price">{{ $book->cost }}€</b>

    <form method="POST" action="{{ route('cart.add_item') }}" style='display: grid'>
        @csrf
        <input type='hidden' value='1' name='count'>
        <input type='hidden' value="{{ $book->id }}" name='book_id'>

        <x-clickable-button buy :type="'submit'">
            Pridať do košíka <i class="fa fa-solid fa-shopping-cart"></i>
        </x-clickable-button>
    </form>
</div>
