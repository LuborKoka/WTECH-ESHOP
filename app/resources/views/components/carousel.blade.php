@props(['isAdmin' => false])

@php
if ( $images[0] == '' ) {
    $images = ['images/product/img_01.jpg', 'images/product/img_02.avif', 'images/product/img_03.jpg', 'images/product/img_04.jpg', 'images/product/img_05.avif'];
}
@endphp

<section class="carousel">
    <div class="carousel-active-element">
        @foreach($images as $key => $route)
            <div class="carousel-item-container{{ $key > 0 ? ' to-right' : '' }}" id="{{ $book->title }}-{{ $route }}">
                <img class="image" alt="product" src="{{ asset($route) }}">
                @if ( $isAdmin )
                    <i class="fa-solid fa-trash-can delete-icon" onclick="Admin.deleteImage('{{ $book->title }}', '{{ $route }}')"></i>
                @endif
            </div>
        @endforeach
    </div>
    <span class="swipe left"><i class="fa-solid fa-circle-left"></i></span>
    <span class="swipe right"><i class="fa-solid fa-circle-right"></i></span>
</section>
