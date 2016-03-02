/**
 * Created by sanzeeb on 1/7/2016.
 */

var productApp = angular.module('productApp', ['ui.bootstrap', 'autocomplete']);


productApp.controller('productController', ['$scope', '$http', '$window'
    , function ($scope, $http, $window) {


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
            $scope.specList=[];

            $scope.compareIndex = 0;
            $scope.dataLength = 0;//$scope.comparableProductList.length;
            $scope.temporaryViewList=[];


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
        }


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

                $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex,$scope.compareIndex + 3);
                $scope.dataLength = $scope.comparableProductList.length;
                $scope.selectedProduct = '';

            });

        };

        $scope.deleteSelectedItem = function (index) {
            $scope.comparableProductList.splice(index, 1);

            $scope.dataLength = $scope.comparableProductList.length;
            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex,$scope.compareIndex + 3);

        };

        $scope.traverseForward = function () {

            if ($scope.compareIndex <= $scope.dataLength - 1)
                $scope.compareIndex++;

            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex,$scope.compareIndex + 3);

        };

        $scope.traverseBackward = function () {

            if ($scope.compareIndex >= 1)
                $scope.compareIndex--;


            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex,$scope.compareIndex + 3);

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

        // Email subscription //


        // Custom function call

      //  angular.bootstrap(document.getElementById("App-1"),['productApp']);
        $scope.initPage();


    }]);