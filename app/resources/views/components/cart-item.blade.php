<div class="cart-item">
    <img alt="cart-item" src="{{ asset('images/cart/image_01.jpeg') }}">
    <p>
        <a href="{{ route('book', ['name' => urlencode($item->book->title)]) }}">{{ $item->book->title }}</a>
    </p>
    <b></b>
    <input type="number" min="0" value={{ $item->count }}>
    <p></p>
    <i class="fa-solid fa-trash-can"></i>
</div>
