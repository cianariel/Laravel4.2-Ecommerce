/**
 * Created by sanzeeb on 1/7/2016.
 */

var productApp = angular.module('pagingApp', ['ui.bootstrap', 'autocomplete']);


productApp.controller('pagingController', ['$scope', '$http', '$window'
    , function ($scope, $http, $window) {


        // initialize variables
        //$scope.initPage = function () {
        //
        //    $scope.productInformation = [];
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
        //};

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



        $scope.loadProductDetails = function () {
            // console.log(permalink);
            $http({
                url: '/api/pro-details/' + $scope.permalink,
                method: "GET",
            }).success(function (data) {

                if (data.status_code == 200) {
                    $scope.comparableProductList.push(data);


                    $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex,$scope.compareIndex + 3);
                    $scope.dataLength = $scope.comparableProductList.length;

                    // set spec list for product compare
                    var item = data.data.productInformation.Specifications;

                    for(var i=0;i<item.length;i++)
                    {
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