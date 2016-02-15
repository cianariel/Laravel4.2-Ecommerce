<!DOCTYPE html>
<html>
<head>
    @include('layouts.parts.head')
</head>

<body ng-app="rootApp" class="@yield('body-class', '')">
<div {{--ng-app="pagingApp"--}}>
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.footer')
    @include('layouts.parts.login-signup')
</div>

<script src="/assets/js/vendor/angular-busy.min.js"></script>
<script src="/assets/js/angular-custom/custom.paging.js"></script>
<script src="/assets/js/angular-custom/public.common.js"></script>
<script type="text/javascript" src="/assets/js/vendor/autocomplete.js"></script>
<script type="text/javascript" src="/assets/product/js/custom.product.js"></script>
<script>
    var rootApp = angular.module('rootApp', ['pagingApp', 'publicApp','productApp']);
</script>
</body>
</html>
