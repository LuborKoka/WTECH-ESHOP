<div class="cart-item" id="item-{{ $item->id }}">
    <img alt="cart-item" src="{{ asset('images/cart/image_01.jpeg') }}">
    <p>
        <a href="{{ route('book', ['name' => urlencode($item->book->title)]) }}">{{ $item->book->title }}</a>
    </p>
    <b>{{ $item->book->cost }}€/ks</b>
    <input type="number" min="0" max="{{ $item->book->stock }}" value="{{ $item->count }}" onchange="ShoppingCart.changeItemCount({{ $item->id }}, {{ $item->book->cost }})">
    <p>{{ $item->book->cost * $item->count }}€</p>
    <i class="fa-solid fa-trash-can" onclick="ShoppingCart.removeItem({{ $item->id }})"></i>
</div>
