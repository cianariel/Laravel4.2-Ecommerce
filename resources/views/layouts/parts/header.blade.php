<?php

// !! IMPORTANT !! -- please use only pure PHP here, no Laravel, otherwise the header will break   in Wordpress !!

if (function_exists('is_single')) {
    if (isset($GLOBALS['userData']) && isset($GLOBALS['isAdmin'])) {
        $userData = $GLOBALS['userData'];
        $isAdmin = $GLOBALS['isAdmin'];

    } else {
        //  $userData['email'] = [];
        $userData['user-data']['hide-signup'] = isset($_COOKIE['hide-signup']) ? true : false;
    }
}

if (!isset($theGiveAway)) {
    if (!function_exists('is_single')) {
        $theGiveAway = PageHelper::getCurrentGiveaway();
    } else {
         if(isset($_COOKIE['giveaway_pop_shown'])){
            $noPopup = 1;
         }else{
            $noPopup = 0;
         }

        $json = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/api/giveaway/get-current/' . $noPopup);

        $theGiveAway = json_decode($json);
    }
}
$shopPageClass = '';
if(isset($isShopPage) && $isShopPage == '1'){
    $shopPageClass = 'shop-page-header';
}

?>

<div id="publicApp" ng-app="publicApp" ng-controller="publicController" class="header-cloak scroll-header <?php echo $shopPageClass; ?>" ng-cloak>

    <header class="colophon container full-sm fixed-sm relative">
        <div>
            <nav id="top-nav" class="row">
                <a id="menu-icon-wrapper" class="menu-icon-wrapper home-hamburger mobile-top-menu-switcher hidden-lg hidden-md"  href="#">
                    <svg width="1000px" height="1000px">
                        <path id="pathA" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800" style="stroke-dashoffset: 5803.15; stroke-dasharray: 2901.57, 5258.15, 240;"></path>
                        <path id="pathB" d="M 300 500 L 700 500" style="stroke-dashoffset: 800; stroke-dasharray: 400, 600, 0;"></path>
                        <path id="pathC" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200" style="stroke-dashoffset: 6993.11; stroke-dasharray: 3496.56, 6448.11, 240;"></path>
                    </svg>
                    <button id="menu-icon-trigger" class="menu-icon-trigger"></button>
                </a>
                <div class="text-center logo-holder non-search-box-toggle">
                    <a class="ideaing-logo center-block" href="/" data-click="#show-default" >
                       <span class="m-icon m-icon--logo-with-text-black-blue default-logo">
                            <img src="/assets/svg/ideaing-logo-with-text-blue.svg" >
                       </span>

                        <span class="m-icon m-icon--logo-with-text-red red-logo">
                           <img src="/assets/svg/ideaing-logo-with-text-red.svg" >
                        </span>
                    </a>
                </div>

                <div class="text-center logo-holder search-box-toggle">
                    <a class="ideaing-logo center-block" href="/" data-click="#show-default" >
                       <span class="m-icon m-icon--logo-with-text-black-blue default-logo">
                            <img src="/assets/svg/logo-shop-with-text-blue.svg" >
                       </span>

                        <span class="m-icon m-icon--logo-with-text-red red-logo">
                           <img src="/assets/svg/logo-shop-with-text-red.svg" >
                        </span>
                    </a>
                </div>

               <!-- <a href="#" class="search-toggle-button mobile hidden-soft shown-620"><i class="m-icon m-icon--search-id"></i></a> -->

                    <div class="top-nav-holder">
                        <div class="category-menu">
                            <ul>
                                <li>
                                    <a data-click="#show-smart-home" class="category-link__smart-home" href="/smart-home"  ng-click="switchCategory('smart-home')">
                                        <span class="m-icon-text">
                                            <i class="m-icon m-icon--smart-home"></i>
                                            <span class="hidden-xs hidden-sm hidden-md">Smart</span>
                                            Home
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a data-click="#show-smart-entertainment" class="category-link__smart-entertainment m-icon-text-holder" href="/smart-entertainment" ng-click="switchCategory('smart-entertainment')">
                                        <span class="m-icon-text">
                                            <i class="m-icon m-icon--video"></i>
                                            <span class="hidden-xs hidden-sm hidden-md">Smart</span> 
                                            Entertainment
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a data-click="#show-smart-body" class="category-link__smart-body m-icon-text-holder" href="/smart-body"  ng-click="switchCategory('smart-body')">
                                       <span class="m-icon-text">
                                            <i class="m-icon m-icon--wearables"></i>
                                            <span class="hidden-xs hidden-sm hidden-md">Smart</span> 
                                            Body
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a data-click="#show-smart-travel" class="category-link__smart-travel m-icon-text-holder" ng-click="switchCategory('smart-travel')" href="/smart-travel">
                                        <span class="m-icon-text">
                                            <i class="m-icon m-icon--travel"></i>
                                            <span class="hidden-xs hidden-sm hidden-md ">Smart</span> 
                                            Travel
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="category-link__deals m-icon-text-holder hidden-sm hidden-xs" href="/deals">
                                        <span class="m-icon-text">
                                            <i class="m-icon m-icon--deals heavy-purple"></i>
                                            Deals
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="category-link__advice hidden-sm hidden-xs m-icon-text-holder" href="/advice">
                                        <span class="m-icon-text">
                                            <i class="m-icon m-icon--comments-products"></i>
                                            Advice
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="category-link__shop m-icon-text-holder hidden-sm hidden-xs" href="/shop">
                                        <span class="m-icon-text">
                                                <i class="m-icon m-icon--shopping-bag-light-green"></i>
                                            Shop
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form class="search-bar desktop-search-bar non-search-box-toggle col-sm-2 col-lg-2 pseudo-full-wide hidden-soft" ng-app="publicApp" ng-controller="SearchController" action="/search-form-query" autocomplete="off">
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

                        <div class="search-box-container search-box-toggle row">
                            <div class="shop-button-container col-md-2">
                                <a class="category-link__shop m-icon-text-holder hidden-xs" href="/shop">
                                    <span class="m-icon-text">Shop</span>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form class="search-bar desktop-search-bar shop-menu-search col-sm-2 col-lg-2 pseudo-full-wide hidden-soft" ng-app="publicApp" ng-controller="SearchController" action="/search-form-query" autocomplete="off">
                                    <span class="search-input-holder">
                                        <i class="m-icon m-icon--search-id"></i>
                                        <input id="search-input"  class="form-control top-search" type="text" name="search" placeholder="Find Smart Products..."/>
                                    </span>
                                </form>
                            </div>
                            <div class="shop-button-container col-md-2">
                                <a class="category-link__shop bottom-border-none m-icon-text-holder hidden-sm hidden-xs" href="/shop">
                                    <span class="m-icon-text">
                                        <i class="m-icon--shopping-bag-light-green"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="search-bar__overlay"></div>
                        </div>
                        <!--   <form class="search-bar mobile-search-bar col-sm-2 col-lg-2 hidden-soft" ng-app="publicApp" ng-controller="SearchController" action="/search-form-query" autocomplete="off">
                                        <span class="search-input-holder desktop-search-bar">
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
            </form> -->



                        <div class="col-xs-3 col-md-5 pull-right user-controls">
                                <ul class="searchbutton-wrap col-xs-2 no-padding  hidden-sm hidden-xs">
                                 <!--   <li>
                                        <a class="category-link__shop m-icon-text-holder hidden-xs" href="/shop">
                                            <i class="hidden-xs m-icon m-icon--shopping-bag-light-green black"></i>
                                            <span class="m-icon-text black">Shop</span>
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="#" class="search-toggle-button desktop hidden-xs"><i class="m-icon m-icon--search-id"></i></a>
                                    </li>
                                </ul>
                                <?php
                                if(isset($userData['login']) && $userData['login']) { ?>
                                <div class="pull-right profile-photo-holder logged-user" data-hideonout="true" data-toggle=".notification-popup">
                                    <a href="#"  ng-init="loadNotification('<?php echo $userData['id']?>')"><img width="40px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : "" ?>" alt="" class="profile-photo ">
                                    <span ng-hide="notificationCounter == 0" class="notification-count"
                                          ng-bind="notificationCounter"></span>
                                    </a>

                                <?php }  else { ?>
                                    <a class="signin" data-toggle="modal" data-target="#myModal" href="/login"></i> Hi, sign in</a>
                                    <a id="notification-trigger" class="new-message" href="#" ng-click="getEmailPopup(true)">
                                                <img width="40px" src="/assets/images/icons/ninja-01.svg" alt="" class="profile-photo ">
                                        <span class="notification-count ng-binding">1</span>
                                    </a>
                                <?php } ?>


                                </div>
                      <?php  if(isset($userData['login']) && $userData['login']){ ?>

                            <div class="notification-popup hide-on-out hidden-soft boxy">
                                <div class="notification-header">
                                    <div class="col-xs-12 center-block">
                                        <a href="#" data-switch=".notifs" data-hide=".prof-menu" class="active"><span>Notifications</span></a>
                                        <a href="#" data-switch=".prof-menu"  data-hide=".notifs"><span>My profile</span></a>
                                    </div>
                                </div>

                                <div class="notification-body">
                                    <div class="tab notifs">
                                        <span ng-click="readAllNotification()" class="pull-right red" id="mark-all-as-read">Mark all as read</span>

                                        <div class="notification-item" ng-repeat="notice in notifications">
                                            <img width="40px" ng-src="<?php echo '{{ notice.UserPicture }}' ?>" class="profile-photo pull-left">

                                            <div class="notification-row-content read-<?php echo '{{ notice.NoticeRead }}' ?>">
                                                <div><strong><?php echo '{{ notice.UserName }}' ?></strong>
                                                    <div ng-switch="notice.Section">
                                                        <div ng-switch-when="ideas-heart">Liked</div>
                                                        <div ng-switch-when="product-heart">Liked</div>
                                                        <div ng-switch-when="giveaway-heart">Liked</div>
                                                        <div ng-switch-default>Commented on</div>
                                                    </div>
                                                    <a ng-href="<?php echo '/{{ notice.ItemLink }}' ?>"><?php echo '{{ notice.ItemTitle }}' ?></a>
                                                </div>
                                                <small class="clearfix time "><?php echo '{{ notice.Time }}' ?></small>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div style="text-align: center">
                                            <a class="btn btn-primary btn-block" style="color: white"
                                               href="/user/notification"
                                               type="button">View All ...
                                            </a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="tab prof-menu">
                                        <div class="notification-item profile-menu">
                                            <div class="menu-group">
                                                <div><a href="/user/profile">My Profile</a></div>
                                                <div><a href="/user/notification">Show Notifications</a></div>
                                                <div><a href="#" class="edit-profile-link" ng-click="openProfileSetting()">Edit
                                                        Profile</a></div>
                                                <?php if(isset($isAdmin) && ($isAdmin == true)){ ?>
                                                <div><a href="/admin/dashboard" target="_blank" class="edit-profile-link">Admin
                                                        Panel</a></div>
                                                <?php } ?>

                                            </div>
                                            <div class="menu-group">
                                                <div><a href="#">Invite Friends</a></div>
                                            </div>
                                            <div class="log-out"><a ng-click="logoutUser()" href="#"><i class="m-icon--Logout-Active"></i> Log Out</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-footer">

                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>

                <?php
                if (function_exists('is_single')) {
                    $args = array(
                            'numberposts' => 5,
                    );

                    $topMenuContent = wp_get_recent_posts($args, ARRAY_A);
                } else {
                    $topMenuContent = PageHelper::getTopMenuItems();
                    if(isset($topMenuContent->posts)){
                        $topMenuContent = $topMenuContent->posts;
                    }
                }
                ?>

                <div id="mobile-top-menu" class="mobile-top-menu">
                    <ul>
                        <li class="nested nested-parent">
                            <a class="ideas" href="/ideas"><i class="m-icon m-icon--bulb"></i>&nbsp; IDEAS</a>
                            <a class="ideas" href="/ideas" data-switch=".idea-list" href="#">
                                <i class="m-icon--Header-Dropdown down"></i>
                                <i class="m-icon--footer-up-arrow up"></i>
                            </a>
                            <ul class="idea-list">
                                <?php
                                    foreach($topMenuContent as $story){

                                if($story->url){  ?>
                                <li><a href="<?php echo $story->url ?>"><?php echo $story->title ?> </a></li>
                                <?php    }else{ ?>
                                <li>
                                    <a href="/ideas/<?php echo $story['post_name'] ?>"><?php echo $story['post_title'] ?> </a>
                                </li>

                                <?php }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nested-parent">
                            <a class="shop" href="/shop"><i class="m-icon m-icon--item"></i>&nbsp; SHOP</a>
                            <a class="shop" href="/shop" data-toggle=".cat-list" href="#">
                                <i class="m-icon--Header-Dropdown down"></i>
                                <i class="m-icon--footer-up-arrow up"></i>
                            </a>
                            <ul class="cat-list">
                                <li>
                                    <a href="/shop/smart-home">Smart Home</a>
                                </li>
                                <li>
                                    <a href="/shop/active">Active</a>
                                </li>
                                <li>
                                    <a href="/shop/wearables">Wearables</a>
                                </li>
                                <li>
                                    <a href="/shop/home-decor">Home & Decor</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nested-parent">
                            <a class="shop" href="/giveaway"></i>&nbsp; GIVEAWAY</a>
                        </li>
                        <li class="nested-parent">
                            <a class="shop"></i>&nbsp; ROOMS</a>
                            <a class="shop" href="/shop" data-toggle=".room-list" href="#">
                                <i class="m-icon--Header-Dropdown down"></i>
                                <i class="m-icon--footer-up-arrow up"></i>
                            </a>
                            <ul class="room-list">
                                <li><a href=" /idea/kitchen">Kitchen</a></li>
                                <li><a href=" /idea/bath">Bath</a></li>
                                <li><a href=" /idea/bedroom">Bedroom</a></li>
                                <li><a href=" /idea/office">Office</a></li>
                                <li><a href=" /idea/living">Living</a></li>
                                <li><a href=" /idea/outdoor">Outdoor</a></li>
                                <li><a href=" /idea/lighting">Lighting</a></li>
                                <li><a href=" /idea/security">Security</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>

        </div>

        <?php // have to use only pure php includes, or the CMS wont read it
        include('/var/www/ideaing/resources/views/layouts/parts/shop-submenu.blade.php')
        ?>
    </header>

    <?php if(isset($userData['login']) && $userData['login']) { ?>

    <script type="text/ng-template" id="profile-setting.html">
        <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>

        <div class="profile-background">
            <div class="text-center">
                <!-- <img id="currentPhoto" class="profile-photo" width="150px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : "" ?>" onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170"> -->
                <img id="currentPhoto" class="profile-photo category-hover-border" width="150px" ng-src='<?php echo "{{ mediaLink }}"  ?>'
                     onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'"
                     width="170">
            </div>
            <div class="text-center">
                        <span ng-show="showBrowseButton" class="upload-photo">
                            <i class="m-icon--Upload-Inactive"></i><br>
                            <span>Upload new profile picture</span>

                            <input ng-init="initProfilePage()"
                                   id="fileLabel"
                                   class="upload-profile"
                                   type="file"
                                   name="file"
                                   nv-file-select=""
                                   uploader="uploader"/>
                        </span>
                        <span ng-hide="showBrowseButton" class="uploading-photo">
                            <button class="btn" ng-click="updateProfilePicture(data,mediaLink)">Save Picture</button>
                            <button class="btn" ng-click="cancelPictureUpdate()">Cancel</button>
                        </span>
            </div>

            <div class="form-group ">
                <div class="col-lg-12">

                    <div class="col-lg-6" ng-init="initProfilePicture('<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : "" ?>')">&nbsp;
                    </div>
                </div>
            </div>

        </div>
        <div ng-hide="onlyImage">
            <div class="first-form">
                <div class="custom-container ">
                    <form class="form-horizontal">
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">Full name</label>
                            <div class="col-lg-12">
                                <input class="form-control" ng-model="data.FullName"
                                       ng-init="data.FullName = '<?php echo $userData['name'] ?>'"
                                       placeholder="Full name">

                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">Email</label>
                            <div class="col-lg-12">
                                <input class="form-control" ng-model="data.Email" ng-readonly="true"
                                       ng-init="data.Email = '<?php echo $userData['email'] ?>'" placeholder="Email"/>

                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">New password</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="password" ng-model="data.Password"
                                       placeholder="New password">

                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">Bio</label>
                            <div class="col-lg-12">
                                <textarea class="form-control" ng-model="data.PersonalInfo"
                                          ng-init="data.PersonalInfo = '<?php echo $userData['userProfile']['personal_info'] ?>'"
                                          placeholder="Bio"></textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">Address</label>
                            <div class="col-lg-12">

                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>

                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-lg-12 control-label">Personal link</label>
                            <div class="col-lg-12">
                                <div class="col-lg-6">https://ideaing.com/user/profile/</div>
                                <div class="col-lg-6">
                                    <input class="form-control personal-link" ng-model="data.Permalink"
                                           ng-init="data.Permalink = '<?php echo $userData['permalink']  ?>'"
                                           placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <!--  <button class="btn btn-nevermind">Nevermind</button> -->
                            <button class="btn btn-save" ng-click="updateUser(data,mediaLink)">Save</button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="second-form">
                <div class="custom-container ">
                    <form class="form-horizontal">
                        <div class="col-sm-offset-2 col-sm-8"
                             ng-init="getProfileSettings('<?php echo $userData['id']  ?>')">
                            <div class="form-group title">
                                <label>Notify me about</label>
                            </div>
                            <div class="content">
                                <div class="form-group checkbox-form-group">
                                    <div class="pull-left">
                                        Daily notification email
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" ng-model="setDailyEmailNotification"
                                                   ng-click="setDailyEmail('<?php echo $userData['id']  ?>')">
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group checkbox-form-group">
                                    <div class="pull-left">
                                        Receive Weekly Newsletters from Ideaing on newest offers
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" value="1" checked>
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group checkbox-form-group">
                                    <div class="pull-left">
                                        New followers
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" value="1" checked>
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group checkbox-form-group">
                                    <div class="pull-left">
                                        Price-drops on products I like
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" value="1" checked>
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group checkbox-form-group">
                                    <div class="pull-left">
                                        Comments from others that I've engaged in
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" value="1" checked>
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group title">
                                <label>Subscription</label>
                            </div>
                            <div class="content">
                                <div class="form-group checkbox-form-group" ng-init="checkSubscription()">
                                    <div class="pull-left">
                                        VIP Membership Subscription
                                    </div>
                                    <div class="pull-right">
                                        <label class="setting-custom-checkbox">
                                            <input type="checkbox" ng-model="setMembershipSubscription"
                                                   ng-click="changeSubscription()">
                                                <span class="">
                                                    <i class="m-icon--Settings-Toggles-Active on">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <i class="m-icon--Settings-Toggles off">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="third-form">
                <div class="custom-container ">
                    <form class="form-horizontal">
                        <div class="col-sm-offset-2 col-sm-8">
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </script>
    <?php } ?>

</div>

<?php // have to use only pure php includes, or the CMS wont read it
    include('/var/www/ideaing/resources/views/layouts/parts/modals/newsletter.blade.php');

$segments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if(function_exists('is_home') || $segments[1] != 'signup' && $segments[1] != 'login'){
    include('/var/www/ideaing/resources/views/layouts/parts/login-signup.blade.php');
}
?>

