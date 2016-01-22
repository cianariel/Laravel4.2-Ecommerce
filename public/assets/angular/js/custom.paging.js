/**
 * Created by sanzeeb on 1/7/2016.
 */

var pagingApp = angular.module('pagingApp', ['ui.bootstrap', 'autocomplete']);


pagingApp.controller('pagingController', ['$scope', '$http', '$window'
    , function ($scope, $http, $window) {


         //initialize variables
        $scope.initPage = function () {
        //
            $scope.content = [];
        //    $scope.relatedProducts = [];
        //    $scope.selfImages = [];
        //
        //    $scope.permalink = $window.permalink;
        //
        //    $scope.ProductName = '';
        //    $scope.Description = '';
        //
        //    $scope.tmp = "/assets/images/dummies/slider/PC220020-1024x683.jpg";
        //
        //
        //
        };

        // search comparable it by name
        $scope.loadMore = function (query) {

            //min string length to call ajax
            //if (query.length < 3)
            //    return;

            $http({
                url: '/api/paging/get-content',
                method: "GET",

            }).success(function (data) {
                for (var i = 0; i < data.length; i++) {
                   console.log(data)
                }
            });

        };


        $scope.initPage();


    }]);

angular.module('F1FeederApp.controllers', []).
    controller('driversController', function($scope, ergastAPIservice) {
        $scope.nameFilter = null;
        $scope.driversList = [];

        ergastAPIservice.getDrivers().success(function (response) {
            //Dig into the responde to get the relevant data
            $scope.driversList = response.MRData.StandingsTable.StandingsLists[0].DriverStandings;
        });
    });

angular.module('F1FeederApp', [
    'F1FeederApp.controllers',
    'F1FeederApp.services'
]);

angular.module('F1FeederApp.services', []).
    factory('ergastAPIservice', function($http) {

        var ergastAPI = {};

        ergastAPI.getDrivers = function() {
            return $http({
                method: 'JSONP',
                url: 'http://ergast.com/api/f1/2013/driverStandings.json?callback=JSON_CALLBACK'
            });
        }

        return ergastAPI;
    });