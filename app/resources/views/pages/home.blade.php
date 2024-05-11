@props(['includeFilter' => true])

@extends('layouts.main-layout', ['title' => $title])

@section('head')
<link href="{{ asset('/css/content.css') }}" rel="stylesheet">
<link href="{{ asset('/css/popup.css') }}" rel="stylesheet">
<link href="{{ asset('/css/pagination.css') }}" rel="stylesheet">
@stop

@section('content')
<main>
    <div class="sort-by-header">
        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'default']) }}" class="{{ request('sort_by') == 'default' ? 'active' : '' }}">Odporúčané</a>
        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'newest']) }}" class="{{ request('sort_by') == 'newest' ? 'active' : '' }}">Najnovšie</a>
        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'cheapest']) }}" class="{{ request('sort_by') == 'cheapest' ? 'active' : '' }}">Najlacnejšie</a>
        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'most_expensive']) }}" class="{{ request('sort_by') == 'most_expensive' ? 'active' : '' }}">Najdrahšie</a>


        @if($includeFilter)
        <x-clickable-button styles="width: auto;" id="filter" :onclick="'Popup.open()'">
            <i class="fa-solid fa-filter"></i> Filter
        </x-clickable-button>
        @endif

    </div>

    <div class="auto-grid" id="product-list-container">
        @foreach ($books as $book)
            <x-product-card :book="$book" />
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>

    @if($includeFilter)
    <div class="filter-window-framefix" onclick="Popup.close()">
        <div class="filter-animation-frame">
            <div class="filter-window">
                <div class="filter-expand">
                    <i class="fa-solid fa-caret-down"></i>
                    <span>Autori</span>
                </div>

                <div class="filter-content">
                    <div>
                        @foreach($authors as $item)
                            <x-filter-item :name="'book_author'" :id="$item" />
                        @endforeach
                    </div>
                </div>


                <div class="filter-expand">
                    <i class="fa-solid fa-caret-down"></i>
                    <span>Vydavateľstvá</span>
                </div>

                <div class="filter-content">
                    <div>
                        @foreach($publishers as $item)
                            <x-filter-item :name="'book_publisher'" :id="$item" />
                        @endforeach
                    </div>
                </div>

                <div class="filter-expand">
                    <i class="fa-solid fa-caret-down"></i>
                    <span>Cena</span>
                </div>

                <div class="filter-content">
                    <div>
                        <div class="price-filter">
                            <div>
                                <input id="range-1" type="range" min="0" max="{{ $maxCost }}" value="0" step="1">
                                <input id="range-2" type="range" min="0" max="{{ $maxCost }}" value="{{ $maxCost }}" step="1">
                                <span class="fill"></span>
                                <span class="bar"></span>
                            </div>
                        </div>

                        <div class="price-info">
                            <span id="cost-min">Min. cena: 0€</span>
                            <span id="cost-max">Max. cena: {{ $maxCost }}€</span>
                        </div>
                    </div>
                </div>

                <x-clickable-button onclick="Filter.apply()">
                    Odoslať
                </x-clickable-button>
            </div>
        </div>
    </div>
    @endif
</main>
@stop

@section('scripts')
@if($includeFilter)
<script src="{{ asset('js/popup.js') }}"></script>
<script src="{{ asset('js/filter.js') }}"></script>
@endif
@stop
