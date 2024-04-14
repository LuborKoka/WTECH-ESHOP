<!DOCTYPE html>
<html lang="sk">
    <head>
        @include('includes.head')
        @yield('head')
    </head>

    <body>
        @include('includes.header')

        <aside>
            @include('includes.navbar')
        </aside>

        <main>
            @yield('content')
        </main>
    </body>

    <script src="{{ asset('js/menucko.js') }}"></script>
    @yield('scripts')
</html>
