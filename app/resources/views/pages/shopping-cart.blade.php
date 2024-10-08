@extends('layouts.nav-hidden-layout', ['title' => 'Nákupný košík'])

@section('head')
<link href="{{ asset('/css/cart/content.css') }}" rel="stylesheet">
@stop

@section('content')
<main>
    <h2>Tvoj nákupný košík</h2>

    <section style="display: grid; gap: 2rem">
        <div id="items" style="display: grid; gap: 1rem;">
            @foreach($cart->cartItems as $item)
                <x-cart-item :item="$item" :cartId="$cart->id"/>
            @endforeach
        </div>

        <strong id="cart-total" style="display: flex; justify-content: flex-end; font-size: 1.2rem;">Zaplatiť celkom: {{ $cost }}€</strong>

        <div style="display: flex; justify-content: space-between; gap: 1rem;">
            <a style="padding: .75rem 1.5rem; width: auto;" class="clickable-button low-prio" href="{{ route('home') }}">
                <i style="padding-right: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-left-long"></i>Pokračovať v nákupe
            </a>

            @if(count($cart->cartItems) > 0)
            <a style="width: auto; padding: .75rem 1.5rem;" class="clickable-button" href="{{ route('payment') }}">
                Dokončiť objednávku<i style="padding-left: 5px; font-size: 1.2rem; transform: translateY(2.5px);" class="fa-solid fa-right-long"></i>
            </a>
            @endif

        </div>
    </section>
</main>
@stop

@section('scripts')
    <script src="{{ asset('/js/cart/index.js') }}" ></script>
    <script>
        localStorage.setItem('shoppingCartId', {{ $cart->id }});
    </script>
@stop
