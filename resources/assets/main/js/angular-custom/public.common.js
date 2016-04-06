/**
 * Created by sanzeeb on 1/7/2016.
 */

var publicApp = angular.module('publicApp', ['ui.bootstrap', 'ngSanitize', 'angularFileUpload']);

// directive for heart action for grid items
publicApp.directive('heartCounterPublic', ['$http', function($http) {
    return {
        restrict: 'E',
        transclude: true,
        replace: true,
        scope:{
            uid:'=',
            iid:'=',
            plink:'=',
            sec:'=',
        },
        controller:function($scope, $element, $attrs){

            // console.log(window.location.host);
            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;

            $scope.heartCounterAction = function(){


                $http({
                    url: '/api/heart/count-heart',
                    method: "POST",
                    data:{
                        section: $attrs.sec,
                        uid: $scope.uid,
                        iid: $scope.iid,
                        plink: $scope.cleanUrl($attrs.plink),
                    }
                }).success(function (data) {
                    $attrs.ustatus = data.UserStatus;

                    $scope.unHeart = data.UserStatus;
                    $scope.heartCounter = data.Count;

                });
            };

            // clean url for ideaing URL (take only permalink)
            $scope.cleanUrl = function(urlString){
                //console.log('url : '+ urlString);
                return urlString;
            };

            $scope.heartAction = function(){

                // an anonymous will be returned without performing any action.
                if($attrs.uid==0)
                    return;

                $http({
                    url: '/api/heart/add-heart',
                    method: "POST",
                    data:{
                        section: $attrs.sec,
                        uid: $scope.uid,
                        iid: $scope.iid,
                        plink: $scope.cleanUrl($attrs.plink),
                        uht: $scope.unHeart
                    }
                }).success(function (data) {
                    $scope.heartCounterAction();
                    $scope.unHeart = ! $scope.unHeart;
                });
            };

            $scope.heartCounterAction();

        },

        template: '      <div class="">'+
        '                    <a class="likes"'+
        '                       ng-click="heartAction()"'+
        '                    >'+
        '                        <i ng-class="unHeart != false ? \'m-icon m-icon--heart-solid\' : \'m-icon m-icon--ScrollingHeaderHeart\'">'+
        '                                <span class="m-hover">'+
        '                                    <span class="path1"></span><span class="path2"></span>'+
        '                                </span>'+
        '                        </i>'+
        '                        <span class="social-stats__text" ng-bind="heartCounter">&nbsp; </span>'+
        '                    </a>'+
        '                </div>'


    }
}]);

// directive for pulling author info pulling in grid items
publicApp.directive('showAuthorInfo', ['$http', function($http) {
    return {
        restrict: 'E',
        transclude: true,
        replace: true,
        scope:{
            email:'@',
            url:'@'

        },
        controller:function($scope, $element, $attrs){

            $scope.authorInfo = function(){

                $http({
                    url: '/api/info-raw/'+ $scope.email,
                    method: "GET",
                }).success(function (data) {

                    $scope.authorName = data.name;
                    $scope.authorImage = data.medias[0].media_link;
                    $scope.authorBio = data.user_profile.personal_info;

                    // console.log($scope.authorName," - ",$scope.authorImage);

                });
            };

            $scope.authorInfo();

        },

        template: '      <div class="box-item__author">'+
        '                    <a href="{{ url }}" class="user-widget">'+
        '                       <img class="user-widget__img" src="{{ authorImage }}">'+
        '                     <span class="user-widget__name">{{ authorName }}</span>'+
        '                    </a>'+
        '                </div>'
    }

}]);


publicApp.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

// custom directive //
publicApp.factory('layoutApi', function ($http) {

        var layoutApi = {};

        layoutApi.getProductsForShopMenu = function () {
            return $http({
                method: 'GET',
                url: '/api/layout/get-shop-menu',
            });
        };


        return layoutApi;
    })
    .directive('a', function () {
        return {
            restrict: 'E',
            link: function (scope, elem, attrs) {
                if (attrs.ngClick || attrs.href === '' || attrs.href === '#') {
                    elem.on('click', function (e) {
                        e.preventDefault();
                    });
                }
            }
        };
    });
// //


publicApp.controller('ProductModalInstanceCtrl', function ($scope, $uibModalInstance, pagingApi, productData) {
    $scope.data = productData.data;

    $scope.ok = function () {
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.openSharingModal = function ($service) {
        pagingApi.openSharingModal($service);
    };
});
publicApp.controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance, pagingApi) {
    $scope.ok = function () {
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.openSharingModal = function ($service) {
        pagingApi.openSharingModal($service);
    };

});

publicApp.controller('publicController', ['$rootScope', '$scope', '$http', '$window', '$timeout', '$location', '$anchorScroll', '$uibModal', 'layoutApi', '$compile','$interval', 'FileUploader', 'pagingApi'
    , function ($rootScope, $scope, $http, $window, $timeout, $location, $anchorScroll, $uibModal, layoutApi, $compile, $interval ,FileUploader, pagingApi) {

        // text area internal function for comment
        $scope.focusEditor = function(){
            $timeout(function(){
                angular.element('div[contenteditable=true]').trigger('focus');
            })
        }
        $scope.insertCustomImagePopup = function(){
            alert("Please add the code for photo uploading here");
        }
        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        };
        $scope.textAreaSetup = function($element){
            $element.attr('focus-me', 'focus_editor');
        };


        // update comment in the comment view through AJAX call.
        var commnetTimer = $interval(function(){
            //  console.log("in");
            if($scope.uid != null)
            {
                $scope.loadNotification($scope.uid);
            }

            if($scope.itemId != 0)
            {
                $scope.getCommentsForIdeas($scope.itemId);
            }
        },15000);//10000


        // Header profile option open and close on click action.
        if (!$rootScope.isCallEmailPopup) {
            $timeout(function () {
                if ($scope.canOpenEmailPopup) {
                    var templateUrl = "subscribe_email_popup.html";
                    var modalInstance = $uibModal.open({
                            templateUrl: templateUrl,
                            scope: $scope,
                            size: 'md',
                            windowClass: 'subscribe_email_popup',
                            controller: 'ModalInstanceCtrltest'
                        })
                        .result.finally(function () {
                                $scope.uploader.formData = [];
                            })
                        ;
                }
            }, 300000)  //300000
        }
        $rootScope.isCallEmailPopup = true;

        $scope.openProfileSetting = function () {

            var templateUrl = "profile-setting.html";
            var modalInstance = $uibModal.open({
                    templateUrl: templateUrl,
                    scope: $scope,
                    size: 'lg',
                    windowClass: 'profile-setting-modal',
                    controller: 'ModalInstanceCtrltest'
                })
                .result.finally(function () {
                        $scope.uploader.formData = [];
                    })
                ;

        };

        $scope.openSharingModal = function ($service) {
            pagingApi.openSharingModal($service, $scope)
            /*
            var baseUrl = 'https://' + window.location.host + window.location.pathname;
            var shareUrl = false;

            var $pitnerestShare = function(){
                    var e=document.createElement('script');
                    e.setAttribute('type','text/javascript');
                    e.setAttribute('charset','UTF-8');
                    e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
                    document.body.appendChild(e);

                setTimeout(function(){
                    $scope.fakeUpdateCounts('pinterest');
                }, 10000);
            }

            switch($service){
                case 'facebook':
                    shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + baseUrl;
                    break;
                case 'twitter':
                    shareUrl = 'https://twitter.com/share?url=' + baseUrl + '&counturl=' + baseUrl + '&text=@Ideaing';
                    break;
                case 'googleplus':
                    shareUrl = 'https://plus.google.com/share?url=' + baseUrl;
                    break;
                case 'pinterest':
                    $pitnerestShare();
                    return true
            }

            if(!shareUrl){
                return false;
            }

            //$scope.openWindow = function() {
            var $modal = $window.open(shareUrl, 'C-Sharpcorner', 'width=500,height=400');
            //};

            // TODO -- fire counter updates for shares, only on pages where they are used (CMS)

            var timer = setInterval(function() {
                if($modal.closed) {
                    clearInterval(timer);

                    setTimeout(function(){
                        $scope.fakeUpdateCounts($service);
                    }, 2000);
                    //setTimeout(function(){
                    //    $scope.countSocialShares();
                    //}, 1000);
                    console.log('share counters updated')
                }
            }, 1000);
*/
        };

        // load shop information.
        layoutApi.getProductsForShopMenu().success(function (response) {
            $scope.productsForShopMenu = response;
        });


        // uploader section //

        uploader = $scope.uploader = new FileUploader({
            //  var uploader = new FileUploader({
            url: '/api/media/media-upload',
        });

        // FILTERS

        uploader.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });

        // Content upload CALLBACKS

        uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            //  console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function (fileItem) {
            //   console.info('onAfterAddingFile', fileItem);
            // console.log($scope.isProfilePage);
            // if the page is profile update then this auto upload will work on profile image select
            if ($scope.isProfilePage) {
                $scope.oldMediaLink = $scope.mediaLink;
                $scope.showBrowseButton = !$scope.showBrowseButton;
                $scope.uploader.uploadAll();

                console.log($scope.oldMediaLink, ' : ', $scope.MediaLink);

            }
        };
        uploader.onAfterAddingAll = function (addedFileItems) {
            //   console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function (item) {
            //   console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function (fileItem, progress) {
            //    console.info('onProgressItem');
            $scope.initProfilePicture('/assets/images/ajax-loader.gif');
        };
        uploader.onProgressAll = function (progress) {
            //   console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            //     console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function (fileItem, response, status, headers) {
            //   console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function (fileItem, response, status, headers) {
            //   console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function (fileItem, response, status, headers) {
            //     console.info('onCompleteItem', response);
            $scope.mediaLink = response.result;
        };
        uploader.onCompleteAll = function () {
            //    console.info('onCompleteAll');
        };
        // End uploader section //



        // initialize variables
        $scope.initPage = function () {

            // $scope.TEST = "TSSSSST";
            // console.log($scope.TEST);

            // email subscription
            $scope.SubscriberEmail = '';
            $scope.responseMessage = '';

            $scope.alerts = [];
            $scope.alertHTML = '';
            $scope.Code = '';

            $scope.logingRedirectLocation = '/';

            // Media Upload //
            $scope.mediaTitle = '';
            $scope.mediaTypes = [
                {"key": "img-link", "value": "Image Link"},
                {"key": "img-upload", "value": "Image Upload"},
                {"key": "video-link", "value": "Video Link"},
                {"key": "video-upload", "value": "Video Upload"}
            ];
            $scope.mediaLink = "";
            $scope.isMediaUploadable = true;


            $scope.FullName = '';

            $scope.Email = '';
            $scope.Password = '';
            $scope.PersonalInfo = '';
            $scope.Address = '';
            $scope.Permalink = '';

            //settings for user profile edit section
            $scope.isProfilePage = false;
            $scope.uploader.formData = [];
            $scope.showBrowseButton = true;

            // popup signup
            $scope.popupSignup = true;

            // notification
            $scope.notificationCounter = 0;
            $scope.notifications = [];
            $scope.uid = null;

            // comment ideas
            $scope.itemId = 0;
            $scope.userId = 0;
            $scope.isAdmin = false;
            $scope.commentId = null;
            $scope.commentsCount = 0;

            //Ideas author info
            $scope.authorName = '';
            $scope.authorImage = null;

            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;
            $scope.heartUsersInfo = [];


            //$scope.countSocialShares();
            //$scope.countSocialFollowers();

            $scope.socialCounter = function(){
              //  console.log("before call");
                $scope.countSocialShares();
                $scope.countSocialFollowers();
               // console.log("call");
            };
        };

        // Heart //

        $scope.heartAction = function(){

          //  console.log($window.plink,$window.uid,$window.itemId);
            //return;
            userId = $window.uid;
            ItemId = $window.itemId;
            permalink = $window.plink;
            section = 'ideas';

            // an anonymous will be returned without performing any action.
            if(userId==0)
                return;

            $http({
                url: '/api/heart/add-heart',
                method: "POST",
                data:{
                    uid: userId,
                    iid: ItemId,
                    plink: permalink,
                    section: section,
                    uht: $scope.unHeart
                }
            }).success(function (data) {
                $scope.heartCounterAction();
                $scope.unHeart = ! $scope.unHeart;
            });
        };

        $scope.heartCounterAction = function(){

            userId = $window.uid;
            ItemId = $window.itemId;
            section = 'ideas';

            $http({
                url: '/api/heart/count-heart',
                method: "POST",
                data:{
                    uid: userId,
                    iid: ItemId,
                    section: section
                }
            }).success(function (data) {
                $scope.unHeart = data.UserStatus;
                $scope.heartCounter = data.Count;

             //   console.log($scope.heartCounter);
            });

        };

        // get recently liked users list
        $scope.heartUsers = function(section){
            ItemId = $window.itemId;

            $http({
                url: '/api/heart/heart-users',
                method: "POST",
                data:{
                    iid: ItemId,
                    section: section
                }

            }).success(function (data) {
                $scope.heartUsersInfo = data;
            });
        };

        // Add an Alert in a web application
        $scope.addAlert = function (alertType, message) {
            //$scope.alertType = alertType;
            $scope.alertHTML = message;
            $scope.alerts.push({type: alertType});

        };

        $scope.closeAlert = function (index) {
            $scope.alerts.splice(index, 1);

        };

        // Build HTML listed response for popup notification.
        $scope.buildErrorMessage = function (errorObj) {

            var alertHTML = '';
            alertHTML = '<ul>';
            angular.forEach(errorObj, function (value, key) {

                alertHTML += '<li>' + value + '</li>';
            });
            alertHTML += '</ul>';

            return alertHTML;
        };


        // Build popup notification box based on status.
        $scope.outputStatus = function (data, message) {

            var statusCode = data.status_code;
            //  console.log('status code:'+statusCode);
            switch (statusCode) {
                case 400:
                {
                    if (data.data.error.message[0] == "Validation failed") {
                        // $scope.requiredFields = buildErrorMessage(data.data.error.message[1]);
                        $scope.addAlert('danger', $scope.buildErrorMessage(data.data.error.message[1]));
                    }
                }
                    break;
                case 401:
                {
                    $scope.addAlert('danger', data.data.error.message);

                }
                    break;
                case 200:
                {
                    $scope.addAlert('success', message);
                    if (message == 'Successfully password reset') {
                        window.location = '/login';
                    }
                    else if (data.data == 'Registration completed successfully') {
                        //  console.log("credentials : " + $scope.Email + " " + $scope.Password);

                        $scope.loginUser();
                    } else if (data.data == 'Registration completed successfully,please verify email') {
                        //  console.log("credentials : " + $scope.Email + " " + $scope.Password);

                        $scope.loginUser();
                    }


                }
                    break;
                case 210:
                {
                    $scope.addAlert('', message);
                }
                    break;
                case 220:
                {
                    if (data.data.message == 'Successfully authenticated.') {
                        $scope.redirectUser(data.data.roles);

                    } else {
                        $scope.addAlert('success', data.data.message);
                    }

                }
                    break;
                case 410:
                {
                    $scope.addAlert('danger', data.data.error.message);
                }
                    break;
                case 500:
                {
                    $scope.addAlert('danger', data.data.error.message);
                }
                    break;
                default:
                {
                    $scope.addAlert('danger', 'Request failed !');
                }
            }
        };

        // redirect a user after login as per role.
        $scope.redirectUser = function (role) {
            switch (role[0]) {
                case 'admin':
                    window.location = '/admin/dashboard';
                    break;
                case 'editor':
                    window.location = '/admin/dashboard';
                    break;
                case 'user':
                    window.location = '/user/profile';

                    break;

            }
        };

        $scope.getAuthorInfoByEmail = function(email){
            //console.log("inside");
            $http({
                url: '/api/info-raw/'+ email,
                method: "GET",
            }).success(function (data) {

                $scope.authorName = data.name;
                $scope.authorImage = data.medias[0].media_link;
                $scope.authorBio = data.user_profile.personal_info;

               // console.log($scope.authorName," - ",$scope.authorImage);

            });
        };

        // Comment for ideas section
        $scope.addCommentForIdeas = function(userId,itemId,permalink,comment){
            console.log(userId,itemId,permalink,comment);

            $http({
                url: '/api/comment/add-ideas-comment',
                method: "POST",
                data:{
                    uid: userId,
                    pid: itemId,
                    plink: permalink,
                    comment: comment
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.getCommentsForIdeas($scope.itemId);
            });
        };

        $scope.getCommentsForIdeas = function(pid){

            $http({
                url: '/api/comment/get-ideas-comment/'+pid,
                method: "GET"
            }).success(function (data) {
                $scope.itemId = pid;
                $scope.comments = data.data;
                $scope.commentsCount = $scope.comments.length;
                $scope.commentsCountView = $scope.commentsCount < 2? $scope.commentsCount +" "+"Comment" : $scope.commentsCount +" "+"Comments";

                //  console.log($scope.commentsCount);

            });

        };

        $scope.initCommentCounter =function(){
          //  $scope.getCommentsForIdeas($window.itemId);
        };


        $scope.editComment = function(comment){
            //  console.log(comment);

            $scope.isEdit = true;

            $scope.commentId = comment.CommentId;

            $scope.html = comment.Comment;


        };

        $scope.updateComment = function(comment){
            $http({
                url: '/api/comment/update-comment',
                method: "POST",
                data:{
                    cid: $scope.commentId,
                    comment: $scope.html
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.isEdit = false;
                // console.log("pid :"+ $scope.productId);
                $scope.getCommentsForIdeas($scope.itemId);
            });

        };


        $scope.deleteComment = function(id){
            $http({
                url: '/api/comment/delete-comment',
                method: "POST",
                data:{
                    cid: id
                }
            }).success(function (data) {
                $scope.getCommentsForIdeas($scope.itemId);
            });

        };

        // Subscribe a user through email and redirect to registration page.
        $scope.subscribe = function (formData) {

            $scope.responseMessage = '';
            if ((typeof formData.SubscriberEmail != 'undefined')) //|| (formData.SubscriberEmail != '')
            {
                //  console.log('in side :'+ formData.SubscriberEmail);
                $scope.SubscriberEmail = formData.SubscriberEmail;
            }

            //console.log('out side :'+ $scope.SubscriberEmail);

            $http({
                url: '/api/subscribe',
                method: "POST",
                data: {
                    'Email': $scope.SubscriberEmail,
                    'SetCookie': 'true'
                }
            }).success(function (data) {

                if (data.status_code == 406) {

                    $scope.responseMessage = "Invalid Email !";
                }

                else if (data.status_code == 200) {
                    $scope.responseMessage = "Successfully Subscribed";

                    //Redirect a user to registration page.
                    window.location = '/signup/' + $scope.SubscriberEmail;

                } else {
                    $scope.responseMessage = "Email already subscribed";
                }

            });

        };

        $scope.registerSubscribedUser = function () {
            $scope.closeAlert();

            if ($scope.Password != $scope.PasswordConf) {
                $scope.addAlert('danger', 'Password not match !');
                return;
            }

            $http({
                url: '/api/register-user',
                method: "POST",
                data: {
                    FullName: $scope.FullName,
                    Email: $scope.Email,
                    Password: $scope.Password,
                    Valid: true
                }

            }).success(function (data) {
                $scope.outputStatus(data, data.data);
                // window.location = '/login';

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });

        };

        $scope.registerUser = function (email) {
            $scope.closeAlert();

            if ($scope.Password != $scope.PasswordConf) {
                $scope.addAlert('danger', 'Password not match !');
                return;
            }

            $http({
                url: '/api/register-user',
                method: "POST",
                data: {
                    FullName: $scope.FullName,
                    Email: $scope.Email,
                    Password: $scope.Password,
                    Valid: false
                }

            }).success(function (data) {
                $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });

        };


        $scope.registerWithFB = function () {

            window.location = '/api/fb-login';
        };

        $scope.loginUser = function () {
            $scope.closeAlert();

            $http({
                url: '/api/authenticate',
                method: "POST",
                data: {
                    Email: $scope.Email,
                    Password: $scope.Password,
                    RememberMe: $scope.rememberMe == true ? true : false
                }
            }).success(function (data) {
                //   console.log(data.data);
              
                var WpLoginURL = 'https://ideaing.com/ideas/api?call=login&username=' + $scope.Email + '&password=' +  $scope.Password + '&remember=' + $scope.rememberMe;

                $http({
                    url: WpLoginURL, 
                    method: "GET"
     
                }).success(function (data) {
                    var from = $location.search().from; // TODO -- disable this
                    if(from === 'cms'){
                        window.location = 'https://ideaing.com/ideas/wp-admin';
                    }
                }).error(function(data, status, headers, config) {
                    if(data.success){
                        var from = $location.search().from; // TODO -- disable this
                        if(from === 'cms'){
                            window.location = 'https://ideaing.com/ideas/wp-admin';
                        }
                    }
                });
                $scope.outputStatus(data, data.data);
                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */

            });
        };


        $scope.logoutUser = function () {
          //  var WpLogoutURL = 'https://ideaing.com/ideas/api?call=logout';
            var WpLogoutURL = '/ideas/api?call=logout';


            $http({
                url: WpLogoutURL,
                method: "GET"

            }).success(function (data) {
                window.location = '/api/logout';
            }).error(function(data) {
                window.location = '/api/logout';
            });
        }

        $scope.passwordResetRequest = function () {
            $scope.closeAlert();
            if(!$scope.Email){
                $scope.addAlert('danger', 'Email is required!');
                return;
            }
            $http({
                url: '/password-reset-request/' + $scope.Email,
                method: "GET",
            }).success(function (data) {
                //console.log(data.data);

                $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });
        };

        $scope.passwordReset = function () {
            $scope.closeAlert();

            if ($scope.Password != $scope.PasswordConf) {
                $scope.addAlert('danger', 'Password not match !');
                return;
            }

            $http({
                url: '/api/password-reset',
                method: "POST",
                data: {
                    Password: $scope.Password,
                    Code: $scope.Code
                }
            }).success(function (data) {
                //console.log(data.data);

                $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });
        };

        //update user information
        $scope.updateUser = function (formData, meidaLink) {
            $scope.closeAlert();
            //console.log("address :"+ tmp.FullName);

            $http({
                url: '/api/change-profile',
                method: "POST",
                data: {
                    FullName: formData.FullName,
                    Email: formData.Email,
                    Password: formData.Password,
                    PersonalInfo: formData.PersonalInfo,
                    Address: formData.Address,
                    Permalink: formData.Permalink,
                    MediaLink: meidaLink

                }
            }).success(function (data) {
                // console.log(data);
                $scope.outputStatus(data, 'User information updated successfully');
                location.reload();

                // $scope.Password = '';
                //    $window.location = '/admin/user-list';
            });
        };


        // Profile picture upload and edit section //

        // init page //

        $scope.initProfilePage = function () {
            $scope.isProfilePage = true;
            $scope.uploader.formData.push({
                'isProfilePage': 1
            });
        };

        $scope.initProfilePicture = function (link) {
            $scope.mediaLink = link;
        };

        //update only profile picture information
        $scope.updateProfilePicture = function (formData, meidaLink) {
            $scope.closeAlert();
            $http({
                url: '/api/change-profile',
                method: "POST",
                data: {
                    FullName: formData.FullName,
                    Email: formData.Email,
                    MediaLink: meidaLink
                }
            }).success(function (data) {
                // console.log(data);
                $scope.outputStatus(data, 'Profile picture updated successfully');
                $scope.showBrowseButton = !$scope.showBrowseButton;

            });
        };

        $scope.cancelPictureUpdate = function () {
            $scope.mediaLink = $scope.oldMediaLink;
            $scope.showBrowseButton = !$scope.showBrowseButton;

        };

        //notification
        $scope.loadNotification = function(uid){

            $scope.uid = uid;
            $http({
                url: '/api/notification/' + uid,
                method: "GET",
            }).success(function (data) {

                $scope.notificationCounter = data.data.NotReadNoticeCount;
                $scope.notifications = data.data.NoticeNotRead;

            });
        };

        $scope.readAllNotification = function(){

           // $scope.uid = uid;
            $http({
                url: '/api/read-all-notification/' + $scope.uid,
                method: "GET",
            }).success(function (data) {

                $scope.loadNotification($scope.uid);
            //    $scope.notificationCounter = data.data.NotReadNoticeCount;
            //    $scope.notifications = data.data.NoticeNotRead;

            });
        };




        // test function //
        $scope.chk = function () {
            $scope.closeAlert();
            $http({
                url: '/secure-page-header',
                method: "GET",

            }).success(function (data) {
                // $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });
        };

        $scope.countSocialShares = function(){

            var thisUrl = window.location.host + window.location.pathname;

            $http({
                url: '/api/social/get-social-counts',
                method: "GET",
                params: {'url' : thisUrl}
            }).success(function (response) {
                $('.share-count.all').html(response.all);
                $('.share-count.twi').html(response.twitter);
                $('.share-count.fb').html(response.facebook);
                $('.share-count.gp').html(response.gplus);
                $('.share-count.pint').html(response.pinterest);
                $('.share-count.inst').html(response.instagram);
            });
        }
        $scope.countSocialFollowers = function(){

            var thisUrl = window.location.host + window.location.pathname;

            $http({
                url: '/api/social/get-fan-counts',
                method: "GET",
                params: {'url' : thisUrl}
            }).success(function (response) {
                $('.fan-count.twi').html(response.twitter);
                $('.fan-count.fb').html(response.facebook);
                $('.fan-count.gp').html(response.gplus);
                $('.fan-count.pint').html(response.pinterest);
                $('.fan-count.inst').html(response.instagram);
            });
        };


        $scope.initPage();

    }]);

