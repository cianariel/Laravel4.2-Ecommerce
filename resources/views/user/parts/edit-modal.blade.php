<script type="text/ng-template" id="profile-setting.html">
    <a class="close" href="#" ng-click="cancel()"><i class="m-icon--Close"></i> </a>

    <section class="personal-details col-xs-12">
        <h4>Personal Details</h4>
        <div class="col-sm-4 photo-wrap">
            <!-- <img id="currentPhoto" class="profile-photo" width="150px" src="<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : "" ?>" onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'" width="170"> -->
            <img id="currentPhoto" class="profile-photo category-hover-border" width="150px" ng-src='<?php echo "{{ mediaLink }}"  ?>'
                 onerror="this.src='http://s3-us-west-1.amazonaws.com/ideaing-01/thumb-product-568d28a6701c7-no-item.jpg'"
                 width="170">

                        <span ng-show="showBrowseButton" class="upload-photo">
                            <i class="m-icon--Upload-Inactive"></i><br>
                            <span>Upload new profile picture 2</span>

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

            <div class="form-group ">
                <div class="col-lg-12">
                    <div class="col-lg-6" ng-init="initProfilePicture('<?php echo isset($userData['medias'][0]['media_link']) ? $userData['medias'][0]['media_link'] : "" ?>')">&nbsp;
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-container col-sm-8">
            <form class="form-horizontal">
                <div class="form-group col-xs-6">
                    <label class="col-lg-12 control-label">First name</label>
                    <div class="col-lg-12">
                        <input class="form-control" ng-model="data.FullName"
                               ng-init="data.FullName = '<?php echo $userData['name'] ?>'"
                               placeholder="Full name">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="col-lg-12 control-label">Last name</label>
                    <div class="col-lg-12">
                        <input class="form-control" ng-model="data.FullName"
                               ng-init="data.FullName = '<?php echo $userData['name'] ?>'"
                               placeholder="Full name">
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-lg-12 control-label">Bio</label>
                    <div class="col-lg-12">
                                <textarea class="form-control" ng-model="data.PersonalInfo"
                                          ng-init="data.PersonalInfo = '<?php echo $userData['userProfile']['personal_info'] ?>'"
                                          placeholder="Bio"></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="col-lg-12 control-label">Facebook Profile</label>
                    <div class="col-lg-12">
                        <input class="form-control" ng-model="data.FullName"
                               ng-init="data.FullName = '<?php echo $userData['name'] ?>'"
                               placeholder="Full name">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="col-lg-12 control-label">Twitter Profile</label>
                    <div class="col-lg-12">
                        <input class="form-control" ng-model="data.FullName"
                               ng-init="data.FullName = '<?php echo $userData['name'] ?>'"
                               placeholder="Full name">
                    </div>
                </div>

            </form>
        </div>
    </section>

    <section class="login-details col-xs-12">
        <h4>Login Details</h4>

        <div class="form-group col-xs-6">
            <label class="col-lg-12 control-label">Email</label>
            <div class="col-lg-12">
                <input class="form-control" ng-model="data.Email" ng-readonly="true"
                       ng-init="data.Email = '<?php echo $userData['email'] ?>'" placeholder="Email"/>

            </div>
        </div>
        <div class="form-group  col-xs-6">
            <label class="col-lg-12 control-label">Current password</label>
            <div class="col-lg-12">
                <input class="form-control" type="password" ng-model="data.Password"
                       placeholder="New password">

            </div>
        </div>
        <div class="form-group  col-xs-6">
            <label class="col-lg-12 control-label">New password</label>
            <div class="col-lg-12">
                <input class="form-control" type="password" ng-model="data.Password"
                       placeholder="New password">

            </div>
        </div>
        <div class="form-group  col-xs-6">
            <label class="col-lg-12 control-label">Recovery email</label>
            <div class="col-lg-12">
                <input class="form-control" type="password" ng-model="data.RecoveryEmail"
                       placeholder="New password">

            </div>
        </div>
        <div class="form-group  col-xs-12">
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
    </section>

    <section ng-hide="onlyImage" class="location-details col-xs-12">
        <div class="first-form">
            <h4>Location</h4>
                <form class="form-horizontal">
                    <div class="form-group col-lg-12">
                        <label class="col-lg-12 control-label">Street</label>
                        <div class="col-lg-12">

                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>

                        </div>
                    </div>

                    <div class="form-group col-xs-6">
                        <label class="col-lg-12 control-label">Apartment</label>
                        <div class="col-lg-12">

                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>
                        </div>
                    </div>

                    <div class="form-group  col-xs-6">
                        <label class="col-lg-12 control-label">City</label>
                        <div class="col-lg-12">

                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-xs-4">
                        <label class="col-lg-12 control-label">Country</label>
                        <div class="col-lg-12">
                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>

                        </div>
                    </div>

                    <div class="form-group  col-xs-4">
                        <label class="col-lg-12 control-label">State</label>
                        <div class="col-lg-12">
                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>

                        </div>
                    </div>

                    <div class="form-group  col-xs-4">
                        <label class="col-lg-12 control-label">Zip</label>
                        <div class="col-lg-12">
                                <textarea class="form-control" ng-model="data.Address"
                                          ng-init="data.Address = '<?php echo $userData['userProfile']['address']  ?>'"
                                          placeholder="Address"></textarea>

                        </div>
                    </div>

                    <div class="form-group text-center col-xs-12">
                        <!--  <button class="btn btn-nevermind">Nevermind</button> -->
                        <button class="btn btn-save" ng-click="updateUser(data,mediaLink)">Nevermind</button>
                        <button class="btn btn-success" ng-click="updateUser(data,mediaLink)">Save</button>
                    </div>
                </form>
                <div class="clearfix"></div>
        </div>
    </section>
    <section class="second-form notification-settings col-xs-10 center-block">
        <form class="form-horizontal col-xs-12">
            <h4>Location</h4>
            <div ng-init="getProfileSettings('<?php echo $userData['id']  ?>')">
                <label>Notify me about</label>
                <div class="content">
                    <div class="form-group checkbox-form-group col-xs-6">
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

                    <div class="form-group checkbox-form-group col-xs-6">
                        <div class="pull-left">
                            Receive Weekly Newsletters <br/> from Ideaing on newest offers
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

                    <div class="form-group checkbox-form-group col-xs-4">
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
                    <div class="form-group checkbox-form-group col-xs-4">
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
                    <div class="form-group checkbox-form-group col-xs-4">
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
                    </div>
                </div>
                <div class="form-group col-xs-12">
                    <label>Subscription</label>

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
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="third-form pale-grey-bg">
        <div class="custom-container ">
            <form class="form-horizontal">
                <div class="col-sm-offset-2 col-sm-8">
                    <button class="btn btn-save" href="Delete My Account">Delete My Profile</button>
                </div>
            </form>
        </div>
    </div>
</script>