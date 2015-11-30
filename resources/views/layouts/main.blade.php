<!DOCTYPE html>
<html>
    <head>
        <title>Ideaing</title>

{{--        {{ HTML::style('css/app.css') }}--}}
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body>
        <header class="colophon">
                <div class="col-xs-12">
                    <h2 id="site-name">Ideaing | Ideas for Smarter Living</h2>
                    <nav id="top-nav" class="row">
                        <div class="container">
                            <div  class="col-sm-5">
                                <ul>
                                    <li class="nested"><a href="">Shop</a></li>
                                    <li><a href="">Pros</a></li>
                                    <li><a href="">Discuss</a></li>
                                </ul>
                            </div>

                            <div class="col-sm-2">
                                <img src="/assets/images/ideaing-logo.png" id="ideaing-logo" class="logo top-logo"/>
                            </div>
                            <section class="search-bar col-sm-2">
                                <input class="form-control" type="text" name="search" value="Search..."/>
                            </section>
                            <div class="col-sm-2 pull-right signin">
                                <a href="#">Sign in</a>
                            </div>
                        </div>
                    </nav>
                </div>


        </header>
            @yield('content')
    </body>
</html>
