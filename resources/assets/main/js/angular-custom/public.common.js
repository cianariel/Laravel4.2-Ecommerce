/**
 * Created by sanzeeb on 1/7/2016.
 */

var publicApp = angular.module('publicApp', ['ui.bootstrap', 'ngSanitize', 'angularFileUpload']);

publicApp.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

// directive for heart action for grid items
publicApp.directive('heartCounterPublic', ['$http', function ($http) {
    return {
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: {
            uid: '=',
            iid: '=',
            plink: '=',
            sec: '=',
        },
        controller: function ($scope, $element, $attrs) {

            // console.log(window.location.host);
            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;

            $scope.heartCounterAction = function () {


                $http({
                    url: '/api/heart/count-heart',
                    method: "POST",
                    data: {
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
            $scope.cleanUrl = function (urlString) {
                //console.log('url : '+ urlString);
                return urlString;
            };

            $scope.heartAction = function () {

                // an anonymous will be returned without performing any action.
                if ($attrs.uid == 0)
                    return;

                $http({
                    url: '/api/heart/add-heart',
                    method: "POST",
                    data: {
                        section: $attrs.sec,
                        uid: $scope.uid,
                        iid: $scope.iid,
                        plink: $scope.cleanUrl($attrs.plink),
                        uht: $scope.unHeart
                    }
                }).success(function (data) {
                    $scope.heartCounterAction();
                    $scope.unHeart = !$scope.unHeart;
                });
            };

            $scope.heartCounterAction();

        },

        template: '      <div class="">' +
        '                    <a class="likes"' +
        '                       ng-click="heartAction()"' +
        '                    >' +
        '                        <i ng-class="unHeart != false ? \'m-icon m-icon--heart-solid\' : \'m-icon m-icon--ScrollingHeaderHeart\'">' +
        '                                <span class="m-hover">' +
        '                                    <span class="path1"></span><span class="path2"></span>' +
        '                                </span>' +
        '                        </i>' +
        '                        <span class="social-stats__text" ng-bind="heartCounter">&nbsp; </span>' +
        '                    </a>' +
        '                </div>'


    }
}]);

// directive for pulling author info pulling in grid items
publicApp.directive('showAuthorInfo', ['$http', '$window', function ($http, $window) {
    return {
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: {
            email: '@',
            url: '@'

        },
        controller: function ($scope, $element, $attrs) {

            $scope.authorInfo = function () {

                $http({
                    url: '/api/info-raw/' + $scope.email,
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

        template: '      <div class="box-item__author">' +
        '                    <a href="{{ url }}" class="user-widget">' +
        '                       <img class="user-widget__img" src="{{ authorImage }}">' +
        '                     <span class="user-widget__name">{{ authorName }}</span>' +
        '                    </a>' +
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
publicApp.controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance, pagingApi, $http) {
    $scope.ok = function () {
        $uibModalInstance.close();
    };
    $scope.hideAndForget = function () {
        $http({
            url: '/hide-signup',
            method: "GET",

        }).success(function (data) {
            $uibModalInstance.close();
        });
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.openSharingModal = function ($service) {
        pagingApi.openSharingModal($service);
    };

});

publicApp.controller('publicController', ['$rootScope', '$scope', '$http', '$window', '$timeout', '$location', '$anchorScroll', '$uibModal', 'layoutApi', '$compile', '$interval', 'FileUploader', 'pagingApi', '$uibModalStack'
    , function ($rootScope, $scope, $http, $window, $timeout, $location, $anchorScroll, $uibModal, layoutApi, $compile, $interval, FileUploader, pagingApi, $uibModalInstance, $uibModalStack) {

        // text area internal function for comment
        $scope.focusEditor = function () {
            $timeout(function () {
                angular.element('div[contenteditable=true]').trigger('focus');
            })
        }
        $scope.insertCustomImagePopup = function () {
            alert("Please add the code for photo uploading here");
        }
        $scope.openProductPopup = function (id) {
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        };
        $scope.textAreaSetup = function ($element) {
            $element.attr('focus-me', 'focus_editor');
        };


        // update comment in the comment view through AJAX call.
        var commnetTimer = $interval(function () {
            //  console.log("in");
            if ($scope.uid != null) {
                $scope.loadNotification($scope.uid);
            }

            if ($scope.itemId != 0) {

                // reduce http call in comment section.
                if ($scope.commentSection == 'giveaway')
                    $scope.getCommentsForGiveaway($scope.itemId);
                else
                    $scope.getCommentsForIdeas($scope.itemId);

            }
        }, 15000);//10000

        $scope.openEmailPopuponTime = function () {
            if (!$('body').hasClass('login-signup')) {
                setTimeout(function () {
                    $scope.getEmailPopup();
                }, 25000)
            }

        }

        $scope.getEmailPopup = function () {
            // Header profile option open and close on click action.

            var templateUrl = "subscribe_email_popup.html";
            $scope.modalInstance = $uibModal.open({
                    templateUrl: templateUrl,
                    scope: $scope,
                    size: 'md',
                    windowClass: 'subscribe_email_popup',
                    controller: 'ModalInstanceCtrltest'
                })
                .result.finally(function () {
                    $scope.uploader.formData = [];

                    $http({
                        url: '/hide-signup',
                        method: "GET",

                    }).success(function (data) {
                        console.log(data)
                    });
                });
        };

        //$scope.hideSiggnupModal = function () {
        //    // Header profile option open and close on click action.
        //
        //    $http({
        //        url: '/hide-signup',
        //        method: "GET",
        //
        //    }).success(function (data) {
        //        //$('.subscribe_email_popup').fadeOut();
        //        $uibModalStack.dismissAll();
        //
        //    });
        //};

        $scope.openProfileSetting = function (onlyImage) {

            // for changing only image from user profile's "Change Image" button
            if (onlyImage == true)
                $scope.onlyImage = true;
            else
                $scope.onlyImage = false;

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
                });
        };

        $scope.openSharingModal = function ($service) {
            pagingApi.openSharingModal($service, $scope)

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

                //  console.log($scope.oldMediaLink, ' : ', $scope.MediaLink);

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
            $scope.giveAwayID = '';

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
            $scope.onlyImage = false;

            // popup signup
            $scope.popupSignup = true;

            // notification
            $scope.notificationCounter = 0;
            $scope.notifications = [];
            $scope.uid = null;

            // comment ideas and giveaway
            $scope.itemId = 0;
            $scope.userId = 0;
            $scope.isAdmin = false;
            $scope.commentId = null;
            $scope.commentsCount = 0;

            $scope.commentSection = '';


            //Ideas author info
            $scope.authorName = '';
            $scope.authorImage = null;

            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;
            $scope.heartUsersInfo = [];

            // Contact Us
            $scope.Type = 'Support';
            $scope.contactError = false;

            // user profile heart comment hide/show

            $scope.showComment = true;
            $scope.showHeart = true;

            $scope.activeClassAll = 'active';
            $scope.activeClassComment = '';
            $scope.activeClassHeart = '';

            $scope.socialCounter = function () {

                $scope.countSocialShares();
                $scope.countSocialFollowers();
            };

            setTimeout(
                function () {
                    $('#top-nav a.new-message span').css('visibility', 'visible');
                },
                6000);

            jQuery(document).ready(function ($) {
                var args = {
                    arrowsNav: true,
                    loop: true,
                    loopRewind: true,
                    keyboardNavEnabled: true,
                    controlsInside: true,
                    controlNavigation: 'bullets',
                    arrowsNavAutoHide: false,
                    slidesSpacing: 0,
                    imageScaleMode: 'none',
                    imgWidth: 1175,
                    imageAlignCenter: true,
                    autoScaleSliderWidth: 1180,
                    autoScaleSliderHeight: 394,
                    thumbsFitInViewport: false,
                    navigateByClick: true,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType: 'move',
                    globalCaption: false,
                    addActiveClass: true,
                    deeplinking: {
                        enabled: true,
                        change: false
                    },
                };

                if (window.innerWidth < 1176) {
                    args.visibleNearby = {
                        enabled: false,
                        center: false,
                    }
                } else {
                    args.visibleNearby = {
                        enabled: true,
                        center: true,
                        navigateByCenterClick: true
                    }
                }

                $('#hero-slider').royalSlider(args);
            });
        };


        $scope.isEmpty = function (data) {
            if (!data || data.length === 0)
                return true;
            else
                return false;

        };

        // contact us

        $scope.sendContactUsQuery = function () {
            $scope.contactError = false;
            if ($scope.isEmpty($scope.Email) || $scope.isEmpty($scope.Message)) {
                $scope.contactError = true;
                return;
            }


            $http({
                url: '/api/contact-us',
                method: "POST",
                data: {
                    Name: $scope.Name,
                    Email: $scope.Email,
                    Type: $scope.Type,
                    Message: $scope.Message,
                }
            }).success(function (data) {

                if (data.status_code == '406') {
                    $scope.errorMessage = 'Invalid Email provided';
                    $scope.contactError = true;
                } else {

                    $scope.Code = true;
                    window.location = '/';
                }

            });

        };

        // Heart //

        $scope.heartAction = function () {

            //  console.log($window.plink,$window.uid,$window.itemId);
            //return;
            userId = $window.uid;
            ItemId = $window.itemId;
            permalink = $window.plink;
            section = 'ideas';

            // an anonymous will be returned without performing any action.
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
                $scope.heartCounterAction();
                $scope.unHeart = !$scope.unHeart;
            });
        };

        $scope.heartCounterAction = function () {

            userId = $window.uid;
            ItemId = $window.itemId;
            section = 'ideas';

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

                //   console.log($scope.heartCounter);
            });

        };

        // get recently liked users list
        $scope.heartUsers = function (section) {
            ItemId = $window.itemId;

            $http({
                url: '/api/heart/heart-users',
                method: "POST",
                data: {
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
                    window.location = '/user/profile'; //window.location = '/admin/dashboard';
                    break;
                case 'editor':
                    window.location = '/user/profile'; //window.location = '/admin/dashboard';
                    break;
                case 'user':
                    window.location = '/user/profile';

                    break;

            }
        };

        $scope.getAuthorInfoByEmail = function (email) {
            //console.log("inside");
            $http({
                url: '/api/info-raw/' + email,
                method: "GET",
            }).success(function (data) {

                $scope.authorName = data.name;
                $scope.authorImage = data.medias[0].media_link;
                $scope.authorBio = data.user_profile.personal_info;
                $scope.authorPermalink = data.permalink;

                // console.log($scope.authorName," - ",$scope.authorImage);

            });
        };

        // Comment for ideas section
        $scope.addCommentForIdeas = function (userId, itemId, permalink, comment) {
            //   console.log(userId, itemId, permalink, comment);

            $http({
                url: '/api/comment/add-ideas-comment',
                method: "POST",
                data: {
                    uid: userId,
                    pid: itemId,
                    plink: permalink,
                    comment: comment,
                    img: $window.img
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.getCommentsForIdeas($scope.itemId);
            });
        };

        $scope.getCommentsForIdeas = function (pid) {

            $http({
                url: '/api/comment/get-ideas-comment/' + pid,
                method: "GET"
            }).success(function (data) {
                $scope.itemId = pid;
                $scope.comments = data.data;
                $scope.commentsCount = $scope.comments.length;
                $scope.commentsCountView = $scope.commentsCount < 2 ? $scope.commentsCount + " " + "Comment" : $scope.commentsCount + " " + "Comments";

                //  console.log($scope.commentsCount);

            });
        };

        // Comment for giveaway section
        $scope.addCommentForGiveaway = function (userId, itemId, permalink, comment) {
            //   console.log(userId, itemId, permalink, comment);

            $http({
                url: '/api/comment/add-giveaway-comment',
                method: "POST",
                data: {
                    uid: userId,
                    pid: itemId,
                    //  plink: permalink + '/' + $window.giveawayLink,
                    plink: $window.giveawayLink,

                    comment: comment,
                    img: $window.img
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.getCommentsForGiveaway($scope.itemId);
            });
        };

        $scope.getCommentsForGiveaway = function (pid) {

            // set comment section to reduce call
            $scope.commentSection = 'giveaway';
            $http({
                url: '/api/comment/get-giveaway-comment/' + pid,
                method: "GET"
            }).success(function (data) {
                $scope.itemId = pid;
                $scope.comments = data.data;
                $scope.commentsCount = $scope.comments.length;
                $scope.commentsCountView = $scope.commentsCount < 2 ? $scope.commentsCount + " " + "Comment" : $scope.commentsCount + " " + "Comments";


                //   console.log('item id :'+ $scope.itemId );

            });
        };


        $scope.initCommentCounter = function () {
            //  $scope.getCommentsForIdeas($window.itemId);
        };


        $scope.editComment = function (comment) {
            //  console.log(comment);

            $scope.isEdit = true;

            $scope.commentId = comment.CommentId;

            $scope.html = comment.Comment;


        };

        $scope.updateComment = function (comment) {
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
                //  $scope.getCommentsForIdeas($scope.itemId);

                // reduce http call in comment section.
                if ($scope.commentSection == 'giveaway')
                    $scope.getCommentsForGiveaway($scope.itemId);
                else
                    $scope.getCommentsForIdeas($scope.itemId);
            });

        };


        $scope.deleteComment = function (id) {
            $http({
                url: '/api/comment/delete-comment',
                method: "POST",
                data: {
                    cid: id
                }
            }).success(function (data) {
                //  $scope.getCommentsForIdeas($scope.itemId);
                // reduce http call in comment section.
                if ($scope.commentSection == 'giveaway')
                    $scope.getCommentsForGiveaway($scope.itemId);
                else
                    $scope.getCommentsForIdeas($scope.itemId);
            });

        };

        // Subscribe a user through email and redirect to registration page.
        $scope.subscribe = function (formData, source) {

            $scope.responseMessage = '';
            if (source == 'popup')
                source = 'popup';
            else if (source == 'ideas')
                source = 'ideas';
            else if (source == 'footer')
                source = 'footer';
            else if (source == 'home')
                source = 'home';
            else
                source = '';


            $http({
                url: '/api/subscribe',
                method: "POST",
                data: {
                    'Email': formData.SubscriberEmail,
                    'Source': source,
                    'SetCookie': 'true'
                }
            }).success(function (data) {

                if (data.status_code == 406) {

                    $scope.responseMessage = "Sorry, the email  character is incorrect";
                }

                else if (data.status_code == 200) {
                    $scope.responseMessage = "Successfully Subscribed";

                    //Redirect a user to registration page. 
                    window.location = '/signup/' + formData.SubscriberEmail + '/' + source;

                } else {
                    $scope.responseMessage = "Sorry, this email already exists";
                   // console.log($scope.responseMessage);
                }

            });

        };
        // Subscribe a user through email and redirect to registration page.
        $scope.enterGiveaway = function (formID, redirect) {
            var form = $('#' + formID);

            $http({
                url: '/api/giveaway/enter',
                method: "POST",
                data: {
                    'Email': form.find('input[name="email"]').val(),
                    'Password': form.find('input[name="password"]').val(),
                    'giveaway_id': $('#giveaway_id').val(),
                    //'SetCookie': 'true'
                }
            }).success(function (data) {
                if (redirect) {
                    window.location.href = '/giveaway'
                } else {
                    $scope.responseMessage = data;
                }
            });

        };

        $scope.registerSubscribedUser = function () {

            // defining the regsitration source
            sourceSegment = '';
            valSeg = window.location.pathname.split('/');

            if (valSeg[3] == 'popup')
                sourceSegment = 'popup';
            else if (valSeg[3] == 'ideas')
                sourceSegment = 'ideas';
            else if (valSeg[3] == 'home')
                sourceSegment = 'home';

          //  console.log(valSeg);
          //  return;
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
                    UserFrom: sourceSegment,
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

        $scope.registerUser = function (source) {
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
                if (source == 'giveaway') {
                    // window.location = 'giveaway';
                    $scope.loginUser('giveaway');
                }

                /* if(data.status_code == 200)
                 window.location = $scope.loginRedirectLocation;
                 */
            });

        };

        // Load user activity like/comment in user profile
        $scope.userActivityList = function (userId, count) {

            if ($scope.userActivityCount == null)
                $scope.userActivityCount = count;
            else
                $scope.userActivityCount = $scope.userActivityCount + count;

            $scope.profilePicture = $window.profilePicture;
            $scope.profileFullName = $window.profileFullName;


            console.log('act : ', userId, $scope.userActivityCount);

            $http({
                url: '/api/user/activities',
                method: "POST",
                data: {
                    UserId: userId,
                    ActivityCount: $scope.userActivityCount
                }

            }).success(function (data) {
                $scope.activityData = data.data;
            });

        };


        $scope.registerWithFB = function () {

            window.location = '/api/fb-login';
        };

        $scope.giveawayLoginFB = function () {

            window.location = '/api/fb-login?vlu=giveaway&pl=' + $window.giveawayLink;
        };


        $scope.loginUser = function (source) {
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
                //  console.log(data.data);
                if (source == 'giveaway') {
                   // console.log('redirecting to giveaway');
                    window.location = '/giveaway/' + $window.giveawayLink;
                    return;
                }

                //   var WpLoginURL = 'https://ideaing.com/ideas/api?call=login&username=' + $scope.Email + '&password=' + $scope.Password + '&remember=' + $scope.rememberMe;
                var WpLoginURL = '/ideas/api?call=login&username=' + $scope.Email + '&password=' + $scope.Password + '&remember=' + $scope.rememberMe;

                $http({
                    url: WpLoginURL,
                    method: "GET"

                }).success(function (data) {
                    var from = $location.search().from; // TODO -- disable this
                    if (from === 'cms') {
                        //  window.location = 'https://ideaing.com/ideas/wp-admin';
                        window.location = '/ideas/wp-admin';

                    }
                }).error(function (data, status, headers, config) {
                    if (data.success) {
                        var from = $location.search().from; // TODO -- disable this
                        if (from === 'cms') {
                            //    window.location = 'https://ideaing.com/ideas/wp-admin';
                            window.location = '/ideas/wp-admin';
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
            }).error(function (data) {
                window.location = '/api/logout';
            });
        }

        $scope.passwordResetRequest = function () {
            $scope.closeAlert();
            if (!$scope.Email) {
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
        $scope.loadNotification = function (uid) {

            $scope.uid = uid;
            $http({
                url: '/api/notification/' + uid,
                method: "GET",
            }).success(function (data) {

                $scope.notificationCounter = data.data.NotReadNoticeCount;
                $scope.notifications = data.data.NoticeNotRead;

            });
        };

        $scope.readAllNotification = function () {

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

        // Activity hide show for user profile

        $scope.showActivity = function (data) {
            if (data == 'all') {
                $scope.showComment = true;
                $scope.showHeart = true;

                $scope.activeClassAll = 'active';
                $scope.activeClassComment = '';
                $scope.activeClassHeart = '';


            } else if (data == 'comment') {
                $scope.showComment = true;
                $scope.showHeart = false;

                $scope.activeClassAll = '';
                $scope.activeClassComment = 'active';
                $scope.activeClassHeart = '';

            } else if (data == 'heart') {
                $scope.showComment = false;
                $scope.showHeart = true;

                $scope.activeClassAll = '';
                $scope.activeClassComment = '';
                $scope.activeClassHeart = 'active';
            }
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

        $scope.countSocialShares = function () {
            pagingApi.countSocialShares();
        }
        $scope.countSocialFollowers = function () {

            var thisUrl = window.location.host + window.location.pathname;

            $http({
                url: '/api/social/get-fan-counts',
                method: "GET",
                params: {'url': thisUrl}
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

