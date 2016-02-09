/**
 * Created by sanzeeb on 1/7/2016.
 */

var publicApp = angular.module('publicApp', ['ui.bootstrap', 'ngSanitize']);

publicApp.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

publicApp.controller('publicController', ['$scope', '$http', '$window', '$timeout', '$location', '$anchorScroll'
    , function ($scope, $http, $window, $timeout, $location, $anchorScroll) {

        // initialize variables
        $scope.initPage = function () {

            // email subscription
            $scope.SubscriberEmail = '';
            $scope.responseMessage = '';

            $scope.alerts = [];
            $scope.alertHTML = '';

            $scope.logingRedirectLocation = '/';

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
        }


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
                case 200:
                {
                    $scope.addAlert('success', message);
                }
                    break;
                case 210:
                {
                    $scope.addAlert('', message);
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

            //   'layouts.parts.login-signup'

        };

        $scope.registerUser = function () {
            $scope.closeAlert();

            if ($scope.Password != $scope.PasswordConf)
            {
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
                    Valid:true
                }

            }).success(function (data) {
                $scope.outputStatus(data, data.data);

               /* if(data.status_code == 200)
                    window.location = $scope.logingRedirectLocation;
*/
            });

        };


        $scope.registerWithFB = function(){

            window.location = '/api/fb-login';
        };

        $scope.loginUser = function(){

            $http({
                url: '/api/authenticate',
                method: "POST",
                data: {
                    Email: $scope.Email,
                    Password: $scope.Password,

                }
            }).success(function (data) {
                $scope.outputStatus(data, data.data);

                /* if(data.status_code == 200)
                 window.location = $scope.logingRedirectLocation;
                 */
            });
        };

        $scope.chk = function(){

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


// bootstrap for modularization
angular.bootstrap(document.getElementById('publicApp'),['publicApp']);