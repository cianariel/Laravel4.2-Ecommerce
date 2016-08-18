<div class="clearfix pocket"></div>

<footer class="about-footer hide-soft">
    <div class="container">
        <div class="col-sm-3 col-xs-12">
            <h4 class="blue">About Ideaing</h4>
            <ul>
                <li><a href="/aboutus">About Us</a></li>
                <li><a href="/contactus">Contact Us</a></li>
                <li><a href="/terms-of-use">Terms of Use</a></li>
                <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="col-sm-3 col-xs-12">
            <h4 class="green">Giveaway</h4>
            <?php
                if(!isset($theGiveAway)){
                    if(!function_exists('is_single')){
                        $theGiveAway = PageHelper::getCurrentGiveaway();
                    }else{

                    if(isset($_COOKIE['giveaway_pop_shown'])){
                        $noPopup = 1;
                    }else{
                        $noPopup = 0;
                    }

                    $json = file_get_contents('https://ideaing.com/api/giveaway/get-current/' . $noPopup);
        
                        $theGiveAway = json_decode($json);
                    }
                } 

            if($theGiveAway && @$theGiveAway->giveaway_permalink){ ?>
                <a href="/giveaway/<?php echo $theGiveAway->giveaway_permalink ?>">
                    <img src="<?php echo $theGiveAway->giveaway_image ?>" title="<?php echo $theGiveAway->giveaway_image_title ?>" alt="<?php echo $theGiveAway->giveaway_image_alt ?>" />
                </a>

                <a href="/giveaway/ <?php echo $theGiveAway->giveaway_permalink ?>">
                   <h6 class="white"> <?php echo $theGiveAway->giveaway_title ?></h6>
                </a>

            <?php
                }
            ?>


        </div>
        <div class="col-sm-3 col-xs-12 social-connect">
            <h4 class="orange">Let's connect</h4>
            <ul>
                <li><a class="fb" href="https://www.facebook.com/ideaingsmarterliving"><span><i class="m-icon--facebook-id"></i> Like <b class="fan-count fb count"></b></span></a></li>
                <li><a class="twi" href="https://twitter.com/ideaing/"><span><i class="m-icon--twitter-id"></i> Follow  <b class="fan-count twi count"></b></span></a></li>
                <li><a class="gp" href="http://google.com/+Ideaingsmarterliving"><span><i class="m-icon--google-plus-id"></i> Follow <b class="fan-count gp count"></b></span></a></li>
                <li><a class="pint" href="https://www.pinterest.com/ideaing_com"><span><i class="m-icon--pinterest-id"></i> Follow <b class="fan-count pint count"></b></span></a></li>
                <li><a class="inst" href="https://www.instagram.com/ideaing_com/"><span><i class=" m-icon--footer-instagram"></i> Follow <b class="fan-count inst count"></b></span></a></li>
            </ul>
        </div>
        <div class="col-sm-3 col-xs-12" ng-app="publicApp" ng-controller="publicController">
            <strong class="red"><?php echo "{{ responseMessage }}";?></strong>
            <h4 class="pink">Ideas to You</h4>
            <span class="email-input-holder ">
                    <i class="m-icon m-icon--email-form-id black"></i>
                    <input class="form-control" type="text" ng-model="data.SubscriberEmail" placeholder="Email address">
                    <input class="form-control" type="submit" ng-click="subscribe(data,'footer')" />
            </span>
        </div>
    </div>
    <button class="btn-none close-down" data-toggle=".about-footer"></button>
</footer>





<div class="page-overlay"></div>
<div class="page-overlay picture-overlay"></div>

<div class="bottom-block">
    <button class="btn btn-success" id="about-button" data-toggle=".about-footer">About</button>
    <a href="#" id="back-to-top">
        <i class="m-icon--footer-up-arrow"></i>
    </a>
</div>


<script>
    var rootApp = angular.module('rootApp', ['pagingApp', 'publicApp','productApp']);
</script>

<script>
    // CompleteRegistration
    // Track when a registration form is completed (ex. complete subscription, sign up for a service)
    fbq('track', 'CompleteRegistration');
</script>
 

<?php if(function_exists('is_single') || (Request::segment(1) != 'login' && Request::segment(1) != 'signup' && Request::segment(1) != 'product')){ ?>
     <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         data-ad-client="ca-pub-8975651769887133"
         data-ad-slot="7018993602"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
<?php } ?>
<!-- Homepage -->



<nav id="dummy" class="dummy slide-menu c-menu c-menu--push-left">
    <span class="close-button pull-right slide-back">
        <i class="m-icon--Close"></i>
    </span>
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
            <a href="/ideas/smart-home" class="category-link__smart-home" href="#">
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
            <a class="category-link__smart-entertainment m-icon-text-holder" href="/ideas/smart-entertainment">
                <i class="m-icon m-icon--video"></i>
                <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Entertainment</span>
            </a>
        </li>
        <li class="col-xs-12">
            <a class="category-link__smart-body m-icon-text-holder" href="/ideas/smart-body">
                <i class="m-icon m-icon--wearables"></i>
                <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Body</span>
            </a>
        </li>
        <li class="col-xs-12">
            <a class="category-link__smart-travel m-icon-text-holder" href="/ideas/smart-travel">
                <i class="m-icon m-icon--travel"></i>
                <span class="m-icon-text"><span class="hidden-xs hidden-sm">Smart</span> Travel</span>
            </a>
        </li>
    </ul>
</nav>

<script src="http://tympanus.net/Tutorials/AnimatedMenuIcon/js/segment.min.js"></script>
<script src="http://tympanus.net/Tutorials/AnimatedMenuIcon/js/ease.min.js"></script>

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
