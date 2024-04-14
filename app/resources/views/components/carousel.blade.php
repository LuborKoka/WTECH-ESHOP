<section class="carousel">
    <div class="carousel-active-element">
        @foreach($images as $key => $route)
            <div class="carousel-item-container{{ $key > 0 ? ' to-right' : '' }}">
                <img class="image" alt="product" src="{{ asset($route) }}">
            </div>
        @endforeach
    </div>
    <span class="swipe left"><i class="fa-solid fa-circle-left"></i></span>
    <span class="swipe right"><i class="fa-solid fa-circle-right"></i></span>
</section>
