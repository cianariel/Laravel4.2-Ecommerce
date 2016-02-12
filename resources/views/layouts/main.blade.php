<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
    </head>

    <body class="@yield('body-class', '')">
    <div ng-app="pagingApp">
    @include('layouts.parts.header')

        @yield('content')

    @include('layouts.parts.footer')
    @include('layouts.parts.login-signup')
    </div>
    

    </body>
</html>
