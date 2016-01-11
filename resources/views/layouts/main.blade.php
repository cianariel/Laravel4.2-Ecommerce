<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
    </head>

    <body class="@yield('body-class', '')">
    @include('layouts.parts.header')

        @yield('content')

    @include('layouts.parts.footer')
    @include('layouts.parts.login-signup') // needs to be here for Wordpress' sake

    </body>
</html>
