<div id="publicApp" ng-app="publicApp" ng-controller="publicController">
  <!-- {{-- <div ng-app="pagingApp" ng-controller="headerController" > --}} -->
        <header class="colophon">
                <div class="col-xs-12">
                    <h2 id="site-name">Ideaing | Ideas for Smarter Living</h2>

                    <nav id="top-nav" class="row">
                        <div class="container full-sm fixed-sm">
                            <div class="top-nav-holder">
                                <div class="visible-xs col-xs-1">
                                    <div class="mobile-menu-switch " data-toggle=".mobile-menu" data-overlay="true"></div>
                                </div>
                                <div class="mobile-menu col-xs-8 hidden-soft">
                                    <ul>
                                        <li><a class="ideas" href="#"><i class="m-icon m-icon--bulb"></i>&nbsp; Ideas</a></li>
                                        <li><a class="shop" href="#"><i class="m-icon m-icon--item"></i>&nbsp; Shop</a></li>
                                        <li><a class="disc" href="#"><i class="m-icon m-icon--discuss-active"></i>&nbsp; Discuss</a></li>

                                    </ul>
                                </div>
                                <div  class="col-sm-5 category-menu hidden-xs">
                                    <ul>
                                        <li>
                                            <a class="ideas" href="#">
                                                <i class="m-icon m-icon--bulb"></i>
                                                <span class="m-icon-text">Ideas</span>
                                                <span class="box-link-active-line"></span>
                                            </a>
                                        </li>
                                        <li class="nested">
                                            
                                            <a class="shop" data-toggle=".shop-menu" href="#"><i class="m-icon m-icon--item"></i>
                                                <span class="m-icon-text">Shop</span> 
                                                <span class="box-link-active-line"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="disc" href="#"><i class="m-icon m-icon--discuss-active"></i>&nbsp;
                                                <span class="m-icon-text">Discuss</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-xs-6 col-sm-3 text-center">
                                    <a id="ideaing-logo" class="center-block" href="/">
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
                                </div>

                                <section class="search-bar col-sm-2 hidden-xs">
                                    <div class="row">
                                        <span class="search-input-holder visible-sm visible-md visible-lg">
                                            <i class="m-icon m-icon--search-id"></i>
                                            <input class="form-control  " type="text" name="search" placeholder="Search..."/>
                                        </span>
                                    </div>
                                </section>

                                <?php if(isset($login) && $login) { ?>
                                    <div class="col-xs-5 col-sm-2">
                                        <div class="row">
                                            <div class="pull-right profile-photo-holder">
                                                <a href="#"><img width="40px" src="<?php echo isset($profile) ? $profile : "" ?>" alt="" class="profile-photo "></a>
                                                <span class="box-link-active-line"></span>
                                                <div class="profilelinks-popup">
                                                    <div class="menu-group">
                                                        <div><a href="#">My Profile</a> </div>
                                                        <div><a href="#" class="edit-profile-link" ng-click="openProfileSetting()">Edit Profile</a> </div>
                                                    </div>
                                                    <div class="menu-group">
                                                        <div><a href="#">Invite Friends</a> </div>
                                                        <div><small>855 Friends</small> </div>
                                                        <div><small>12 Messages</small> </div>
                                                    </div>
                                                    <div class="log-out"><a href=""><i class="m-icon--Logout-Active"></i> Log Out</a></div>
                                                </div>
                                            </div>
                                            <div class="notification pull-right">
                                                <a href="#" data-toogle=".notification-popup" class="notification-holder">
                                                    <i class="m-icon m-icon--Notifications"></i>
                                                    <span class="notification-count">12</span>
                                                </a>
                                                <div class="notification-popup">
                                                    <div class="notification-header">
                                                        <span class="pull-left">Notifications</span>
                                                        <span class="pull-right" id="mark-all-as-read">Mark all as read</span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <?php for($i=0; $i<5; $i++) {?>
                                                            <div class="notification-item">
                                                                <img width="40px" src="<?php echo isset($profile) ? $profile : "" ?>" class="profile-photo pull-left">
                                                                <div>
                                                                    <span><strong>Syvia Saint Creat</strong> commented on your photos</span><br>
                                                                    <small>58 minutes ago</small>
                                                                </div>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                    <div class="notification-footer">
                                                        <span id="notification-view-all">View all</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" class="search-toggle visible-xs pull-right" data-toggle=".mobile-search-bar"><i class="m-icon m-icon--search-id"></i></a>

                                        </div>
                                    </div>
                                <?php }  else { ?>
                                <div class="col-xs-3 col-sm-2  signin">
                                    <div class="row">
                                        <a data-toggle="modal" data-target="#myModal" href="/login"><i class="m-icon m-icon--user"></i> Log in</a>
                                    </div>
                                </div>
                               <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </nav>
                </div>
                <div class="mobile-search-bar col-xs-12">
                    <input class="form-control col-xs-10" type="text" value="Search..."/>
                </div>
        </header>

        <?php // have to use only pure php includes, or the CMS wont read it
             include('/var/www/ideaing/resources/views/layouts/parts/shop-submenu.blade.php')
        ?>


        <nav class="mid-nav rooms hidden-xs">
            <div class="container full-sm fixed-sm">
                <ul class="wrap col-xs-9">
                    <li class="home active">
                        <a class="box-link" href="">
                        <span class="box-link-active-line"></span>
                            <i class="m-icon m-icon--smart-home"></i> Smart Home
                        </a>
                    </li>
                    <li><a class="box-link" href="/room/kitchen">Kitchen</a></li>
                    <li><a class="box-link" href="/room/bath">Bath</a></li>
                    <li><a class="box-link" href="/room/bedroom">Bedroom</a></li>
                    <li><a class="box-link" href="/room/office">Office</a></li>
                    <li><a class="box-link" href="/room/living">Living</a></li>
                    <li><a class="box-link" href="/room/outdoor">Outdoor</a></li>
                    <li><a class="box-link" href="/room/lighting">Lighting</a></li>
                    <li><a class="box-link" href="/room/decor">Decor</a></li>
                    <!--<li><a data-toggle=".extra-nav" class="more-link extra" href="">...</a>
                        <ul class="extra-nav hidden-620 hidden-soft">
                            <li><a class="travel-link blue" href="#">Travel</a></li>
                            <li><a class="wearables-link green" href="#">Wearables</a></li>
                        </ul>
                    </li>-->

                </ul>
            </div>
            <div class="container mobile-menu hidden-lg hidden-md hidden-sm hidden-xs full-620  fixed-sm">
                <ul>
                    <li><a href="/room/kitchen">Kitchen</a></li>
                    <li><a href="/room/kitchen">Bath</a></li>
                    <li><a class="nested" data-toggle=".mobile-more-nav" data-hide=".mobile-extra-nav" href="">More</a></li>
                    <li><a class="more-link" data-toggle=".mobile-extra-nav"  data-hide=".mobile-more-nav" href="">...</a></li>

                    <ul class="extra-nav mobile-extra-nav">
                        <li><a href="">Wallpaper</a></li>
                        <li><a href="">Pillows</a></li>
                        <li><a href="">Travel</a></li>
                        <li><a href="">Wearables</a></li>
                    </ul>
                    <ul class="extra-nav mobile-more-nav">
                        <li><a href="/room/bedroom">Bedroom</a></li>
                        <li><a href="/room/office">Office</a></li>
                        <li><a href="/room/living">Living</a></li>
                        <li><a href="/room/outdoor">Outdoor</a></li>
                    </ul>
                </ul>
            </div>
        </nav>
        <?php if(isset($login) && $login) {?>
            <script type="text/ng-template"  id="profile-setting.html">
                <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>
                
                <div class="profile-background">
                    <div class="text-center"><img class="profile-photo" width="150px" src="<?php echo isset($profile) ? $profile : ""?>"></div>

                </div>
                <div class="first-form">
                    <div class="custom-container ">
                        <form class="form-horizontal">
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Full Name</label>
                                <div class="col-lg-12">
                                    <input class="form-control" ng-model="data.FullName" ng-init="data.FullName = '{{ $userData['name'] }}'"   placeholder="Full name">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Email</label>
                                <div class="col-lg-12">
                                    <input class="form-control" ng-model="data.Email" ng-init="data.Email = '{{ $userData['email'] }}'" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">New password</label>
                                <div class="col-lg-12">
                                    <input class="form-control" ng-model="data.Password" placeholder="New password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Bio</label>
                                <div class="col-lg-12">
                                    <textarea class="form-control"  ng-model="data.PersonalInfo" ng-init="data.PersonalInfo = '{{ $userData['userProfile']['personal_info'] }}'" placeholder="Bio"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Address</label>
                                <div class="col-lg-12">

                                    <textarea class="form-control"  ng-model="data.Address" ng-init="data.Address = '{{ $userData['userProfile']['address']  }}'" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Personal link</label>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">http://staging.ideaing.com/user/</div>
                                    <div class="col-lg-6">
                                    <input class="form-control personal-link" ng-model="data.Permalink" ng-init="data.Permalink = '{{ $userData['userProfile']['permalink']  }}'"  placeholder="">
                               </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-lg-12 control-label">Profie Picture</label>
                                <div class="col-lg-12">



                                    <div class="col-lg-6">
                              <input type="file" name="file" nv-file-select=""
                                     uploader="uploader"/>
                                        </div>
                                    <div class="col-lg-4">
                                        <img id="currentPhoto"
                                             ng-src='@{{ mediaLink }}'
                                             onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'"
                                             width="170">
                                    </div>




                                        {{--ng-click="$parent.uploader.uploadAll()">Upload--}}
                                    </button>
                                </div>
                                <div class="text-center">
                                    <a href="#"  ng-click="uploader.uploadAll()" class="upload-photo">
                                        <i class="m-icon--Upload-Inactive"></i><br>
                                        <span>Upload new profile picture</span>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-nevermind">Nevermind</button>
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
                                                <input type="checkbox" value="1" >
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
                                                <input type="checkbox" value="1" >
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
                                                <input type="checkbox" value="1" >
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
                                                <input type="checkbox" value="1" >
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