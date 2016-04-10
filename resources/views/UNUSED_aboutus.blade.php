<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.parts.head')
    </head>

    <body class="@yield('body-class', '')">
    @include('layouts.parts.header')

        @yield('content')

    @include('layouts.parts.footer')
    @include('user.login-signup')
    

    </body>
</html>
