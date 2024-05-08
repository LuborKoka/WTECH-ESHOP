<div class="cart-item" id="item-{{ $item->book->id }}">
    <img alt="cart-item" src="{{ asset('images/cart/image_01.jpeg') }}">
    <p>
        <a href="{{ route('book', ['name' => urlencode($item->book->title)]) }}">{{ $item->book->title }}</a>
    </p>
    <b>{{ $item->book->cost }}€/ks</b>
    <input type="number" min="0" value={{ $item->count }}>
    <p>{{ $item->book->cost * $item->count }}€</p>
    <i class="fa-solid fa-trash-can" onclick="ShoppingCart.removeItem({{$cartId}}, {{$item->book->id}})"></i>
</div>
