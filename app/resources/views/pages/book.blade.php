@extends('layouts.main-layout', ['title' => $book->title])

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/product/content.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('/css/global-css/labeled-input.css') }}" >
@stop

@section('content')
<main>
    <h2>{{ $book->title }}</h2>
    <div class="product-info">
        @include('components.carousel', ['images' => explode(';', $book->images)])

        <section class="product-details">
            <ul>
                <li>
                    <b>Autor</b>: {{ $book->author->name }}
                </li>
                <li>
                    <b>Žáner</b>: {{ $book->genre->name }}
                </li>
                <li>
                    <b>Vydavateľstvo</b>: {{ $book->publisher }}
                </li>
                <li>
                    <b>Rok vydania</b>: {{ \Carbon\Carbon::parse($book->released_at)->format('Y') }}
                </li>
                <li>
                    <b>Detailný popis</b>: {{ $book->description }}
                </li>
            </ul>

            <div style="display: flex; justify-content: space-between; padding-top: 1rem;">
                <span>
                    Na sklade:  <strong>{{ $book->stock > 5 ? '>5' : $book->stock }}ks</strong>
                </span>
                <strong>
                    {{ $book->cost }}€
                </strong>
            </div>


            <form method="POST" action="{{ route('cart.add_item') }}" style='display: grid'>
                @csrf
                <input type='hidden' value="{{ $book->id }}" name='book_id'>

                <div class="labeled-input" style="margin-bottom: 1rem">
                    <input type="number" min="1" value="1" max="{{ $book->stock }}" name="count" required id="book_count">
                    <label for="book_count">Počet</label>
                </div>


                <x-clickable-button buy :type="'submit'">
                    Pridať do košíka <i class="fa fa-solid fa-shopping-cart"></i>
                </x-clickable-button>
            </form>
        </section>
    </div>
</main>
@stop

@section('scripts')
<script src="{{ asset('/js/product/index.js') }}"></script>
@stop
