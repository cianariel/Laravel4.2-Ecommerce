<?php
  // !! IMPORTANT !! -- please use only pure PHP here, no Laravel, otherwise the header will break   in Wordpress !!

if(function_exists('is_single')){
    if(isset($GLOBALS['userData']) &&  isset($GLOBALS['isAdmin'])){
        $userData = $GLOBALS['userData'];
        $isAdmin =  $GLOBALS['isAdmin']; 
    }  
}                                            
?>

<!--    <div {{--id="pagingApp" ng-app="pagingApp" ng-controller="headerController"--}}>-->
<style>
    [ng\:cloak], [ng-cloak], .ng-cloak {
        display: none !important;
    }
</style>
<div id="publicApp" ng-app="publicApp" ng-controller="publicController" ng-cloak>
<header class="colophon">
                <div ng-init="socialCounter()" class="col-xs-12">
                    <h2 id="site-name">Ideaing | Ideas for Smarter Living</h2>

                    <nav id="top-nav" class="row">
                        <div class="container full-sm fixed-sm">
                            <div class="top-nav-holder">
                            <div class="col-xs-5 col-sm-5 category-menu">
                                    <ul>
                                    <li class="visible-xs">
                                        <a class="mobile-top-menu-switcher" data-toggle="#mobile-top-menu" href="#">
                                            <i class=" m-icon--Close up"></i>
                                            <i class="m-icon--MenuButton down"></i>
<!--                                            <i class="m-icon--footer-up-arrow down"></i>-->
                                        </a>
                                    </li>
                                        <li>
                                            <a class="ideas" href="/ideas">
                                            <i class="hidden-xs m-icon m-icon--bulb"></i>
                                                <span class="m-icon-text">Ideas</span>
                                                <span class="box-link-active-line"></span>
                                            </a>
                                        </li>
                                        <li class="nested">
                                            <a class="m-icon-text-holder" href="/shop">
                                            <i class="hidden-xs m-icon m-icon--shopping-bag-light-green"></i>
                                                <span class="m-icon-text">Shop</span> 
                                                <span class="box-link-active-line" style="margin-left: 10px;"></span>
                                            </a>
                                        <a class="shop hidden-xs" data-toggle="#shop-menu" href="#">
                                                <i class="m-icon--Header-Dropdown down"></i>
                                                <i class="m-icon--footer-up-arrow up"></i>
                                            </a>
                                        </li>
                                    <li class="hidden-xs">
                                            <a class="disc" href="#"><i class="m-icon m-icon--discuss-active"></i>&nbsp;
                                                <span class="m-icon-text">Discuss</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            <div class="col-xs-2 col-sm-3 text-center">
                                <a id="ideaing-logo" class="center-block hidden-xs" href="/">
                                        <i class="m-icon m-icon--logo-without-text-blue">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span>
                                        </i>
    <!--                                    <img src="/assets/images/logo.png" class="img-responsive " alt="">-->
                                        <i class="m-icon m-icon--bulb2 scroll-logo">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                                        </i>
                                        <i class="m-icon m-icon--logo-without-text-red">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span>
                                        </i>
    <!--                                    <img src="/assets/images/logo-hover.png" class="img-responsive " alt="">-->
                                    </a>
                                <a id="ideaing-logo" class="center-block visible-xs" href="/">
                                    <i class="m-icon m-icon--bulb2">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                                    </i>
                                    <i class="m-icon m-icon--bulb2 scroll-logo">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                                    </i>
                                </a>
                                </div>

                                <form class="search-bar col-sm-2 hidden-xs" ng-app="publicApp"  ng-controller="SearchController" action="/search-form-query" autocomplete="off">
                                    <div class="row">
                                        <span style="position: relative" class="search-input-holder visible-sm visible-md visible-lg">
                                            <i class="m-icon m-icon--search-id"></i>
                                            <input ng-click="toggleSearch()" id="search-input" ng-change="openSearchDropdown(query)" ng-model="query" ng-model-options='{ debounce: 800 }' class="form-control top-search"  type="text" name="search" placeholder="Search..."/>
                                            <div id="suggest-category" ng-class="{shown: open, hidden: !open}" style="background: #fff; width: 200%; z-index: 50; border: 1px solid lightgray; position: absolute; top: 32px;">
                                                <?php // have to use only pure php includes, or the CMS wont read it
                                                include('/var/www/ideaing/resources/views/layouts/parts/search-dropdown.blade.php')
                                                ?>

                                            </div>
                                        </span>
                                    <span class="search-input-holder visible-xs">
                                        <i class="m-icon m-icon--search-id"></i>
                                    </span>
                                    </div>
                                </form>

                                    <div class="col-xs-5 col-sm-2">
                                        <div class="row">

                                            <?php 
                                            if(isset($userData['login']) && $userData['login']) { ?>
                                            <div class="pull-right profile-photo-holder">
                                                <a href="#"><img width="40px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link']: "" ?>" alt="" class="profile-photo "></a>
                                                <span class="box-link-active-line"></span>
                                                <div class="profilelinks-popup">
                                                    <div class="menu-group">
                                                        <div><a href="/user/profile">My Profile</a> </div>
                                                        <div><a href="#" class="edit-profile-link" ng-click="openProfileSetting()">Edit Profile</a> </div>
                                                        <?php if(isset($isAdmin) && ($isAdmin == true)){ ?>
                                                        <div><a href="/admin/dashboard" target="_blank" class="edit-profile-link">Admin Panel</a> </div>
                                                        <?php } ?>

                                                    </div>
                                                    <div class="menu-group">
                                                        <div><a href="#">Invite Friends</a> </div>
                                                        <div><small>855 Friends</small> </div>
                                                        <div><small>12 Messages</small> </div>
                                                    </div>
                                                    <div class="log-out"><a ng-click="logoutUser()"  href="#"><i class="m-icon--Logout-Active"></i> Log Out</a></div>

                                                </div>
                                            </div>
                                            <div class="notification pull-right" ng-cloak ng-init="loadNotification('<?php echo $userData['id']?>')">
                                                <a href="#" data-toogle=".notification-popup" class="notification-holder">
                                                    <i class="m-icon m-icon--Notifications"></i>
                                                    <span ng-hide="notificationCounter == 0" class="notification-count" ng-bind="notificationCounter"></span>
                                                </a>
                                                <div class="notification-popup">
                                                    <div class="notification-header">
                                                        <span class="pull-left">Notifications</span>
                                                        <span ng-click="readAllNotification()" class="pull-right" id="mark-all-as-read">Mark all as read</span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                
                                                    <div class="notification-body">
                                                            <div class="notification-item" ng-repeat="notice in notifications">
                                                                <img width="40px" ng-src="<?php echo '{{ notice.UserPicture }}' ?>" class="profile-photo pull-left">
                                                        <div class="notification-row-content">
                                                            <div><strong><?php echo '{{ notice.UserName }}' ?></strong>
                                                                <div ng-switch="notice.Section">
                                                                    <div ng-switch-when="ideas-heart">Liked</div>
                                                                    <div ng-switch-when="product-heart">Liked</div>
                                                                    <div ng-switch-default>Commented on</div>
                                                                </div>
                                                                <a ng-href="<?php echo '/{{ notice.ItemLink }}' ?>" ><?php echo '{{ notice.ItemTitle }}' ?></a> </div>
                                                            <small class="clearfix time "><?php echo '{{ notice.Time }}' ?></small>
                                                                </div>
                                                        <div class="clearfix"></div>
                                                            </div>
                                                    </div>
                                                    <div class="notification-footer">
                                                        <span id="notification-view-all">View all</span>
                                                    </div>
                                                </div>
                                            </div>

                                <?php }  else { ?>
                                        <a class="pull-right signin" data-toggle="modal" data-target="#myModal" href="/login"><i class="m-icon m-icon--user"></i> Log in</a>
                                    <?php } ?>
                                    <a href="#" class="search-toggle visible-xs pull-right" data-toggle=".mobile-search-bar"><i class="m-icon m-icon--search-id"></i></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </nav>
                </div>

                <form class="search-bar" ng-app="publicApp"  ng-controller="SearchController" action="/search-form-query" >
                    <div style="position: relative" class="mobile-search-bar col-xs-12">
                        <input ng-click="toggleSearch()" ng-change="openSearchDropdown(query)" ng-model="query" ng-model-options='{ debounce: 800 }'  class="form-control col-xs-10  top-search" type="text" value="Search..."  name="search" />
                        <div id="suggest-category" ng-class="{shown: open, hidden: !open}" style="background: #fff; width: 200%; float:left; z-index: 50; border: 1px solid lightgray; position: absolute; top: 45px;">
                            <?php // have to use only pure php includes, or the CMS wont read it
                            include('/var/www/ideaing/resources/views/layouts/parts/search-dropdown.blade.php')
                            ?>
                        </div>
                    </div>
                </form>

        </header>

        <?php // have to use only pure php includes, or the CMS wont read it
             include('/var/www/ideaing/resources/views/layouts/parts/shop-submenu.blade.php')
        ?>

        <div id="mobile-top-menu" class="mobile-top-menu" >
            <ul>
                <li><a class="ideas" href="/ideas"><i class="m-icon m-icon--bulb"></i>&nbsp; IDEAS</a></li>
                <li><a class="shop" href="/shop"><i class="m-icon m-icon--item"></i>&nbsp; SHOP</a></li>
                <li><a class="disc" href="#"><i class="m-icon m-icon--discuss-active"></i>&nbsp; DISCUSS</a></li>
            </ul>
        </div>

            <?php
                if(!function_exists('is_single')){ ?>
                        @include('room.header-menu')
            <?php     }

        ?>

    <?php if(isset($userData['login']) && $userData['login']) { ?>

    <script type="text/ng-template"  id="profile-setting.html">
                <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>
                
                <div class="profile-background">
                    <div class="text-center">
                        <!-- <img id="currentPhoto" class="profile-photo" width="150px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link']: "" ?>" onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170"> -->
                        <img id="currentPhoto" class="profile-photo" width="150px" ng-src='<?php echo "{{ mediaLink }}"  ?>' onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170">
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
                                   uploader="uploader" />
                        </span>
                        <span ng-hide="showBrowseButton" class="uploading-photo">
                            <button class="btn" ng-click="updateProfilePicture(data,mediaLink)">Save Picture</button>
                            <button class="btn" ng-click="cancelPictureUpdate()">Cancel</button>
                        </span>

                    </div>

                    <div class="form-group ">
                        <div class="col-lg-12">

                            <div class="col-lg-6"
                                 ng-init="initProfilePicture('<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link']: "" ?>')"
                            >&nbsp;
                            </div>
                        </div>
                    </div>

                </div>
                <div class="first-form">
                    <div class="custom-container ">
                        <form class="form-horizontal">
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Full name</label>
                                <div class="col-lg-12">
                                    <input class="form-control" ng-model="data.FullName" ng-init="data.FullName = '<?php echo  $userData['name'] ?>'"   placeholder="Full name">

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Email</label>
                                <div class="col-lg-12">
                                    <input class="form-control" ng-model="data.Email" ng-readonly="true" ng-init="data.Email = '<?php echo  $userData['email'] ?>'" placeholder="Email" />

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">New password</label>
                                <div class="col-lg-12">
                                    <input class="form-control" type="password" ng-model="data.Password" placeholder="New password">

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Bio</label>
                                <div class="col-lg-12">
                                    <textarea class="form-control"  ng-model="data.PersonalInfo" ng-init="data.PersonalInfo = '<?php echo  $userData['userProfile']['personal_info'] ?>'" placeholder="Bio"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Address</label>
                                <div class="col-lg-12">

                                    <textarea class="form-control"  ng-model="data.Address" ng-init="data.Address = '<?php echo  $userData['userProfile']['address']  ?>'" placeholder="Address"></textarea>

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Personal link</label>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">http://staging.ideaing.com/user/</div>
                                    <div class="col-lg-6">
                                        <input class="form-control personal-link" ng-model="data.Permalink" ng-init="data.Permalink = '<?php echo  $userData['userProfile']['permalink']  ?>'"  placeholder="">
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
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="form-group title">
                                    <label>Notify me about</label>
                                </div>
                                <div class="content">
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
                                    <label>Allow ideaing to use my Location</label>
                                </div>
                                <div class="content">
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
                                <div class="form-group ">
                                    <div class="pull-left its-over">
                                        <label>It's over!</label>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-delete">Delete my account 
                                            <i class="m-icon--Delete-Profile-Active">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                            </i> 
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </script>
        <?php } ?>


</div>

<!-- fake controller -->
<?php
        //dd($userData['email'],);
if(empty($userData['email']))
{
if((isset($userData['user-data']['hide-signup'])) && ($userData['user-data']['hide-signup'] != 'true'))
{

?>
    <input ng-model="canOpenEmailPopup" ng-init="canOpenEmailPopup = 1" type="hidden" >

    <script type="text/ng-template" id="subscribe_email_popup.html">
        <div id="subscribe_email_popup" ng-init="initEmailpopupPage()">
            <div id="publicApp">
                <div class="content-container">
                    <div class="content-holder">
                        <div>
                            <h4>Subscribe me to the world's finest design ideas community</h4></div><br><div>
                            <h5>Enter your email</h5> 
                            <strong style="color: red">@{{ responseMessage }}</strong>
                        </div>
                    <div>
                        <input class="form-control" ng-model="data.SubscriberEmail" placeholder="me@email.com" type="text"></div>
                        <br>
                        <div>
                            <a class="btn btn-success form-control" ng-click="subscribe(data)">Subscribe to Ideaing's newsletter</a>
                        </div>
                        <br>
                        <p>
                            <a href="/hide-signup">Never mind</a>
                        </p>
                    </div>
                </div>
                <div class="img-holder"><img src="/assets/images/emailpopupimg.png" style="width:100%; height:100%; position:relative"></div>
                <div class="clearfix"></div>
            </div>
        </div>
        
    </script>

<?php
    }

} 


?>



    
