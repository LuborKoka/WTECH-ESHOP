@extends('layouts.main-layout', ['title' => 'E-SHOP'])

@section('head')
<link href="{{ asset('/css/content.css') }}" rel="stylesheet">
<link href="{{ asset('/css/popup.css') }}" rel="stylesheet">
@stop

@section('content')
<main>
    <div class="sort-by-header">
        <span class="active">Odporúčané</span>
        <span>Najnovšie</span>
        <span>Najlacnejšie</span>
        <span>Najdrahšie</span>

        <x-clickable-button styles="width: auto;" id="filter">
            <i class="fa-solid fa-filter"></i> Filter
        </x-clickable-button>

    </div>

    <div class="auto-grid" id="product-list-container">
        @foreach ($books as $book)
            <x-product-card :book="$book" />
        @endforeach
    </div>

    <div class="filter-window-framefix">
        <div class="filter-animation-frame">
            <div class="filter-window">
                <div class="filter-expand">
                    <i class="fa-solid fa-caret-down"></i>
                    <span>Typ</span>
                </div>

                <div class="filter-content">
                    <div>
                        <div>
                            <input type="checkbox" name="book_type" id="printed">
                            <label for="printed">Tlačené knihy</label>
                        </div>
                        <div>
                            <input type="checkbox" name="book_type" id="electronic">
                            <label for="electronic">Elektronické knihy</label>
                        </div>
                    </div>
                </div>


                <div class="filter-expand">
                    <i class="fa-solid fa-caret-down"></i>
                    <span>Vydavateľstvá</span>
                </div>

                <div class="filter-content">
                    <div>
                        <div>
                            <input type="checkbox" name="book_publisher" id="slovart">
                            <label for="slovart">slovart</label>
                        </div>
                        <div>
                            <input type="checkbox" name="book_publisher" id="fragment">
                            <label for="fragment">Fragment</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@stop

@section('scripts')
<script src="{{ asset('js/popup.js') }}"></script>
@stop
