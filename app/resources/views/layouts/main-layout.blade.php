<!DOCTYPE html>
<html lang="sk">
    <head>
        @include('includes.head', ['title' => $title])
        @yield('head')
    </head>

    <body>
        @include('includes.header')

        <div class="content-container">
            @include('includes.navbar')

            @yield('content')
        </div>

        <footer>
            <div>Logo made by <a href="https://www.designevo.com/" title="Free Online Logo Maker">DesignEvo free logo creator</a></div>
        </footer>
    </body>

    <script src="{{ asset('js/menucko.js') }}"></script>
    @yield('scripts')
</html>
