<nav class="primary-navigation">
    @foreach ($genres as $genre)
        <div>
            <a class="link" href="{{ route('genre', ['name' => urlencode($genre->name)]) }}">{{ $genre->name }}</a>
        </div>
    @endforeach
</nav>


