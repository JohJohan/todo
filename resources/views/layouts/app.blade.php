<!DOCTYPE html>
<html lang="en">

    @include('partials._head')

    <body>

        @include('partials._nav')

            @include('partials._messages')

            @yield('content')

        @include('partials._footer')

        <!-- Scripts -->
        <script src="/js/app.js"></script>
        @yield('scripts')

    </body>
</html>
