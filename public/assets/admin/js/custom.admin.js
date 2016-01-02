var adminApp = angular.module('adminApp', ['ui.bootstrap', 'ngSanitize', 'angular-confirm', 'textAngular', 'ngTagsInput']);


adminApp.directive('loading', ['$http', function ($http) {
    return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
            scope.isLoading = function () {
                return $http.pendingRequests.length > 0;
            };

            scope.$watch(scope.isLoading, function (v) {
                if (v) {
                    elm.show();
                } else {
                    elm.hide();
                }
            });
        }
    };

}]);

adminApp.directive('dropzone',function(){
    return function (scope, element, attrs) {
        var config, dropzone;

        // it should be false or will throw a uncaught js error "Dropzone already attached"
        Dropzone.autoDiscover = false;

        config = scope[attrs.dropzone];

        // create a Dropzone for the element with the given options
        dropzone = new Dropzone(element[0], config.options);


        // bind the given event handlers
        angular.forEach(config.eventHandlers, function (handler, event) {
            dropzone.on(event, handler);
        });
    };
});

adminApp.directive('fileModel', ['$parse', function($parse){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                })
            })
        }
    }
}]);

adminApp.service('multipartForm', ['$http', function($http){
    this.post = function(uploadUrl, data){
        var fd = new FormData();
        for(var key in data)
            fd.append(key, data[key]);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.indentity,
            headers: { 'Content-Type': undefined }
        });
    }
}]);

adminApp.controller('AdminController', ['$scope', '$http', '$confirm', '$location', '$anchorScroll','multipartForm'
    , function ($scope, $http, $confirm, $location, $anchorScroll,multipartForm) {


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

            $scope.tmpUrl = '';

            /// product fields initialize

            $scope.ProductList = [],
                $scope.ProductId = '',
                $scope.selectedItem = '',
                $scope.Name = '',
                $scope.Permalink = '',
                $scope.htmlContent = '',
                $scope.Price = '',
                $scope.SalePrice = '',
                $scope.StoreId = '',
                $scope.AffiliateLink = '',
                $scope.PriceGrabberId = '',
                $scope.FreeShipping = '',
                $scope.CouponCode = '',
                $scope.PostStatus = 'Inactive',
                $scope.PageTitle = '',
                $scope.MetaDescription = '',
                $scope.productTags = '',
                $scope.ProductAvailability = '',

                //specification
                $scope.Specifications = [],
                $scope.isUpdateSpecShow = false,

                //review
                $scope.reviews = [{
                    key: 'Average',
                    value: 0
                }],
                $scope.isUpdateReviewShow = false,

                // Pagination info
                $scope.limit = 12,
                $scope.page = 1,
                $scope.total = 0

            // show category panel for add product
            $scope.hideCategoryPanel = false;


        };

        $scope.productMedia = {};
        $scope.addMedia = function(){
            var uploadUrl = '/api/product/media-upload';
            multipartForm.post(uploadUrl, $scope.productMedia);
        }

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
                $scope.categoryName = '';
                $scope.extraInfo = '';
                $scope.resetCategory();
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

        $scope.deleteCategory = function (idx) {
            //  console.log("Saving contact");
            console.log($scope.categoryItems[idx]);
            $scope.closeAlert();

            $http({
                url: '/api/category/delete-category',
                method: "POST",
                data: {
                    CategoryId: $scope.categoryItems[idx].id,
                },
            }).success(function (data) {
                $scope.outputStatus(data, "Category deleted successfully");

                if (data.status_code == 200) {

                    $scope.categoryItems.splice(idx, 1);

                }

            });
        };


        $scope.cancelCategory = function () {
            $scope.tableTemporaryValue = {};
            // $scope.closeAlert();

        };

        $scope.buildURL = function (keyWord) {

            if (keyWord.indexOf("blog") > -1) {
                return keyWord;
            } else {
                return "category/" + keyWord;
            }


        };

        // Product Module //


        // initialize product add view
        $scope.loadAddProduct = function () {
            $scope.isCollapsed = true; // default false it false to show forced parmalink saviing mood.
            $scope.isCollapsedToggle = !$scope.isCollapsed;
        };
        $scope.addProduct = function () {
            $scope.closeAlert();
            console.log($scope.desiredPermalink);
            if (($scope.desiredPermalink == '') || ( typeof  $scope.desiredPermalink == 'undefined')) {
                $scope.addAlert('danger', 'Permalink can not be blank !');
                return false;
            }

            $http({
                //       url: '/api/product/check-permalink/' + $scope.desiredPermalink,
                url: '/api/product/add-product',
                method: "POST",
                data: {
                    Permalink: $scope.desiredPermalink,
                }

            }).success(function (data) {
                if (data.status_code == 200) {

                    $scope.ProductId = data.data.id;
                    $scope.outputStatus(data, "Product created successfully");
                    $scope.isCollapsed = true;
                    $scope.isCollapsedToggle = !$scope.isCollapsed;
                    $scope.Permalink = $scope.desiredPermalink;
                } else if (data.status_code == 410) {
                    $scope.outputStatus(data, "Permalink is not available please enter new.");
                }

            });

        };

        // update product
        $scope.updateProduct = function () {
            // console.log('product id :', $scope.ProductId);
            $scope.closeAlert();

            $http({
                url: '/api/product/update-product',
                method: 'POST',
                data: {
                    ProductId: $scope.ProductId,
                    CategoryId: $scope.selectedItem,
                    Name: $scope.Name,
                    Permalink: $scope.Permalink,
                    Description: $scope.htmlContent,
                    Price: $scope.Price,
                    SalePrice: $scope.SalePrice,
                    StoreId: $scope.StoreId,
                    AffiliateLink: $scope.AffiliateLink,
                    PriceGrabberId: $scope.PriceGrabberId,
                    FreeShipping: $scope.FreeShipping,
                    CouponCode: $scope.CouponCode,
                    PostStatus: $scope.PostStatus,
                    PageTitle: $scope.PageTitle,
                    MetaDescription: $scope.MetaDescription,
                    SimilarProductIds: $scope.productTags,
                    ProductAvailability: $scope.ProductAvailability,
                    Specifications: $scope.Specifications,
                    Review: $scope.reviews
                }

            }).success(function (data) {
                //console.log(data);
                if (data.status_code == 200) {
                    $scope.outputStatus(data, "Product updated successfully");
                } else {
                    $scope.outputStatus(data, "Product information not updated");
                }


            });
            return false;
        };

        $scope.changeProductActivation = function () {
            $scope.closeAlert();

            $scope.PostStatus = ($scope.PostStatus == "Active") ? "Inactive" : "Active";

            $http({
                url: '/api/product/publish-product',
                method: 'POST',
                data: {
                    ProductId: $scope.ProductId,
                    CategoryId: $scope.selectedItem,
                    Name: $scope.Name,
                    Permalink: $scope.Permalink,
                    Description: $scope.htmlContent,
                    Price: $scope.Price,
                    SalePrice: $scope.SalePrice,
                    StoreId: $scope.StoreId,
                    AffiliateLink: $scope.AffiliateLink,
                    PriceGrabberId: $scope.PriceGrabberId,
                    FreeShipping: $scope.FreeShipping,
                    CouponCode: $scope.CouponCode,
                    PostStatus: $scope.PostStatus,
                    PageTitle: $scope.PageTitle,
                    MetaDescription: $scope.MetaDescription,
                    SimilarProductIds: $scope.productTags,
                    ProductAvailability: $scope.ProductAvailability,
                    Specifications: $scope.Specifications,
                    Review: $scope.reviews
                }

            }).success(function (data) {
                //console.log(data);
                if (data.status_code == 200) {
                    $scope.outputStatus(data, "Product updated successfully");
                    $scope.loadProductData($scope.ProductId);
                } else {
                    $scope.outputStatus(data, "Product information not updated");
                    $scope.PostStatus = ($scope.PostStatus == "Active") ? "Inactive" : "Active";


                }
            });
            return false;
        }

        // Search product id for related product from Admin
        $scope.productTags = [];
        $scope.searchProductByName = function (query) {

            return $http.get('/api/product/product-find/' + query);
        };


        // add dynamic files in specifications
        $scope.addSpecFormField = function () {
            $scope.Specifications.push(
                {'key': $scope.spKey, 'value': $scope.spVal}
            );
            $scope.spKey = '';
            $scope.spVal = '';
        }

        $scope.deleteSpecFormField = function (index) {
            $scope.Specifications.splice(index, 1);
        }

        $scope.editSpecFormField = function (index) {
            $scope.$index = index;
            $scope.spKey = $scope.Specifications[index].key;
            $scope.spVal = $scope.Specifications[index].value;
            $scope.isUpdateSpecShow = true;

        }
        $scope.updateSpecFormField = function () {
            $scope.Specifications[$scope.$index].key = $scope.spKey;
            $scope.Specifications[$scope.$index].value = $scope.spVal;
            $scope.isUpdateSpecShow = false;

            $scope.spKey = '';
            $scope.spVal = '';
        }


        // add dynamic fields in review
        $scope.addReviewFormField = function () {
            $scope.reviews.push(
                {'key': $scope.reviewKey, 'value': $scope.reviewValue}
            );
            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.calculateAvg();

        }

        $scope.deleteReviewFormField = function (index) {
            $scope.reviews.splice(index, 1);
            $scope.calculateAvg();
        }

        $scope.editReviewFormField = function (index) {
            $scope.$index = index;
            $scope.reviewKey = $scope.reviews[index].key;
            $scope.reviewValue = $scope.reviews[index].value;
            $scope.isUpdateReviewShow = true;
            $scope.calculateAvg();

        }
        $scope.updateReviewFormField = function () {
            $scope.reviews[$scope.$index].key = $scope.reviewKey;
            $scope.reviews[$scope.$index].value = $scope.reviewValue;
            $scope.isUpdateReviewShow = false;

            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.calculateAvg();
        }

        $scope.calculateAvg = function () {
            $scope.totalCount = 0;

            for (var i = 1; i < $scope.reviews.length; i++) {
                $scope.totalCount += $scope.reviews[i].value;
            }

            $scope.reviews[0].value = Math.round($scope.totalCount / ($scope.reviews.length - 1));

        }


        // add dynamic fields for media content
        $scope.dropzoneConfig = {

            'options': { // passed into the Dropzone constructor
                'url': '/api/product/media-upload/',
                'maxFiles':1,
            },
            init: function() {
          dz = $scope.this;
                dz.on("maxfilesexceeded", function(file) {
                    dz.removeAllFiles();
                    dz.addFile(file);
                });
            },
            'eventHandlers': {
                'sending': function (file, xhr, formData) {
                    console.log('sending file data');
                },
                'success': function (file, response) {
                    console.log('file sending success');
                }
            }
        };

       /*


        $scope.addReviewFormField = function () {
            $scope.reviews.push(
                {'key': $scope.reviewKey, 'value': $scope.reviewValue}
            );
            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.calculateAvg();

        }

        $scope.deleteReviewFormField = function (index) {
            $scope.reviews.splice(index, 1);
            $scope.calculateAvg();
        }

        $scope.editReviewFormField = function (index) {
            $scope.$index = index;
            $scope.reviewKey = $scope.reviews[index].key;
            $scope.reviewValue = $scope.reviews[index].value;
            $scope.isUpdateReviewShow = true;
            $scope.calculateAvg();

        }
        $scope.updateReviewFormField = function () {
            $scope.reviews[$scope.$index].key = $scope.reviewKey;
            $scope.reviews[$scope.$index].value = $scope.reviewValue;
            $scope.isUpdateReviewShow = false;

            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.calculateAvg();
        }
*/


        // view product list
        $scope.showAllProduct = function () {
            $http({
                url: '/api/product/get-product-list',
                method: 'POST',
                data: {
                    CategoryId: $scope.selectedItem,
                    ActiveItem: $scope.ActiveItem,
                    // Pagination info
                    limit: $scope.limit,
                    page: $scope.page,
                    total: $scope.total,
                }

            }).success(function (data) {
                //console.log(data);
                if (data.status_code == 200) {
                    $scope.ProductList = data.data.result;

                    $scope.limit = data.data.limit;
                    $scope.page = data.data.page;
                    $scope.total = data.data.total;

                    console.log($scope.limit, $scope.page, $scope.total);


                    //  $scope.outputStatus(data, "SuccessfuProduct updated successfully");

                } else {
                    $scope.outputStatus(data, "Product information not viewable");
                }

            });

        }


        //todo update the loadProductData after implementing media uploading

        $scope.loadProductData = function (id) {
            //console.log("ID IS:"+id);
            $http({
                url: '/api/product/get-product/' + id,
                method: 'GET'
            }).success(function (data) {
                if (data.status_code == 200) {
                    //  console.log(data['product_name']);

                    // set data in input fields
                    $scope.ProductId = data.data.id;
                    $scope.selectedItem = data.data.product_category_id;
                    $scope.Name = data.data.product_name;
                    $scope.Permalink = data.data.product_permalink;
                    $scope.htmlContent = data.data.product_description;
                    $scope.Price = data.data.price;
                    $scope.SalePrice = data.data.sale_price;
                    $scope.StoreId = data.data.store_id;
                    $scope.AffiliateLink = data.data.affiliate_link;
                    $scope.PriceGrabberId = data.data.price_grabber_master_id;
                    $scope.FreeShipping = data.data.free_shipping;
                    $scope.CouponCode = data.data.coupon_code;
                    $scope.PostStatus = data.data.post_status;
                    $scope.PageTitle = data.data.page_title;
                    $scope.MetaDescription = data.data.meta_description;
                    $scope.productTags = data.data.similar_product_ids;
                    $scope.ProductAvailability = data.data.product_availability;
                    $scope.Specifications = data.data.specifications;
                    $scope.reviews = data.data.review;

                    //show hide product add element
                    $scope.isCollapsed = true; // default true.
                    $scope.isCollapsedToggle = !$scope.isCollapsed;

                    // hide category in edit mood
                    $scope.hideCategoryPanel = true;

                }

            });

        }


        // Initialize variables and functions Globally.
        $scope.initPage();
        $scope.getCategory();
    }]);