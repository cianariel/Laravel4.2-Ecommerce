<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.parts.head')
</head>

<body ng-app="rootApp" class="@yield('body-class', ''){{@$userData['login'] ? ' logged-in' : ''}}">

<!-- Google Tag Manager --> <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MLNV2R" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-MLNV2R');</script> <!-- End Google Tag Manager -->

<div class="over-wrap" id="o-wrapper">
    @include('layouts.parts.header')

    @yield('content')

    @include('layouts.parts.login-signup')
    @include('layouts.parts.footer')
</div>



<nav id="dummy" class="dummy slide-menu c-menu c-menu--push-left">

    <form class="search-bar col-sm-2 col-lg-2 pseudo-full-wide" ng-app="publicApp" ng-controller="SearchController" action="/search-form-query" autocomplete="off">
        <span class="search-input-holder">
            <i class="m-icon m-icon--search-id"></i>
            <input ng-click="toggleSearch()" id="search-input"
                   ng-change="openSearchDropdown(query)" ng-model="query"
                   ng-model-options='{ debounce: 800 }' class="form-control top-search"
                   type="text" name="search" placeholder="Find Smart Products..."/>
            <div id="suggest-category" ng-class="{shown: open, hidden: !open}"
                 ng-show="categorySuggestions.length">
                <?php // have to use only pure php includes, or the CMS wont read it
                include('/var/www/ideaing/resources/views/layouts/parts/search-dropdown.blade.php')
                ?>
            </div>
            <i class="hide-search m-icon--Close hidden-xs"></i>
        </span>
    </form>

    <ul class="top-menu col-xs-9">
        <li>
            <a class="shop m-icon-text-holder dark-orange" href="/shop">
                <i class="m-icon m-icon--shopping-bag-light-green orange"></i>
                <span class="m-icon-text orange text-bold">Shop</span>
            </a>
        </li>
    </ul>
    <ul class="mid-menu col-xs-12">
        <li class="col-xs-12 nested">
            <a data-click="#show-smart-home" href="/smart-home" class="category-link__smart-home" href="#">
                <i class="m-icon m-icon--smart-home"></i>
                <span class="m-icon-text">Smart Home</span>
            </a>
            <ul class="child wrap col-xs-12">
                <li><a href="https://ideaing.com/idea/kitchen">Kitchen</a></li>
                <li><a href="https://ideaing.com/idea/bath">Bath</a></li>
                <li><a href="https://ideaing.com/idea/bedroom">Bedroom</a></li>
                <li><a href="https://ideaing.com/idea/office">Office</a></li>
                <li><a href="https://ideaing.com/idea/living">Living</a></li>
                <li><a href="https://ideaing.com/idea/outdoor">Outdoor</a></li>
                <li><a href="https://ideaing.com/idea/lighting">Lighting</a></li>
                <li><a href="https://ideaing.com/idea/security">Security</a></li>
            </ul>
        </li>
        <li class="col-xs-12">
            <a data-click="#show-smart-entertainment" class="category-link__smart-entertainment m-icon-text-holder" href="/smart-entertainment">
                <i class="m-icon m-icon--video"></i>
                <span class="m-icon-text"><span>Smart</span> Entertainment</span>
            </a>
        </li>
        <li class="col-xs-12">
            <a data-click="#show-smart-body"  class="category-link__smart-body m-icon-text-holder" href="/ideas/smart-body">
                <i class="m-icon m-icon--wearables"></i>
                <span class="m-icon-text"><span>Smart</span> Body</span>
            </a>
        </li>
        <li class="col-xs-12">
            <a data-click="#show-smart-travel" class="category-link__smart-travel m-icon-text-holder" href="/ideas/smart-travel">
                <i class="m-icon m-icon--travel"></i>
                <span class="m-icon-text"><span>Smart</span> Travel</span>
            </a>
        </li>
        <li class="col-xs-12">
            <a class="category-link__advice m-icon-text-holder" href="/advice">
                <i class="m-icon m-icon--comments-products"></i>
                <span class="m-icon-text">Advice</span>
            </a>
        </li>
    </ul>
</nav>

<script>
    (function() {
        /* In animations (to close icon) */

        var beginAC = 80,
                endAC = 320,
                beginB = 80,
                endB = 320;

        function inAC(s) {
            s.draw('80% - 240', '80%', 0.3, {
                delay: 0.1,
                callback: function() {
                    inAC2(s)
                }
            });
        }

        function inAC2(s) {
            s.draw('100% - 545', '100% - 305', 0.6, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function inB(s) {
            s.draw(beginB - 60, endB + 60, 0.1, {
                callback: function() {
                    inB2(s)
                }
            });
        }

        function inB2(s) {
            s.draw(beginB + 120, endB - 120, 0.3, {
                easing: ease.ease('bounce-out', 1, 0.3)
            });
        }

        /* Out animations (to burger icon) */

        function outAC(s) {
            s.draw('90% - 240', '90%', 0.1, {
                easing: ease.ease('elastic-in', 1, 0.3),
                callback: function() {
                    outAC2(s)
                }
            });
        }

        function outAC2(s) {
            s.draw('20% - 240', '20%', 0.3, {
                callback: function() {
                    outAC3(s)
                }
            });
        }

        function outAC3(s) {
            s.draw(beginAC, endAC, 0.7, {
                easing: ease.ease('elastic-out', 1, 0.3)
            });
        }

        function outB(s) {
            s.draw(beginB, endB, 0.7, {
                delay: 0.1,
                easing: ease.ease('elastic-out', 2, 0.4)
            });
        }

        /* Awesome burger default */

        var pathA = document.getElementById('pathA'),
                pathB = document.getElementById('pathB'),
                pathC = document.getElementById('pathC'),
                segmentA = new Segment(pathA, beginAC, endAC),
                segmentB = new Segment(pathB, beginB, endB),
                segmentC = new Segment(pathC, beginAC, endAC),
                trigger = document.getElementById('menu-icon-trigger'),
                toCloseIcon = true,
                dummy = document.getElementById('dummy'),
                wrapper = document.getElementById('menu-icon-wrapper');

        wrapper.style.visibility = 'visible';

        trigger.onclick = function() {
            if (toCloseIcon) {
                inAC(segmentA);
                inB(segmentB);
                inAC(segmentC);

                dummy.className = 'dummy slide-menu dummy--active';
            } else {
                outAC(segmentA);
                outB(segmentB);
                outAC(segmentC);

                dummy.className = 'dummy  slide-menu';
            }
            toCloseIcon = !toCloseIcon;
        };

        /* Scale functions */

        function addScale(m) {
            m.className = 'menu-icon-wrapper scaled';
        }

        function removeScale(m) {
            m.className = 'menu-icon-wrapper';
        }

        /* Awesome burger scaled */

        var pathD = document.getElementById('pathD'),
                pathE = document.getElementById('pathE'),
                pathF = document.getElementById('pathF'),
                segmentD = new Segment(pathD, beginAC, endAC),
                segmentE = new Segment(pathE, beginB, endB),
                segmentF = new Segment(pathF, beginAC, endAC),
                wrapper2 = document.getElementById('menu-icon-wrapper2'),
                trigger2 = document.getElementById('menu-icon-trigger2'),
                toCloseIcon2 = true,
                dummy2 = document.getElementById('dummy2');

        wrapper2.style.visibility = 'visible';

        trigger2.onclick = function() {
            addScale(wrapper2);
            if (toCloseIcon2) {
                inAC(segmentD);
                inB(segmentE);
                inAC(segmentF);

                dummy2.className = 'dummy dummy--active';
            } else {
                outAC(segmentD);
                outB(segmentE);
                outAC(segmentF);

                dummy2.className = 'dummy';
            }
            toCloseIcon2 = !toCloseIcon2;
            setTimeout(function() {
                removeScale(wrapper2)
            }, 450);
        };

    })();
</script>

</body>
</html>
