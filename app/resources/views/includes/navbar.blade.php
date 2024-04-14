<nav class="primary-navigation">
    @foreach ($genres as $genre)
        <div>
            <a class="link" href="{{ route('product', ['name' => urlencode($genre->name)]) }}">{{ $genre->name }}</a>
        </div>
    @endforeach
</nav>


