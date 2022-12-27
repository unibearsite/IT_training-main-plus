<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')
</head>

<body>
    <header>
        @yield('header')
        <!-- 省略 -->
    </header>
    <div id="app">

        <div class="contents app-wrapper">
            <aside class="sidebar">
                @yield('sidebar')
                @yield('caption')
            </aside>
            <main class="main-wrapper">
                @yield('content')
            </main>          
        </div>
        {{-- <hr class="hr mt-5"> --}}

    </div>
    <footer>
        @yield('footer')
    </footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
