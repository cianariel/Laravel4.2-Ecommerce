/**
 * Created by sanzeeb on 1/7/2016.
 */

var publicApp = angular.module('publicApp', ['ui.bootstrap', 'ngSanitize', 'angularFileUpload']);

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


publicApp.controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance) {
    $scope.ok = function () {
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});

publicApp.controller('publicController', ['$scope', '$http', '$window', '$timeout', '$location', '$anchorScroll', '$uibModal', 'layoutApi', 'FileUploader'
    , function ($scope, $http, $window, $timeout, $location, $anchorScroll, $uibModal, layoutApi, FileUploader) {

        // Header profile option open and close on click action.

        $scope.openProfileSetting = function () {

            var templateUrl = "profile-setting.html";
            var modalInstance = $uibModal.open({
                templateUrl: templateUrl,
                scope: $scope,
                size: 'lg',
                windowClass: 'profile-setting-modal',
                controller: 'ModalInstanceCtrltest'
            });

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
            if($scope.isProfilePage){

                $scope.oldMediaLink = $scope.mediaLink;
                $scope.showBrowseButton = !$scope.showBrowseButton;

                $scope.uploader.uploadAll();

                console.log($scope.oldMediaLink,' : ',$scope.MediaLink);

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
            $scope.isProfilePage = false ;
            $scope.showBrowseButton = true;

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
                    if (message == 'Successfully password reset')
                        window.location = '/login';

                }
                    break;
                case 210:
                {
                    $scope.addAlert('', message);
                }
                    break;
                case 220:
                {
                    $scope.addAlert('success', data.data.message);
                    if (data.data.message == 'Successfully authenticated.')
                        $scope.redirectUser(data.data.roles)
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

                }
            }).success(function (data) {
                //   console.log(data.data);

                $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });
        };

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

        $scope.initProfilePage = function(){
            $scope.isProfilePage = true;
        };

        $scope.initProfilePicture = function(link){
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

        $scope.cancelPictureUpdate = function(){
            $scope.mediaLink = $scope.oldMediaLink;
            $scope.showBrowseButton = !$scope.showBrowseButton;

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


        $scope.initPage();
        // $scope.addAlert('danger','testingtestingtestingtestingtestingtestingtesting');

    }]);

