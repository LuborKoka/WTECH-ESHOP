<div class="card">
    <a class="link" href="{{ route('edit_book', ['name' => urlencode($book->title)]) }}">
        <img src="{{ asset('images/product-placeholder.png') }}" alt="product-placeholder" width="120px">
    </a>
    <a class="link" href="{{ route('edit_book', ['name' => urlencode($book->title)]) }}">
        <strong>{{ $book->title }}</strong>
    </a>

    <b class="price">{{ $book->cost }}€</b>

    <a href="{{ route('edit_book', ['name' => urlencode($book->title)]) }}" style="display: grid; text-decoration: none;">
        
        <input type='hidden' value='1' name='count'>
        <input type='hidden' value="{{ $book->id }}" name='book_id'>

        <button class="clickable-button">
            Upraviť
        </button>
</a>
</div>
