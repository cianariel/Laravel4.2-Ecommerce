<!DOCTYPE html>
<html>
    <head>
        <title>Ideaing</title>
        <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script>
            if (screen.width < 992 && screen.width > 620) {
                document.getElementById("viewport").setAttribute("content", "width=980");
            }
//
//            window.onresize = function() {
//                if (screen.width < 992 && screen.width > 620) {
//                    document.getElementById("viewport").setAttribute("content", "width=992, initial-scale=1, maximum-scale=2");
//                }
//            }
        </script>
{{--        {{ HTML::style('css/app.css') }}--}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <script src="/assets/js/vendor/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <header class="colophon">
                <div class="col-xs-12">
                    <h2 id="site-name">Ideaing | Ideas for Smarter Living</h2>
                    <nav id="top-nav" class="row">
                        <div class="container full-sm fixed-sm">
                            <div  class="col-md-4 col-sm col-xs-4 category-menu hidden-620">
                                <ul>
                                    <li class="nested"><a class="shop" href="">Shop</a></li>
                                    <li><a class="pros" href="">Pros</a></li>
                                    <li><a class="disc" href="">Discuss</a></li>
                                </ul>
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-3 logo-wrap">
                                <img src="/assets/images/ideaing-logo-small.png" id="ideaing-logo" class="logo top-logo img-responsive"/>
                            </div>

                            <div  class="col-md-4 col-sm col-xs-4 category-menu mobile-category-menu hidden-620 shown-620">
                                <ul>
                                    <li class="nested"><a class="shop" href="">Shop</a></li>
                                    <li><a class="pros" href="">Pros</a></li>
                                    <li><a class="disc" href="">Discuss</a></li>
                                </ul>
                            </div>

                            <section class="search-bar col-xs-2 col-md-2">
                                <a href="#" class="search-toggle" data-toggle=".mobile-search-bar">Search</a>
                                <input class="form-control  hidden-620" type="text" name="search" value="Search..."/>
                            </section>
                            <div class="col-md-2 col-xs-2 pull-right signin">
                                <a data-toggle="modal" data-target="#myModal" href="#">Log in</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="mobile-search-bar col-xs-12">
                    <input class="form-control col-xs-10" type="text" value="Search..."/>
                </div>


        </header>
            @yield('content')
        <a href="#" id="back-to-top">Back to top</a>
        <script src="/assets/js/app.js"></script>

    </body>
</html>
