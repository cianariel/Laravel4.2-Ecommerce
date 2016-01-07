<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
    </head>

    <body class="@yield('body-class', '')">
    @include('layouts.parts.header')

        @yield('content')

    @include('layouts.parts.footer')
    </body>
</html>
