<!DOCTYPE html>
<html>
    <head>
        @include('layouts.parts.head')
        <style type = 'text/css'>
        </style>
    </head>

    <body class="@yield('body-class', 'terms-of-use-page')">
        @include('layouts.parts.header')

        <nav class="mid-nav">
            <div class="container full-sm fixed-sm">
                <ul class="wrap col-lg-9">
                    <li class="box-link-ul active-ul ">
                        <a class="box-link active" href="#">
                            <span class="box-link-active-line"></span>
                            Terms of Use
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mid-bottom-container">
            @include('layouts.parts.terms-of-use-content')
        </div>


        @include('layouts.parts.footer')

        @include('layouts.parts.login-signup')
    

    </body>
</html>