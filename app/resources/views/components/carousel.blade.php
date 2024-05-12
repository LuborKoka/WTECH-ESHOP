@props(['isAdmin' => false])

@php
if ( $images[0] == '' ) {
    $images = ['images/product/img_01.jpg', 'images/product/img_02.avif', 'images/product/img_03.jpg', 'images/product/img_04.jpg', 'images/product/img_05.avif'];
}
@endphp

<section class="carousel">
    <div class="carousel-active-element">
        @foreach($images as $key => $route)
            <div class="carousel-item-container{{ $key > 0 ? ' to-right' : '' }}">
                <img class="image" alt="product" src="{{ asset($route) }}">
                @if ( $isAdmin )
                    <form method="DELETE" class="delete-icon" action="{{ route('book.edit_images', ['name' => urlencode($book->title), 'image_route' => urlencode($route)]) }}" >
                        <button style="background: none; outline: none; border: none">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    <span class="swipe left"><i class="fa-solid fa-circle-left"></i></span>
    <span class="swipe right"><i class="fa-solid fa-circle-right"></i></span>
</section>
