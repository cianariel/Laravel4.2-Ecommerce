(function ($, root, undefined) {

	$(function () {


// For the simple custom JS functions

        $('body').on('click', '[data-toggle]', function(e){
            e.preventDefault();
            var $that = $(this);
            var $show = $that.data('toggle');
            var $hide = $that.data('hide');
            var $overlay = $that.data('overlay');

            if($hide){
                $($hide).hide();
                $that.siblings().removeClass('active');
            }

            if($overlay){
                $('.page-overlay').fadeToggle();
            }

            $($show).fadeToggle();
            $that.toggleClass('active');
        });

        $('.page-overlay, .login-signup-modal').click(function(event){
            if(event.target !== this){ // only fire if the block itself is clicked, not it's children (sometimes we need to hide the modal when anything outside it's main block is clickced
                return;
            }

            $('.modal, .page-overlay').fadeOut();

            var $hide = $('[data-overlay="true"]').data('toggle');

            if($hide){
                $($hide).hide();
            }
        });

        $('body').on('mouseover', '.rsContent .hero-tags .tag', function(){
            var extraHeroTagsHTML = "<div class='hero-tags extra'></div>";
            if(!$('#hero .hero-tags.extra').length){
                $('#hero .rsOverflow').append(extraHeroTagsHTML);
            }
            $("#hero .rsOverflow .hero-tags.extra ").html($(this)[0].outerHTML);
            $("#hero .rsOverflow .hero-tags.extra a, #hero .rsOverflow .hero-tags.extra .hover-box").show();
        })
        $('body').on('mouseleave', '.hero-tags.extra .tag', function(){
            $("#hero .rsOverflow .hero-tags.extra a, #hero .rsOverflow .hero-tags.extra .hover-box").hide();
        })





        $("#back-to-top").click(function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false;
        });

        $('[data-scrollto]').click(function() {
            var $scrollNode = $(this).data('scrollto');
            var $scrollTo   = $($scrollNode);
            var $offset     = $scrollTo.offset().top - 70;

            $('html, body').animate({ scrollTop: $offset }, 'slow');
            return false;
        });

        $("li.nested").click(function() {
            $(this).find('ul').fadeToggle();
        });




        $('[data-toggle="modal"]').click(function() {
            var $modal = $(this).data('target');
            $($modal).fadeToggle();
            $('.page-overlay').fadeToggle();
            if($($modal).hasClass('login-signup-modal')){
                $('.picture-overlay').show();
            }
        });

        $('[data-dismiss="modal"]').click(function() {
           var $modal = $(this).parents('.modal');
            $modal.fadeOut();
            $('.page-overlay').fadeOut();
            return true;
        });

        $('.desktop-view .shop-by-category-item a.show-menus, .desktop-view .shop-by-category-item a.hide-menus').click(function(e){
            e.preventDefault();
            $('.shop-by-category-item').removeClass('active');
            $('.shop-by-category-submneu').removeClass('active');
            
            if($(this).hasClass('show-menus')){
                $(this).parent().addClass('active');
                var submenu = $(this).parent().data('submenu');
                $('.shop-by-category-submneu.' + submenu).addClass('active');
            }
        })
        $('.desktop-view .shop-by-category-item').mouseover(function(e){
            $('.shop-by-category-item').removeClass('active');
            $('.shop-by-category-submneu').removeClass('active');
            
//            if($(this).find('a').hasClass('show-menus')){
                $(this).addClass('active');
                var submenu = $(this).data('submenu');
                $('.shop-by-category-submneu.' + submenu).addClass('active');
//            }
        });
        
        $('.show-and-hide-grandchild').click(function(){
            if($(this).parent().hasClass('active')){
                $(".shop-by-category-submneu > div").removeClass('active');
            }else{
                $(".shop-by-category-submneu > div").removeClass('active');
                $(this).parent().addClass('active');
            }
        })
        
        
        $('#mobile-shop-by-category-items').change(function(){
            $('.shop-by-category-submneu').removeClass('active');
            var submenu = $(this).val();
            $('.shop-by-category-submneu.' + submenu).addClass('active');
        })

        $('.notification-holder').click(function(){
            if($('.notification-popup').is(":visible")){
                $('.notification-popup').hide();
            }else{
                $('.notification-popup').show();
            }
        })

        $('#top-nav .profile-photo').click(function(){
            if($('.profilelinks-popup').is(":visible")){
                $('.profilelinks-popup').hide();
            }else{
                $('.profilelinks-popup').show();
            }
        })
        $("#top-nav .profilelinks-popup a").click(function(){
            $('.profilelinks-popup').hide();
        })

        $(".show-hero-category").click(function(e){
            e.preventDefault();
            if($(".hideen-hero-category-menu").is(":visible")){
                $(".hideen-hero-category-menu").hide();
            }else{
                $(".hideen-hero-category-menu").show();
            }
        })
        
        $(".hideen-hero-category-menu a").click(function(){
            $(".hideen-hero-category-menu").hide();
        })

        $("body").on('click', '.mobile-show', function(){
            if($(this).find('.p-show').is(":visible")){
                $(this).parent().addClass('hover');
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(this).parent().removeClass('un-hover');
                }                
                
                $(this).find('.p-show').hide();
                $(this).find('.p-close').show();
            }else{
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $(this).parent().addClass('un-hover');
                }                
                $(this).parent().removeClass('hover');
                $(this).find('.p-show').show();
                $(this).find('.p-close').hide();
            }
        })

        $("body").on('click', '.show-and-hide', function(){
            if($(this).parent().hasClass('active')){
                $('.shop-by-category-item').removeClass('active');
            }else{
                $('.shop-by-category-item').removeClass('active');
                $(this).parent().addClass('active');
            }
        })

        // scroll and stick the share bar
        function sticky_relocate() {
            if(window.innerWidth < 620){
                return false;
            }

            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor').offset().top;
            if (window_top > div_top) {
                $('.sticks-on-scroll').addClass('stick');
            } else {
                $('.sticks-on-scroll').removeClass('stick');
            }
        }

        $(function () {
            if($('#sticky-anchor').length){
                $(window).scroll(sticky_relocate);
                sticky_relocate();
            }
        });

        // Sticking headers
        $(function () {
            $(window).scroll(function(){
                if($('.scroll-header').length){
                    if($(window).scrollTop() < 60){
                        $('header.colophon').removeClass('scroll-header');
                    }
                }else if(($(window).scrollTop() > 60)){
                    $('header.colophon').addClass('scroll-header');
                }

            });
        });

        $(function () {
            if(window.innerWidth < 620){
                return false;
            }
            var $showMe = $('.story-header');
            if($showMe.length){
                $(window).scroll(function(){
                    var window_top = $(window).scrollTop();
                    var div_top = $('#hero-nav').offset().top;
                    var $main_header = $('#top-nav');

                    if (window_top > div_top) {
                        $showMe.fadeIn();
                        $main_header.fadeOut();
                    } else {
                        $showMe.fadeOut();
                        $main_header.fadeIn();

                    }
                });
            }
        });

        $('#about-button').click(function(){
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        });

        //$('.main-content-filter a').click(function(event){
        //    event.preventDefault();
        //    var $contentBox = $('.main-content');
        //    var $type = $(this).data('filterby');
        //
        //    $contentBox.attr('data-only', $type);
        //    //
        //    //$contentBox.removeClass('only-*');
        //    //$contentBox.addClass('only-' + $type);
        //});


	}); // global function()

})(jQuery, this);

//(function() {
//
//    'use strict';
//
//    var loadMore = angular.module('loadMore', [])
//
//    angular
//        .module('loadMore')
//        .factory('content', content);
//
//    content();
//
//    function content($resource) {
//
//        // ngResource call to the API for the users
//        var Content = $resource('paging/get-content');
//
//        // Query the users and return the results
//        function getContent() {
//            return Content.query().$promise.then(function(results) {
//                return results;
//                console.log(results)
//            }, function(error) {
//                console.log(error);
//            });
//        }
//
//        return {
//            getUsers: getContent
//        }
//    }
//})();
;
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

;

angular.module('pagingApp', [
    'pagingApp.controllers',
    //'pagingApp.services',
    'pagingApp.filters',
    'cgBusy'
]);

angular.module('pagingApp.controllers', [ 'ui.bootstrap'])

    // directive for heart action for grid items
    .directive('heartCounterDir', ['$http', function($http) {
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
                            plink: $scope.plink,
                        }
                    }).success(function (data) {
                        $attrs.ustatus = data.UserStatus;

                        $scope.unHeart = data.UserStatus;
                        $scope.heartCounter = data.Count;

                    });
                };

                // clean url for ideaing URL (take only permalink)
                $scope.cleanUrl = function(url){
                    var domainBuilder = "https://"+window.location.host+"/ideas/";
                    return url.replace(domainBuilder,'');
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
                            plink: $scope.cleanUrl($scope.plink),
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
            '                    <a href="#" class="likes"'+
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
    }])

    .controller('pagingController', function($scope, $timeout, $uibModal, $http, pagingApi, $filter) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];
        $scope.ideaCategory = false;
        //$scope.globalOffset = 0;

        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        var $route =  $filter('getURISegment')(2);
        var $limit = 0;

        if($route == 'idea'){
            $scope.currentTag = $filter('getURISegment')(3);
        }else if($route == 'ideas'){
            $scope.filterBy = 'idea';
            if($filter('getURISegment')(3) == 'category'){
                $scope.ideaCategory = $filter('getURISegment')(4);
            }else{
                $scope.ideaCategory = $filter('getURISegment')(3);
            }
            var $limit = 9;
        }

        $scope.firstLoad = pagingApi.getGridContent(1, $limit, $scope.currentTag, $scope.filterBy,  $scope.ideaCategory).success(function (response) {
            $scope.allContent[0] = response;
            $scope.content[0] = $scope.sliceToRows(response['regular'], response['featured']);
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            $scope.allContent[$scope.currentPage] = [];

            if(!$scope.filterBy || typeof $scope.filterBy === 'undefined'){
                var $limit = 0;
                $scope.filterBy = null;
            }else{
                var $limit = 9;
            }

            $scope.nextLoad =  pagingApi.getGridContent($scope.currentPage, $limit, $scope.currentTag, $scope.filterBy, $scope.ideaCategory).success(function (response) {
                $scope.newStuff[0] = $scope.sliceToRows(response['regular'], response['featured']);
                $scope.content = $scope.content.concat($scope.newStuff);

                $scope.allContent[$scope.currentPage]['regular']  = response['regular'];
                $scope.allContent[$scope.currentPage]['featured'] = response['featured'];
            });
        };


        $scope.filterContent = function($criterion){
            $('.main-content').fadeOut(500, function(){
                var $replacer = [];

                if($scope.filterBy === $criterion){
                    return true;

                }else if(typeof $criterion === 'undefined' || $criterion === null || $criterion === 'all'){
                    $scope.nextLoad = pagingApi.getGridContent(1, 0, $scope.currentTag).success(function (response) {
                        $scope.allContent[0] = response;
                        $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
                    });
                    $scope.currentPage = 1;
                    $scope.filterBy = null;

                    $scope.content = $replacer;
                    $('.main-content').fadeIn();

                    return true;

                }

                $scope.filterBy = $criterion;

                $scope.nextLoad = pagingApi.getFilteredContent($scope.currentPage, $scope.currentTag, $criterion, $scope.sliceToRows).then(function(response){
                    var $newStuff       = response;

                    $scope.content = $newStuff;
                    $scope.allContent = $scope.allContent.concat($newStuff);
                    $('.main-content').fadeIn(500);
                });
            });
        };

        $scope.sliceToRows = function($regular, $featured){
            var $return = [];
            $return['row-1'] = $regular.slice(0, 3);
            $return['row-2'] = $featured[0] ? [$featured[0]] : false;
            $return['row-3'] = $regular.slice(3, 6);
            $return['row-4'] = $featured[1] ? [$featured[1]] : false;
            $return['row-5'] = $regular.slice(6, 9);
            $return['row-6'] = $featured[2] ? [$featured[2]] : false;

            return $return;
        };

        $scope.fadeAnimation = function($node, $action, $callback){
            $($node).fadeOut(
                $callback()
            );

        };

        // email subscription //

        $scope.subscribe = function () {

            $scope.responseMessage = '';

            $http({
                url: '/api/subscribe',
                method: "POST",
                data: {
                    'Email': $scope.SubscriberEmail
                }
            }).success(function (data) {

                if (data.status_code == 406) {

                    $scope.responseMessage = "Invalid Email !";
                }

                else if (data.status_code == 200) {
                    $scope.responseMessage = "Successfully Subscribed";
                    $scope.SubscriberEmail = '';

                } else {
                    $scope.responseMessage = "Email already subscribed";
                }
            });

        };

        $scope.open = function (key) {
            var templateUrl = "room-related-product-" + key + ".html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              controller: 'ModalInstanceCtrltest'
            });
        };

        $scope.openProfileSetting = function () {
            var templateUrl = "profile-setting.html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              windowClass : 'profile-setting-modal',
              controller: 'ModalInstanceCtrltest'
            });
        };

        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
            }
            

    })
    .controller('SearchController', function ($scope, $http, $uibModal, pagingApi, $timeout, $filter, $window) {

        //$scope.getContentFromSearch = function() {
            var $route = $filter('getURISegment')(2);
            var $searchQuery = false;
            if ($route == 'search') {
                if ($searchQuery = $filter('getURISegment')(3)) {
                    $scope.$searchQuery = $searchQuery;
                }
            }

            $scope.currentPage = 1;
            $scope.offset = 0;
            $scope.type = 'undefined';
            $scope.sortBy = false;

            $scope.nextLoad = pagingApi.getSearchContent($scope.$searchQuery, 15, 0).success(function (response) {
                $scope.content = response['content'];
                $('#search-header').show();
                $('#hit-count').text(response['count']);
            });

            $scope.loadMore = function() {
                $scope.currentPage++;

                $scope.offset = 15 * $scope.currentPage++;
                $scope.nextLoad =  pagingApi.getSearchContent($scope.$searchQuery, 15,  $scope.offset,  $scope.type,  $scope.sortBy).success(function (response) {
                    var $newStuff = $scope.content.concat(response['content'])

                    if($scope.sortBy){
                        $newStuff.sort(function (a, b) {
                            return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                        });
                    }

                    $scope.content = $newStuff;
                });
        }



        $scope.filterSearchContent = function($filterBy, $sortBy) {

            if(!$filterBy){
                $filterBy = $scope.type;
            }

            if($filterBy){
                if(!$sortBy && $('a[data-filterby="'+$filterBy+'"]').hasClass('active')){
                    return true;
                }

                $scope.type = $filterBy;
                $scope.currentPage = 1;
                $scope.offset = 0;

                $('a[data-filterby]').removeClass('active');
                $('a[data-filterby="'+$filterBy+'"]').addClass('active');

            }

            if($filterBy == 'all'){
                $('a[data-filterby]').removeClass('active');
                $('a[data-filterby="false"]').addClass('active');

                $filterBy = 'undefined';
            }


            if(!$sortBy){
                $sortBy = $scope.sortBy;
            }

            if($sortBy && $sortBy != 'undefined'){

                if(!$filterBy && $('a[data-sotyby="'+$sortBy+'"]').hasClass('active')){
                    return true;
                }

                $scope.sortBy = $sortBy;
                $scope.currentPage = 1;
                $scope.offset = 0;

                $('a[data-sortby]').removeClass('active');
                $('a[data-sortby="'+$sortBy+'"]').addClass('active');
            }

            var contentBlock =  $('.grid-box-3');

            contentBlock.fadeOut(500, function(){
                $scope.nextLoad =  pagingApi.getSearchContent($scope.$searchQuery, 15, $scope.offset, $filterBy, $sortBy).success(function (response) {
                    $scope.content = response['content'];
                    $('#hit-count').text(response['count']);
                    contentBlock.fadeIn();

                });
            });
        }

        $scope.openSearchDropdown = function (query){
            console.log(query)

                $http({
                    method: "get",
                    url: '/api/search/find-categories/' + query,
                }).success(function (response) {
                    $scope.categorySuggestions = response;
                }).error(function (response) {
                    $scope.categorySuggestions = [];
                });
        }

        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        $scope.$window = $window;

        $scope.open = false;

        $scope.toggleSearch = function () {
            console.log('toggle')
            $scope.open = !$scope.open;
            console.log($scope.open);

            if ($scope.open) {
                $scope.$window.onclick = function (event) {
                    closeSearchWhenClickingElsewhere(event, $scope.toggleSearch);
                };
            } else {
                $scope.open = false;
                $scope.$window.onclick = null;
                $scope.$apply();
            }
        };

        function closeSearchWhenClickingElsewhere(event, callbackOnClose) {

            var clickedElement = event.target;
            if (!clickedElement) return;

            var elementClasses = clickedElement.classList;
            console.log(clickedElement.classList);
            var clickedOnSearchDrawer = elementClasses.contains('top-search') || elementClasses.contains('cat-suggestions');

            if (!clickedOnSearchDrawer) {
                callbackOnClose();
                return;
            }

        }

        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        }


    })
    .controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance) {
      $scope.ok = function () {
        $uibModalInstance.close();
      };

      $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
      };
    })
    .controller('shoplandingController', ['$scope', '$http', 'pagingApi', '$timeout', '$uibModal', function ($scope, $http, pagingApi, $timeout, $uibModal) {
        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        }

        
        $scope.nextLoad = pagingApi.getPlainContent(1, 3, 'deal', 'idea').success(function (response) {
            $scope.dailyDeals = response;
            $timeout(function() {
                jQuery('#daily-deals').royalSlider({
                    arrowsNav: true,
                    loop: false,
                    keyboardNavEnabled: true,
                    controlsInside: false,
                    imageScaleMode: 'fit',
                    arrowsNavAutoHide: false,
                    controlNavigation: 'bullets',
                    thumbsFitInViewport: false,
                    navigateByClick: false,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType:'move',
                    globalCaption: false,
                    deeplinking: {
                      enabled: true,
                      change: false
                    },
                    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                    imgWidth: "100%",
                    autoHeight: true,
                    imageScaleMode: "fill",
                    //    autoScaleSliderWidth: 1500,
                    //    autoScaleSliderHeight: 500,
                    //    autoScaleSlider: true
                });
                }, 
            100);
            
            
              

        });


        pagingApi.getPlainContent(1, 9, false, 'product').success(function (response) {
            $scope.newestArrivals = [];
            for(var i=0; i<= response.length; i++){
                if(i%3 == 0){
                    var newestArrival = [response[i]];
                }else{
                    newestArrival.push(response[i]);
                    if(i%3 == 2 || i == response.length-1){
                        $scope.newestArrivals.push(newestArrival);
                    }
                }
            }
            
            $timeout(function(){
                jQuery('#newest-arrivals').royalSlider({
                    arrowsNav: true,
                    loop: false,
                    keyboardNavEnabled: true,
                    controlsInside: false,
                    arrowsNavAutoHide: false,
                    controlNavigation: 'bullets',
                    thumbsFitInViewport: false,
                    navigateByClick: false,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType:'move',
                    globalCaption: false,
                    deeplinking: {
                      enabled: true,
                      change: false
                    },
                    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                    imgWidth: "100%",
                    imageScaleMode: "fill",
                    autoHeight: true
                }, 100);
            })
        });
    }])

    .controller('shopcategoryController', function ($scope, $filter, pagingApi, $uibModal, $timeout) {
        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };
        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        }
        $scope.currentPage = 1;
        $scope.currentCategory = false;
        $scope.$filterBy = false;
        $scope.sortBy = false;

        var $route =  $filter('getURISegment')(2);
        var $category = false;


        if($route == 'shop'){
            if($category = $filter('getURISegment')(5)){
                $scope.currentCategory = $category;
            }else if($category = $filter('getURISegment')(4)){
                $scope.currentCategory = $category;
            }else{
                $scope.currentCategory = $filter('getURISegment')(3);
            }
        }

        $scope.nextLoad = pagingApi.getPlainContent(1, 15,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {

            if($scope.sortBy){
                response.sort(function(a, b) {
                    return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                });
            }

            $scope.content = response;
        });

        $scope.loadMore = function() {
            $scope.currentPage++;

            var $limit = 15;

            $scope.nextLoad =  pagingApi.getPlainContent($scope.currentPage, $limit,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {
                var $newStuff = $scope.content.concat(response)

                if($scope.sortBy){
                    $newStuff.sort(function (a, b) {
                        return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                    });
                }

                $scope.content = $newStuff;
            });
        };

        //$scope.sortContent = function($sortBy){
        //
        //    if($sortBy === $scope.sortBy){
        //        return true;
        //    }
        //
        //    $('a[data-sortby]').removeClass('active');
        //    $('a[data-sortby="'+$sortBy+'"]').addClass('active');
        //
        //    var contentBlock =  $('.grid-box-3');
        //
        //    contentBlock.fadeOut(500, function(){
        //        $scope.nextLoad =  pagingApi.getPlainContent(1, 15,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {
        //            if($sortBy) {
        //                response.sort(function (a, b) {
        //                    return parseFloat(a[$sortBy]) - parseFloat(b[$sortBy]);
        //                });
        //                $scope.sortBy = $sortBy;
        //                $scope.content = response;
        //                contentBlock.fadeIn();
        //            }else{
        //                $scope.content = response;
        //                contentBlock.fadeIn();
        //            }
        //            $scope.sortBy = $sortBy;
        //
        //        });
        //    });
        //}

        $scope.filterPlainContent = function($filterBy, $sortBy) {

            //if($filterBy === $scope.currentCategory){
            //    return true;
            //}

            if($filterBy){
                if($('a[data-filterby="'+$filterBy+'"]').hasClass('active')){
                    return true;
                }

                $scope.currentCategory = $filterBy;
                $('a[data-filterby]').removeClass('active');
                $('a[data-filterby="'+$filterBy+'"]').addClass('active');

            }

            if($sortBy && $sortBy != 'undefined' && $sortBy != $scope.sortBy){

                if($('a[data-sotyby="'+$sortBy+'"]').hasClass('active')){
                    return true;
                }

                $('a[data-sortby]').removeClass('active');
                $('a[data-sortby="'+$sortBy+'"]').addClass('active');
            }

            var contentBlock =  $('.grid-box-3');

            contentBlock.fadeOut(500, function(){

                $scope.nextLoad =  pagingApi.getPlainContent(1, 15,   $scope.currentCategory, 'product',  $scope.currentCategory).success(function (response) {
                    if($sortBy != false){
                        $scope.sortBy = $sortBy;
                    }

                    if($scope.sortBy && $scope.sortBy != 'default' ){
                        response.sort(function (a, b) {
                            return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                        });
                    }

                    $scope.content = response;
                    contentBlock.fadeIn();
                });
            });
        }
    })
    .directive('a', function() {
    return {
        restrict: 'E',
        link: function(scope, elem, attrs) {
            if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
                elem.on('click', function(e){
                    e.preventDefault();
                });
            }
        }
    };
  })
    .factory('pagingApi', function($http, $window, $q) {
        var pagingApi = {};
        pagingApi.openProductPopup = function ($scope, $uibModal, $timeout, productId) {
            var body = angular.element(document).find('body');
            if(body[0].offsetWidth < 880){
                return;
            }
            
            document.getElementsByTagName('html')[0].className += " hide-overflow ";
            var templateUrl = "product-popup.html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              windowClass : 'product-popup-modal',
              controller: 'ModalInstanceCtrltest'
            });
            modalInstance.opened.then(function(){
                $timeout(function() {
                    $http({
                        url: '/api/product/get-product/' + productId,
                        method: "get",
                    }).success(function (data) {
                        if (data.status_code == 200) {
                            var data = data.data;
                            var imageHTML = "";
                            for(var key in data.selfImages.picture){
                                var picture = data.selfImages.picture[key];
                                imageHTML += '\
                                    <div>\
                                        <img class="rsImg " \
                                             src="'+ picture['link'] +'"\
                                             class="attachment-large wp-post-image"\
                                             alt=""/>\
                                    </div>\
                                '
                            }
                            $('.product-popup-modal #product-slider').html(imageHTML);
                            $('.product-popup-modal .p-title').html("<a target='_blank' href='/product/"+ data.productInformation['Permalink'] +"'>"+ data.productInformation['ProductName'] +"</a>");
                            
                            var html = '\
                                <a class="get-round" href="'+ data.productInformation['AffiliateLink'] +'" target="_blank">Get it</a>\
                                <img class="vendor-logo" width="107" src="'+ data.storeInformation['ImagePath'] +'" alt="'+ data.storeInformation['StoreName'] +'">\
                            ';
                            $('.product-popup-modal .p-get-it-amazon .p-body').html(html);
                            
                            
//                            $('.product-popup-modal .get-round').attr('href', data.productInformation['AffiliateLink']);
                            
                            if(data.productInformation['Review']){
                                var pScore = parseInt(((( Number(data.productInformation['Review'][0].value) > 0 ? Number(data.productInformation['Review'][0].value) : Number(data.productInformation['Review'][1].value)) + Number(data.productInformation['Review'][1].value))/2)*20) + "%";
                            }else{
                                var pScore = "0%";
                            }
                            $('.product-popup-modal .p-score').html(pScore);
                            
                            var price;
                            if(data.productInformation['SellPrice']){
                                price = data.productInformation['SellPrice'];
                            }else{
                                price = 0;
                            }
                            $('.product-popup-modal .aws-price').html(price);
                            
                            var features;
                            if(data.productInformation['Description']){
                                features = data.productInformation['Description'];
                            }else{
                                features = "";
                            }
                            $('#features').html(features);
                            
                            var starRatingHtml = "";
                                $stars = data.productInformation['Review'][0].value;
                                $fStar = Math.floor($stars);
                                $cStar = Math.ceil($stars);
                                $halfStar = -1;
                                if ($fStar == $cStar)
                                    $halfStar = $cStar;

                                for($i=1; $i<=5; $i++){
                                    if($i <= $fStar){
                                        starRatingHtml += '\
                                        <span class="star active">\
                                            <i class="m-icon--star-blue-full"></i>\
                                        </span>\
                                        ';
                                    }else if($cStar == $i){
                                        starRatingHtml += '\
                                        <span class="star half">\
                                            <i class=" m-icon--star-blue-half2"></i>\
                                        </span>\
                                        ';
                                    }else{
                                        starRatingHtml += '\
                                        <span class="star">\
                                            <i class=" m-icon--star-blue-full-lines"></i>\
                                        </span>\
                                        ';
                                    }
                                }
                                $(".product-popup-modal .critic .star-rating").html(starRatingHtml);
                                var counter = data.productInformation['Review'][0].counter == '' ? 0 : data.productInformation['Review'][0].counter;
                                if(counter>1){
                                    var starRatingLabelHtml =  counter + '\
                                        <span class="light-black">\
                                            Reviews\
                                        </span>\
                                    ';
                                }else{
                                    var starRatingLabelHtml =  counter + '\
                                        <span class="light-black">\
                                            Review\
                                        </span>\
                                    ';
                                }
                                $(".product-popup-modal .critic .star-rating-label").html(starRatingLabelHtml);

                            var criticOuterRatingHtml = "";
                                if(data.productInformation['Review']){
                                    var outrReviews = data.productInformation['Review'].slice(2);
                                    for( reviewKey in outrReviews ){
                                        var review = outrReviews[reviewKey];
                                        console.log("reviewKey", reviewKey)
                                        console.log("review", review)
                                        criticOuterRatingHtml += '\
                                            <div class="critic-outer-rating">\
                                                <div class="line-label ">\
                                                    <a\
                                                        href="' + review.link + '"\
                                                        target="_blank">'+ review.key + '\
                                                    </a></div>\
                                                <div class="star-rating" style="text-align: center">';
                                                
                                                    $stars = review.value ? review.value : 0;
                                                    $fStar = Math.floor($stars);
                                                    $cStar = Math.ceil($stars);
                                                    $halfStar = -1;
                                                    if ($fStar == $cStar)
                                                        $halfStar = $cStar;
                                                    // TODO - move to model or Angular

                                                    for($i=1; $i<=5; $i++){
                                                        if($i <= $fStar){
                                                            criticOuterRatingHtml += '\
                                                                <span class="star active">\
                                                                    <i class="m-icon--star-blue-full"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                        else if($cStar == $i){
                                                            criticOuterRatingHtml += '\
                                                                <span class="star half">\
                                                                    <i class=" m-icon--star-blue-half2"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                        else{
                                                            criticOuterRatingHtml += '\
                                                                <span class="star">\
                                                                    <i class=" m-icon--star-blue-full-lines"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                    }
                                        criticOuterRatingHtml += '\
                                                </div>\
                                            </div>\
                                        ';
                                    }
                                }
                            jQuery(".product-popup-modal .critic #critic-outer-rating-holder").html(criticOuterRatingHtml);

                            var starRatingHtml = "";
                                $stars = data.productInformation['Review'][1].value;
                                $fStar = Math.floor($stars);
                                $cStar = Math.ceil($stars);
                                $halfStar = -1;
                                if ($fStar == $cStar)
                                    $halfStar = $cStar;

                                for($i=1; $i<=5; $i++){
                                    if($i <= $fStar){
                                        starRatingHtml += '\
                                        <span class="star active">\
                                            <i class="m-icon--star-blue-full"></i>\
                                        </span>\
                                        ';
                                    }else if($cStar == $i){
                                        starRatingHtml += '\
                                        <span class="star half">\
                                            <i class=" m-icon--star-blue-half2"></i>\
                                        </span>\
                                        ';
                                    }else{
                                        starRatingHtml += '\
                                        <span class="star">\
                                            <i class=" m-icon--star-blue-full-lines"></i>\
                                        </span>\
                                        ';
                                    }
                                }
                                $(".product-popup-modal .amazon .star-rating").html(starRatingHtml);
                                var counter = data.productInformation['Review'][1].counter == '' ? 0 : data.productInformation['Review'][1].counter;
                                var starRatingLabelHtml = '<a href="' + (data.productInformation['Review'][1].link ? data.productInformation['Review'][1].link : "#") + '" target="_blank">'; 
                                if(counter>1){
                                    starRatingLabelHtml +=  counter + '\
                                        <span class="light-black">\
                                            Reviews\
                                        </span>\
                                    ';
                                }else{
                                    starRatingLabelHtml +=  counter + '\
                                        <span class="light-black">\
                                            Review\
                                        </span>\
                                    ';
                                }
                                starRatingLabelHtml += "</a>";
                                $(".product-popup-modal .amazon .star-rating-label").html(starRatingLabelHtml);
                            
                            var criticQuoteHtml = '\
                                <div>' + (data.productInformation['ReviewExtLink'] ? data.productInformation['ReviewExtLink'] : "") + '</div>';
                            $('.product-popup-modal .critic-quote').html(criticQuoteHtml);

                            $http({
                                url: '/api/comment/get-product-comment/'+productId,
                                method: "GET"
                            }).success(function (result) {
                                var comments = result.data;
                                var commentsCount = comments.length;
                                var commentsCountView = commentsCount < 2 ? commentsCount +" "+"Comment" : commentsCount +" "+"Comments";
                                var commentsHtml = "";
                                for(var i=0; i<comments.length; i++){
                                    var comment = comments[i];
                                    commentsHtml += '\
                                        <div class="p-comment-row">\
                                            <div class="pull-left text-center p-comment-user">\
                                                <img src="'+ comment.Picture + '" width="50px" class="p-photo"><br>' + comment.UserName + '</div>\
                                            <div class="p-comment">'
                                                + comment.Comment +
                                                '<div class="p-footer">\
                                                    <time class="p-time pull-left">'+comment.PostTime+'</time>\
                                                    <div class="clearfix"></div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    ';
                                }
                                
                                
                                $('.p-comment-content-holder').html(commentsHtml);
                                $('.p-comment-responses').html(commentsCountView);
                                console.log("comments", comments)
                              //  console.log($scope.comments.length);
                            });

                            
                    jQuery('#product-slider').royalSlider({
                        loop: false,
                        keyboardNavEnabled: true,
                        controlsInside: false,
                                imageScaleMode: 'fit',
                        arrowsNavAutoHide: false,
                        controlNavigation: 'thumbnails',
                        thumbsFitInViewport: false,
                        navigateByClick: true,
                        startSlideId: 0,
                        autoPlay: false,
                        transitionType: 'move',
                        globalCaption: false,
                        autoScaleSlider: false,
                                imgHeight: "100%",
//                                imgWidth: "100%",
//                                imgWidth: "100%",
//                                autoHeight: true,
                        deeplinking: {
                          enabled: true,
                          change: false
                        },
                        
                        autoHeight: true,
                    });
                    document.getElementById( 'product-slider' ).style.visibility = 'visible';
                        }
                    });                    
                    
                }, 100);

            })
            modalInstance.result.finally(function(){
                var className = document.getElementsByTagName('html')[0].className;
                className = className.replace('hide-overflow', '');
                document.getElementsByTagName('html')[0].className = className;
            });
        };

        pagingApi.fakeUpdateCounts = function ($service) {
            var currentCounters =  $('.share-buttons a[data-service="' + $service + '"]').children('.share-count');
            var totalCounters = $('b.share-count.all');
			
			var currentCount = Number(currentCounters.html());
			currentCounters.html(currentCount + 1);

			var totalCount = Number(totalCounters.html());
			totalCounters.html(totalCount + 1);
		}

		pagingApi.openSharingModal = function ($service, $scope) {
            var baseUrl = 'https://' + window.location.host + window.location.pathname;
            var shareUrl = false;

            var $pitnerestShare = function(){
                    var e=document.createElement('script');
                    e.setAttribute('type','text/javascript');
                    e.setAttribute('charset','UTF-8');
                    e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
                    document.body.appendChild(e);

                setTimeout(function(){
					pagingApi.fakeUpdateCounts('pinterest');
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
			pagingApi.fakeUpdateCounts($service);
                    }, 2000);
                    //setTimeout(function(){
                    //    $scope.countSocialShares();
                    //}, 1000);
                    console.log('share counters updated')
                }
            }, 1000);

        };
        
        
        

        pagingApi.getPlainContent = function(page, limit, tag, type, productCategoryID, sortBy) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + tag + '/' + type + '/' + productCategoryID + '/' + sortBy,
            });
        }

        pagingApi.getGridContent = function(page, limit, tag, type, ideaCategory) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-grid-content/' + page + '/' + limit + '/' + tag + '/' + type + '/' + ideaCategory,
            });
        }

        pagingApi.getSearchContent = function(query, limit, offset, type, sortBy) {
            return $http({
                method: "get",
                url: '/api/find/' + query + '/' + limit + '/' + offset + '/' + type + '/' + sortBy,
            });
        }

        pagingApi.getFilteredContent = function(currentPage, $tag, $type, $sliceFunction) {
            var promiseArray = [];

            for(var $page = 1; $page < currentPage + 1; $page++) {

                promiseArray.push(
                    $http.get('/api/paging/get-grid-content/' + $page + '/' + 9 + '/' + $tag+ '/' + $type)
                );
            }

            var $return = $q.all(promiseArray).then(function successCallback(response) {
                var $i = 0;
                var $filtered = [];

                response.forEach(function(batch) {

                    var endContent = [];

                    endContent['regular'] = batch.data['regular'];

                    if($type != null && $type != 'idea'){
                        endContent['featured'] = [];
                    }else{
                        endContent['featured'] =  batch.data['featured']; // we don't filter
                    }

                    $filtered[$i] = $sliceFunction(endContent['regular'], endContent['featured'] );
                    $i++;
                });

                var $return = $filtered;

                return $return;
            });
            return $return;
        }

        return pagingApi;
    })


//
//angular.module('pagingApp.services', []).
//    factory('pagingApi', function($http, $q) {
//
//        var pagingApi = {};
//
//        pagingApi.getGridContent = function(page, limit, tag, category) {
//            return $http({
//                method: 'GET',
//                url: '/api/paging/get-content/' + page + '/' + limit + '/' + tag + '/' + category,
//            });
//        }
//
//        pagingApi.getFilteredContent = function(currentPage, $tag, $category, $sliceFunction) {
//            var promiseArray = [];
//
//            for(var $page = 1; $page < currentPage + 2; $page++) {
//
//                promiseArray.push(
//                    $http.get('/api/paging/get-content/' + $page + '/' + 9 + '/' + $tag+ '/' + $category)
//                );
//            }
//
//            var $return = $q.all(promiseArray).then(function successCallback(response) {
//                var $i = 0;
//                var $filtered = [];
//
//                response.forEach(function(batch) {
//
//                    var endContent = [];
//
//                    endContent['regular'] = batch.data['regular'];
//
//                    if($category != null && $category != 'idea'){
//                        endContent['featured'] = [];
//                    }else{
//                        endContent['featured'] =  batch.data['featured']; // we don't filter
//                    }
//
//                    $filtered[$i] = $sliceFunction(endContent['regular'], endContent['featured'] );
//                    $i++;
//                });
//
//                var $return = $filtered;
//
//                return $return;
//            });
//            return $return;
//        }
//
//        return pagingApi;
//    });

/*.factory('layoutApi', function($http) {

        var layoutApi = {};

        layoutApi.getProductsForShopMenu = function() {
            return $http({
                method: 'GET',
                url: '/api/layout/get-shop-menu/',
            });
        }


        return layoutApi;
    })
    .directive('a', function() {
        return {
            restrict: 'E',
            link: function(scope, elem, attrs) {
                if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
                    elem.on('click', function(e){
                        e.preventDefault();
                    });
                }
            }
        };
    });*/
;

angular.module('pagingApp').value('cgBusyDefaults',{
    message:'',
    backdrop: false,
    templateUrl: '/assets/svg/spinner.html',
    delay: 300,
    minDuration: 700,
    wrapperClass: ''
});

angular.module('pagingApp.filters', [])
    .filter('getURISegment', function($location) {
        return function(segment) {
            var baseUrl = $location.protocol() + '://' + $location.host() + '/';

            var query = $location.absUrl().replace(baseUrl, '');
            var data = query.split("/");
            if(data[segment-2]) {
                return data[segment-2];
            }
            return false;
        }
    });



// bootstrap for modularization ( add id="pagingApp" with initializing ng-app='pagingApp')
//angular.bootstrap(document.getElementById('pagingApp'),['pagingApp']);



;
/*** Created by sanzeeb on 1/7/2016.*/

var productApp = angular.module('productApp', ['ui.bootstrap', 'autocomplete', 'ngSanitize', 'angular-confirm', 'textAngular']);

// directive for heart action for grid items
productApp.directive('heartCounterProduct', ['$http', function($http) {
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
                        plink: $scope.cleanUrl($scope.plink),
                    }
                }).success(function (data) {
                    $attrs.ustatus = data.UserStatus;

                    $scope.unHeart = data.UserStatus;
                    $scope.heartCounter = data.Count;

                });
            };

            // clean url for ideaing URL (take only permalink)
            $scope.cleanUrl = function(urlString){
                urlString = urlString.toString();
                var domainBuilder = "https://"+window.location.host+"/ideas/";
                var cleanString = urlString.replace(domainBuilder,'');
                return cleanString;
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
                        plink: $scope.cleanUrl($scope.plink),
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


// Setting values of Angular Text Editor
productApp.config(['$provide', function ($provide) {
    // this demonstrates how to register a new tool and add it to the default toolbar
    $provide.decorator('taOptions', ['taRegisterTool', '$delegate', function (taRegisterTool, taOptions) {
        // $delegate is the taOptions we are decorating
        // here we override the default toolbars and classes specified in taOptions.
        taOptions.forceTextAngularSanitize = true; // set false to allow the textAngular-sanitize provider to be replaced
        taOptions.keyMappings = []; // allow customizable keyMappings for specialized key boards or languages

        /*taOptions.toolbar = [
         ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'quote',
         'bold', 'italics', 'underline', 'ul', 'ol', 'redo', 'undo', 'clear',
         'justifyLeft','justifyCenter','justifyRight', 'justifyFull',
         'insertImage', 'insertLink']
         ];*/

        taRegisterTool('insertCustomImage', {
            iconclass: "fa fa-picture-o",
            action: function () {
                this.$editor().$parent.insertCustomImagePopup();

            }
        });

        taOptions.toolbar = [
            ['bold', 'insertCustomImage']
        ];

        taOptions.classes = {
            focussed: 'focussed',
            toolbar: 'btn-toolbar',
            toolbarGroup: 'btn-group',
            toolbarButton: 'btn btn-default',
            toolbarButtonActive: 'active',
            disabled: 'disabled',
            textEditor: 'form-control',
            htmlEditor: 'form-control'
        };
        return taOptions; // whatever you return will be the taOptions
    }]);
    // this demonstrates changing the classes of the icons for the tools for font-awesome v3.x
    /*$provide.decorator('taTools', ['$delegate', function(taTools){
     taTools.bold.iconclass = 'icon-bold';
     taTools.italics.iconclass = 'icon-italic';
     taTools.underline.iconclass = 'icon-underline';
     taTools.ul.iconclass = 'icon-list-ul';
     taTools.ol.iconclass = 'icon-list-ol';
     taTools.undo.iconclass = 'icon-undo';
     taTools.redo.iconclass = 'icon-repeat';
     taTools.justifyLeft.iconclass = 'icon-align-left';
     taTools.justifyRight.iconclass = 'icon-align-right';
     taTools.justifyCenter.iconclass = 'icon-align-center';
     taTools.clear.iconclass = 'icon-ban-circle';
     taTools.insertLink.iconclass = 'icon-link';
     taTools.insertImage.iconclass = 'icon-picture';
     // there is no quote icon in old font-awesome so we change to text as follows
     delete taTools.quote.iconclass;
     taTools.quote.buttontext = 'quote';
     return taTools;
     }]);*/
}]);


productApp.controller('productController', ['$scope', '$http', '$window', '$interval', '$timeout'
    , function ($scope, $http, $window, $interval, $timeout) {

        $scope.focusEditor = function () {
            $timeout(function () {
                angular.element('div[contenteditable=true]').trigger('focus');
            })
        }
        $scope.insertCustomImagePopup = function () {
            alert("Please add the code for photo uploading here");
        }
        $scope.textAreaSetup = function ($element) {
            $element.attr('focus-me', 'focus_editor');
        };
        // initialize variables
        $scope.initPage = function () {

            $scope.productInformation = [];
            $scope.relatedProducts = [];
            $scope.selfImages = [];

            $scope.permalink = $window.permalink;

            $scope.ProductName = '';
            $scope.Description = '';

            $scope.tmp = "/assets/images/dummies/slider/PC220020-1024x683.jpg";

            //product compare
            $scope.selectedProduct = '';
            $scope.comparableProductList = [];
            $scope.suggestedItems = [];
            $scope.suggestedItemsWithId = [];
            $scope.specList = [];

            $scope.compareIndex = 0;
            $scope.dataLength = 0;//$scope.comparableProductList.length;
            $scope.temporaryViewList = [];

            $scope.showCompareButton = true;

            // Comment section
            $scope.html = "";
            $scope.comments = [];
            $scope.commentsCount = 0;
            $scope.commentsCountView = "";//$scope.commentsCount < 2? $scope.commentsCount +" "+"Comment" : $scope.commentsCount +" "+"Comments";

            $scope.productId = 0;
            $scope.userId = 0;
            $scope.isAdmin = false;
            $scope.isEdit = false;
            $scope.commentId = null;

            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;


        };

        // Heart //

        $scope.heartAction = function (userId, ItemId, permalink, section) {

            // an anonymous will be returned withough performing any action.
            if (userId == 0)
                return;

            $http({
                url: '/api/heart/add-heart',
                method: "POST",
                data: {
                    uid: userId,
                    iid: ItemId,
                    plink: permalink,
                    section: section,
                    uht: $scope.unHeart
                }
            }).success(function (data) {
                $scope.heartCounterAction(userId, ItemId, section);
                $scope.unHeart = !$scope.unHeart;
            });
        };

        $scope.heartCounterAction = function (userId, ItemId, section) {
            $http({
                url: '/api/heart/count-heart',
                method: "POST",
                data: {
                    uid: userId,
                    iid: ItemId,
                    section: section
                }
            }).success(function (data) {
                $scope.unHeart = data.UserStatus;
                $scope.heartCounter = data.Count;
            });

        };

        // Comment for product section
        $scope.addCommentForProduct = function (userId, productId, permalink, comment) {
            //console.log(userId,productId,permalink,comment);

            $http({
                url: '/api/comment/add-product-comment',
                method: "POST",
                data: {
                    uid: userId,
                    pid: productId,
                    plink: permalink,
                    comment: comment
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.getCommentsForProduct($scope.productId);


            });
        };

        $scope.getCommentsForProduct = function (pid) {

            $http({
                url: '/api/comment/get-product-comment/' + pid,
                method: "GET"
            }).success(function (data) {
                $scope.productId = pid;
                $scope.comments = data.data;
                $scope.commentsCount = $scope.comments.length;
                $scope.commentsCountView = $scope.commentsCount < 2 ? $scope.commentsCount + " " + "Comment" : $scope.commentsCount + " " + "Comments";

                //  console.log($scope.comments.length);
            });

        };

        // update comment in the comment view through AJAX call.
        var commnetTimer = $interval(function () {
            //  console.log("in");
            if ($scope.productId != 0) {
                $scope.getCommentsForProduct($scope.productId);
            }
        }, 15000);//10000


        $scope.editComment = function (comment) {
            //  console.log(comment);

            $scope.isEdit = true;

            $scope.commentId = comment.CommentId;

            $scope.html = comment.Comment;


        };

        $scope.updateCommentForProduct = function (id, comment) {
            $http({
                url: '/api/comment/update-comment',
                method: "POST",
                data: {
                    cid: $scope.commentId,
                    comment: $scope.html
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.isEdit = false;
                // console.log("pid :"+ $scope.productId);
                $scope.getCommentsForProduct($scope.productId);
            });

        };


        $scope.deleteCommentForProduct = function (id) {
            $http({
                url: '/api/comment/delete-comment',
                method: "POST",
                data: {
                    cid: id
                }
            }).success(function (data) {
                $scope.getCommentsForProduct($scope.productId);
            });

        };


        // toggle compare button
        $scope.toggleCompareButton = function () {
            $scope.showCompareButton = !$scope.showCompareButton;

        };

        // search comparable it by name
        $scope.searchProductByName = function (query) {

            //min string length to call ajax
            if (query.length < 3)
                return;

            $scope.suggestedItems = [];
            $scope.suggestedItemsWithId = [];

            $http({
                url: '/api/product/product-find/' + query,
                method: "GET",

            }).success(function (data) {
                for (var i = 0; i < data.length; i++) {
                    $scope.suggestedItems.push(data[i]['name']);
                    $scope.suggestedItemsWithId.push(data);

                }
            });

        };

        $scope.selectedIdem = function (query) {
            //  console.log($scope.comparableProductList);
            $http({
                url: '/api/product/get-by-name/' + query,
                method: "GET",

            }).success(function (data) {
                $scope.comparableProductList.push(data);

                $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);
                $scope.dataLength = $scope.comparableProductList.length;
                $scope.selectedProduct = '';

                $scope.toggleCompareButton();

            });

        };

        $scope.deleteSelectedItem = function (index) {
            $scope.comparableProductList.splice(index, 1);

            $scope.dataLength = $scope.comparableProductList.length;
            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };

        $scope.traverseForward = function () {

            if ($scope.compareIndex <= $scope.dataLength - 1)
                $scope.compareIndex++;

            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };

        $scope.traverseBackward = function () {

            if ($scope.compareIndex >= 1)
                $scope.compareIndex--;


            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };


        $scope.loadProductDetails = function () {
            // console.log(permalink);
            $http({
                url: '/api/pro-details/' + $scope.permalink,
                method: "GET",
            }).success(function (data) {

                if (data.status_code == 200) {
                    $scope.comparableProductList.push(data);


                    $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);
                    $scope.dataLength = $scope.comparableProductList.length;

                    // set spec list for product compare
                    var item = data.data.productInformation.Specifications;

                    for (var i = 0; i < item.length; i++) {
                        var specName = item[i].key;

                        // set the key as view-able order ("ProductSize" = "Product Size")
                        specName = specName.split(/(?=[A-Z])/).join(" ");
                        $scope.specList.push(specName);
                    }

                }
            });

        };

        $scope.initPage();


    }]);

/* bootstrap for modularization
//angular.bootstrap(document.getElementById('productApp'),['productApp']);*/

