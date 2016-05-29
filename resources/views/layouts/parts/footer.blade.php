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
                        $json = file_get_contents('http://ideaing.dev/api/giveaway/get-current');
                        $theGiveAway = json_decode($json);
                    }
                }

            if($theGiveAway){ ?>
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
            <input class="form-control" type="text" ng-model="data.SubscriberEmail" placeholder="Email address">
            <input class="form-control" type="button" ng-click="subscribe(data,'footer')" />
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
