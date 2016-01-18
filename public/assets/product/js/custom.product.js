/**
 * Created by sanzeeb on 1/7/2016.
 */

var productApp = angular.module('productApp', ['ui.bootstrap','autocomplete']);


productApp.controller('productController', ['$scope', '$http', '$window'
    , function ($scope, $http, $window) {


        // initialize variables
        $scope.initPage = function () {

            $scope.productInformation = [];
            $scope.relatedProducts = [];
            $scope.selfImages = [];

            $scope.urlParam = $window.urlParam;

            $scope.ProductName ='';
            $scope.Description='';

            $scope.tmp = "/assets/images/dummies/slider/PC220020-1024x683.jpg";

            //product compare
            $scope.selectedProduct = '';
            $scope.comparableProductList =[];
            $scope.suggestedItems=[];
            $scope.suggestedItemsWithId=[];

        };

        // search comparable it by name
        $scope.searchProductByName = function (query) {

           // console.log(permalink);

            //min string length to call ajax
            if(query.length < 3)
                return;

            $scope.suggestedItems =[];
            $scope.suggestedItemsWithId=[];

            $http({
                url: '/api/product/product-find/' + query,
                method: "GET",

            }).success(function (data) {
                for(var i = 0;i<data.length;i++)
                {
                    $scope.suggestedItems.push(data[i]['name']);
                    $scope.suggestedItemsWithId.push(data);

                 //   $scope.suggestedItems.push(data);

                   // console.log("inside : " + data[i]);
                }
            });

        };

        $scope.selectedIdem = function(query)
        {
            console.log($scope.comparableProductList);
            $http({
                url: '/api/product/get-by-name/' + query,
                method: "GET",

            }).success(function (data) {
                $scope.comparableProductList.push(data);
                $scope.selectedProduct = '';
            });

        };

        $scope.deleteSelectedItem = function(index){
             $scope.comparableProductList.splice(index, 1);
        };
           /*
         <div ng-repeat="item in items" ng-if="$index >= myIndex">
            {{item.Name}}
         </div>
           */



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

                 //   console.log("DataIn :"+$scope.selfImages.picture[0].link);
                }
            });

        };

        $scope.initPage();

    }]);