var adminApp = angular.module('adminApp', ['ui.bootstrap', 'ngSanitize']);


adminApp.controller('AdminController', ['$scope', '$http', '$location', '$anchorScroll'
    , function ($scope, $http, $location, $anchorScroll) {


        // Initializing application

        $scope.initPage = function () {
            //   console.log($location.host());
            $scope.catId = '';
            $scope.tempCategoryList = [];
            $scope.alerts = [];
            $scope.selectedItem = '';
            $scope.ajaxData = '';

            $scope.tableTemporaryValue = {};
            $scope.alertHTML = '';


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

        // Reset the category when reset button clicked.
        $scope.resetCategory = function () {
            $scope.catId = '';
            $scope.tempCategoryList = [];
            $scope.closeAlert();
            $scope.getCategory();
        };

        // Get category item as per provided category id is available
        // or return root category items.
        $scope.getCategory = function () {

            $scope.closeAlert();

            $http({
                url: '/api/category/show-category-items/' + $scope.catId,
                method: "GET",

            }).success(function (data, status) {

                if (data['data'].length > 0) {
                    $scope.categoryItems = data['data'];
                } else {
                    $scope.tempCategoryList.pop();

                    $scope.outputStatus(data, 'No more subcategory available');
                }

            });

            return false;
        };


        // Add a category item.
        $scope.addCategory = function () {

            $scope.closeAlert();

            $http({
                url: '/api/category/add-category',
                method: "POST",
                data: {
                    ParentId: $scope.selectedItem,
                    CategoryName: $scope.categoryName,
                    ExtraInfo: $scope.extraInfo
                },
            }).success(function (data) {
                $scope.outputStatus(data, 'Category item added successfully');
            });

            return false;
        };

        // Get subcategory items when a category item is selected and show status.
        $scope.getSubCategory = function () {

            $scope.catId = $scope.selectedItem;
            for (i = 0; i < $scope.categoryItems.length; i++) {
                if ($scope.categoryItems[i].id == $scope.catId) {

                    $scope.tempCategoryList.push($scope.categoryItems[i].category);
                }
            }

            $scope.getCategory();

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

        // inline category editing

        // gets the template to ng-include for a table row / item
        $scope.getTemplate = function (category) {
            if (category.id === $scope.tableTemporaryValue.id)
                return 'edit';
            else
                return 'display';
        };

        $scope.editCategory = function (category) {
            $scope.closeAlert();
            $scope.tableTemporaryValue = angular.copy(category);
        };

        $scope.updateCategory = function (idx) {
            console.log("Saving contact");
            console.log($scope.categoryItems[idx]);
            $scope.closeAlert();

            $http({
                url: '/api/category/update-category',
                method: "POST",
                data: {
                    CategoryId: $scope.categoryItems[idx].id,
                    CategoryName: $scope.tableTemporaryValue.category,// $scope.categoryItems[idx].category,
                    ExtraInfo: $scope.tableTemporaryValue.info //$scope.categoryItems[idx].info
                },
            }).success(function (data) {
                $scope.outputStatus(data, 'Category item updated successfully');

                if (data.status_code == 200) {
                    $scope.categoryItems[idx] = angular.copy($scope.tableTemporaryValue);
                    $scope.cancelCategory();
                }
            });

        };

        $scope.deleteCategory=function(idx){
          //  console.log("Saving contact");
            console.log($scope.categoryItems[idx]);
            $scope.closeAlert();

            $http({
                url: '/api/category/delete-category',
                method: "POST",
                data: {
                    CategoryId: $scope.categoryItems[idx].id
                },
            }).success(function (data) {
                $scope.outputStatus(data, data.data.message);

                if (data.status_code == 200) {

                    $scope.categoryItems.splice(idx,1);
                    //ds = angular.copy($scope.tableTemporaryValue);
                   // $scope.cancelCategory();
                }
            });
        };


        $scope.cancelCategory = function () {
            $scope.tableTemporaryValue = {};
           // $scope.closeAlert();

        };


        // Initialize variables and functions.
        $scope.initPage();
        $scope.getCategory();

    }]);