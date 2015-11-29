<!DOCTYPE html>
<html>
    <head>
        <title>Ideaing</title>

{{--        {{ HTML::style('css/app.css') }}--}}
    </head>
    <body>
        <header class="colophon">
            <div class="col-xs-12">
                <h2>Ideaing | Ideas for Smarter Living</h2>
                <nav id="top-nav">
                    <ul>
                        <li><a href="">Shop</a></li>
                        <li><a href="">Pros</a></li>
                        <li><a href="">Discuss</a></li>
                    </ul>
                </nav>
                <img class="logo top-logo"/>
                <section class="search-bar">
                    <input type="text" name="search" value="Search..."/>
                </section>
                <div>
                    <a href="#">Sign in</a>
                </div>
            </div>

            <nav id="mid-nav">
                <ul>
                    <li><a href="">All ideas</a></li>
                    <li><a href="">Kitchen</a></li>
                    <li><a href="">Bedroom</a></li>
                    <li><a href="">Office</a></li>
                    <li><a href="">Living</a></li>
                    <li><a href="">Outdoor</a></li>
                    <li><a href="">Lighting</a></li>
                    <li><a href=""></a>Decor</li>
                    <li><a href=""></a>...</li>
                </ul>
            </nav>

        </header>



        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
