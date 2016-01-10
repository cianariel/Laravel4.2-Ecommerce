/**
 * Created by sanzeeb on 1/7/2016.
 */

var productApp = angular.module('productApp', ['ui.bootstrap', 'ngSanitize', 'textAngular']);

productApp.directive('royalSlider', function() {
    var linker = function (scope, element, attrs) {
        scope.$watch('selectedAsset', function(){
            element.royalSlider({
                keyboardNavEnabled: true,
                autoScaleSlider: true,
                autoHeight: true
            });
        });
    };
    return {
        restrict: 'AEC',
        link: linker
    }
});

productApp.controller('productController', ['$scope','$window', '$http', '$location'
    , function ($scope,$window, $http, $confirm, $location) {


        $scope.initPage = function () {

            $scope.productInformation = [];
            $scope.relatedProducts = [];
            $scope.selfImages = [];

            $scope.urlParam = $window.urlParam;

            $scope.ProductName ='';
            $scope.Description='';

            $scope.tmp = "/assets/images/dummies/slider/PC220020-1024x683.jpg";


        };

        $scope.loadProductDetails = function (permalink) {
           // console.log(permalink);
            $http({
                url: '/api/pro-details/' + permalink,
                method: "GET",
            }).success(function (data) {
                // $scope.outputStatus(data, 'Category item updated successfully');
                console.log(data.data);

                if (data.status_code == 200) {
                    $scope.productInformation = data.data.productInformation;
                    $scope.relatedProducts = data.data.relatedProducts;
                    $scope.selfImages = data.data.selfImages;

                  //  alert("hi");

                 //   console.log("DataIn :"+$scope.selfImages.picture[0].link);
                }
            });

        };

        $scope.initPage();

    }]);