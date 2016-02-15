<!DOCTYPE html>
<html>
<head>
    @include('layouts.parts.head')
</head>

<body ng-app="rootApp" class="@yield('body-class', '')">
<div {{--ng-app="pagingApp"--}}>
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.login-signup')
    @include('layouts.parts.footer')
</div>


</body>
</html>
