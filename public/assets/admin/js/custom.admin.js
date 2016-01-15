var adminApp = angular.module('adminApp', ['ui.bootstrap', 'ngRateIt', 'ngSanitize', 'angular-confirm', 'textAngular', 'ngTagsInput', 'angularFileUpload']);

/*
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
 */

// only decimal number input validation
adminApp.directive('validNumber', function () {
    return {
        require: '?ngModel',
        link: function (scope, element, attrs, ngModelCtrl) {
            if (!ngModelCtrl) {
                return;
            }

            ngModelCtrl.$parsers.push(function (val) {
                if (angular.isUndefined(val)) {
                    var val = '';
                }

                var clean = val.replace(/[^-0-9\.]/g, '');
                var negativeCheck = clean.split('-');
                var decimalCheck = clean.split('.');
                if (!angular.isUndefined(negativeCheck[1])) {
                    negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                    clean = negativeCheck[0] + '-' + negativeCheck[1];
                    if (negativeCheck[0].length > 0) {
                        clean = negativeCheck[0];
                    }

                }

                if (!angular.isUndefined(decimalCheck[1])) {
                    decimalCheck[1] = decimalCheck[1].slice(0, 2);
                    clean = decimalCheck[0] + '.' + decimalCheck[1];
                }

                if (val !== clean) {
                    ngModelCtrl.$setViewValue(clean);
                    ngModelCtrl.$render();
                }
                return clean;
            });

            element.bind('keypress', function (event) {
                if (event.keyCode === 32) {
                    event.preventDefault();
                }
            });
        }
    };
});

adminApp.controller('AdminController', ['$scope', '$http', '$window', '$timeout', '$confirm', '$location', '$anchorScroll', 'FileUploader'
    , function ($scope, $http, $window, $timeout, $confirm, $location, $anchorScroll, FileUploader) {

        // uploader section //

        var uploader = $scope.uploader = new FileUploader({
            url: '/api/product/media-upload',
        });

        // FILTERS

        uploader.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            //  console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function (fileItem) {
            //   console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function (addedFileItems) {
            //   console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function (item) {
            //   console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function (fileItem, progress) {
            //   console.info('onProgressItem', fileItem, progress);
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

        // console.info('uploader', uploader);

        // End uploader section //


        // Initializing application

        $scope.initPage = function () {
            //   console.log($location.host());
            $scope.catId = '';
            $scope.currentCategoryName = '';
            $scope.tempCategoryList = [];
            $scope.alerts = [];
            $scope.selectedItem = '';
            $scope.ajaxData = '';

            $scope.tableTemporaryValue = {};
            $scope.alertHTML = '';
            $scope.tmpUrl = '';

            /// product fields initialize
            $scope.ProductAuthorName = 'Anonymous User';
            $scope.ProductList = [];
            $scope.ProductVendorId = '';
            $scope.ProductVendorType = 'Amazon';
            $scope.ProductId = '';
            $scope.selectedItem = '';
            $scope.Name = '';
            $scope.Permalink = '';
            $scope.htmlContent = '';
            $scope.Price = '';
            $scope.SalePrice = '';
            $scope.StoreId = '';
            $scope.AffiliateLink = '';
            $scope.PriceGrabberId = '';
            $scope.FreeShipping = '';
            $scope.CouponCode = '';
            $scope.PostStatus = 'Inactive';
            $scope.PageTitle = '';
            $scope.MetaDescription = '';
            $scope.productTags = '';
            $scope.ProductAvailability = '';

            //specification
            $scope.Specifications = [];
            $scope.isUpdateSpecShow = false;

            //review
            $scope.reviews = [{
                key: 'Average',
                value: 0,
                counter: ''
            }, {
                key: 'Amazon',
                value: 0,
                counter: 0
            }
            ];
            /*

             * */
            $scope.isUpdateReviewShow = false;
            $scope.externalReviewLink = '';
            $scope.ideaingReviewScore = 0;

            //Media Content
            $scope.mediaTitle = '';
            $scope.mediaTypes = [
                {"key": "img-link", "value": "Image Link"},
                {"key": "img-upload", "value": "Image Upload"},
                {"key": "video-link", "value": "Video Link"},
                {"key": "video-upload", "value": "Video Upload"}
            ];
            $scope.mediaLink = "";
            $scope.isMediaUploadable = true;
            $scope.isHeroItem = false;
            $scope.mediaList = [];

            // Pagination info
            $scope.limit = 50;
            $scope.page = 1;
            $scope.total = 0;

            // show category panel for add product
            $scope.hideCategoryPanel = false;

            //filter type setting
            $scope.filterTypes = [
                {"key": "user-filter", "value": "Filter By User"},
                {"key": "product-filter", "value": "Filter By Product"},
            ];
            $scope.selectedFilter = '';
            $scope.filterName = '';
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
                    $scope.outputStatus(data, 'No more subcategory available for the selected item');
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
                $scope.categoryName = '';
                $scope.extraInfo = '';
                $scope.resetCategory();
                //   console.log('in function: '+data.status_code);
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
                    $scope.currentCategoryName = $scope.categoryItems[i].category;

                }
            }
            $scope.getCategory();

        };


        // reset filter for product list view
        $scope.resetFilter = function () {
            $scope.initPage();
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

            if (keyWord.indexOf("ideas") > -1) {
                return keyWord;
            } else {
                return "category/" + keyWord;
            }


        };

        // Product Module //


        // initialize product add view
        $scope.loadAddProduct = function () {
            $scope.isCollapsed = false; // default false it false to show forced parmalink saviing mood.
            $scope.isCollapsedToggle = !$scope.isCollapsed;
        };
        $scope.addProduct = function () {
            $scope.closeAlert();
            $http({
                url: '/api/product/add-product',
                method: "POST",
                data: {}

            }).success(function (data) {
                if (data.status_code == 200) {

                    $scope.ProductId = data.data.id;
                    $scope.productUpdateInfo();

                    //   $scope.Permalink = $scope.desiredPermalink;
                } else {
                    // $scope.outputStatus(data, "Permalink is not available please enter new.");
                }

            });

        };

        // update product
        $scope.productUpdateInfo = function () {
            $http({
                url: '/api/product/update-product',
                method: 'POST',
                data: {
                    ProductId: $scope.ProductId,
                    ProductVendorId: $scope.ProductVendorId,
                    ProductVendorType: $scope.ProductVendorType,
                    ProductAuthorName: $scope.ProductAuthorName,
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
                    Review: $scope.reviews,
                    ExternalReviewLink: $scope.externalReviewLink,
                    IdeaingReviewScore: $scope.ideaingReviewScore
                }
            }).success(function (data) {
                //console.log(data);
                if (data.status_code == 200) {
                    $scope.outputStatus(data, "Product updated successfully");
                } else {
                    $scope.outputStatus(data, "Product information not updated");
                }
            });
        }

        $scope.updateProduct = function () {

            $scope.closeAlert();
            // if it's a new request then product should be insert first
            //   console.log($scope.ProductId);
            if ($scope.ProductId == '') {
                $scope.addProduct();
            } else {
                $scope.productUpdateInfo();
            }

            $scope.closeAlert();


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
                    ProductAuthorName: $scope.ProductAuthorName,
                    CategoryId: $scope.selectedItem,
                    ProductVendorId: $scope.ProductVendorId,
                    ProductVendorType: $scope.ProductVendorType,
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
                    Review: $scope.reviews,
                    ExternalReviewLink: $scope.externalReviewLink,
                    IdeaingReviewScore: $scope.ideaingReviewScore
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
                {
                    'key': $scope.reviewKey,
                    'value': $scope.reviewValue,
                    'link': $scope.reviewLink,
                    'counter': $scope.reviewCounter
                }
            );
            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.reviewLink = '';
            $scope.reviewCounter = 0;
            /*$scope.externalReviewLink = '';
             $scope.ideaingReviewScore = 0;*/
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
            $scope.reviewLink = $scope.reviews[index].link;
            $scope.reviewCounter = $scope.reviews[index].counter;
            $scope.isUpdateReviewShow = true;
            $scope.calculateAvg();

        }
        $scope.updateReviewFormField = function () {
            $scope.reviews[$scope.$index].key = $scope.reviewKey;
            $scope.reviews[$scope.$index].value = $scope.reviewValue;
            $scope.reviews[$scope.$index].link = $scope.reviewLink;
            $scope.reviews[$scope.$index].counter = $scope.reviewCounter;

            $scope.isUpdateReviewShow = false;

            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.reviewLink = '';
            $scope.reviewCounter = '';
            $scope.calculateAvg();
        }

        $scope.calculateAvg = function () {
            $scope.totalCount = 0;

            for (var i = 1; i < $scope.reviews.length; i++) {
                $scope.totalCount += $scope.reviews[i].value;
            }

            $scope.reviews[0].value = $scope.totalCount / ($scope.reviews.length - 1);

        }


        // view product list
        $scope.showAllProduct = function () {
            $http({
                url: '/api/product/get-product-list',
                method: 'POST',
                data: {
                    CategoryId: $scope.selectedItem,
                    ActiveItem: $scope.ActiveItem,
                    FilterType: $scope.selectedFilter,
                    FilterText: $scope.filterName,
                    // Pagination info
                    limit: $scope.limit,
                    page: $scope.page,
                    total: $scope.total,
                }

            }).success(function (data) {

                if (data.status_code == 200) {
                    $scope.ProductList = data.data.result;

                    $scope.limit = data.data.limit;
                    $scope.page = data.data.page;
                    $scope.total = data.data.total;

                } else {
                    $scope.outputStatus(data, "Product information not viewable");
                }

            });

        };

        // Load API data to html controls
        $scope.loadProductInfoFromApi = function (itemId) {
            $http({
                url: '/api/api-data/' + itemId,
                method: 'GET'
            }).success(function (data) {
                if (data.status_code == 200) {
                    $scope.Name = data.data.ApiTitle;
                    $scope.Price = data.data.ApiPrice;
                    $scope.SalePrice = data.data.ApiSalePrice;
                    $scope.mediaLink = $scope.mediaLinkTmp = data.data.ApiImageLink;
                    $scope.AffiliateLink = data.data.AffiliateLink;
                    $scope.ProductAvailability = data.data.ApiAvailable;

                    if ($scope.Specifications == null)
                        $scope.Specifications = [];

                    $scope.Specifications.push(
                        {'key': 'Manufacturer', 'value': data.data.ApiSpecification.Manufacturer}
                    );
                    $scope.Specifications.push(
                        {'key': 'Model', 'value': data.data.ApiSpecification.Model}
                    );
                    $scope.Specifications.push(
                        {'key': 'Part Number', 'value': data.data.ApiSpecification.PartNumber}
                    );
                    $scope.Specifications.push(
                        {'key': 'Color', 'value': data.data.ApiSpecification.Color}
                    );
                    $scope.Specifications.push(
                        {'key': 'Product Size', 'value': data.data.ApiSpecification.ProductSize}
                    );
                    $scope.Specifications.push(
                        {'key': 'Package Size', 'value': data.data.ApiSpecification.PackageSize}
                    );
                    $scope.Specifications.push(
                        {'key': 'Weight', 'value': data.data.ApiSpecification.Weight}
                    );
                    $scope.Specifications.push(
                        {'key': 'Features', 'value': data.data.ApiSpecification.Features.toString()}
                    );


                    $scope.spKey = '';
                    $scope.spVal = '';

                    $scope.outputStatus(data, "Product data successfully loaded from API");

                } else {
                    $scope.outputStatus(data, "Product information not viewable");
                }
            });

        };


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
                    $scope.ProductVendorId = data.data.product_vendor_id;
                    $scope.ProductVendorType = data.data.product_vendor_type;
                    $scope.Name = data.data.product_name;
                    $scope.Permalink = data.data.product_permalink;
                    $scope.htmlContent = data.data.product_description;
                    $scope.Price = data.data.price;
                    $scope.SalePrice = data.data.sale_price;
                    $scope.StoreId = data.data.store_id;
                    $scope.AffiliateLink = data.data.affiliate_link;
                    $scope.PriceGrabberId = data.data.price_grabber_master_id;
                    $scope.FreeShipping = data.data.free_shipping == 1 ? true : false;
                    $scope.CouponCode = data.data.coupon_code;
                    $scope.PostStatus = data.data.post_status;
                    $scope.PageTitle = data.data.page_title;
                    $scope.MetaDescription = data.data.meta_description;
                    $scope.productTags = data.data.similar_product_ids;
                    $scope.ProductAvailability = data.data.product_availability;
                    $scope.Specifications = data.data.specifications;
                    $scope.reviews = data.data.review;
                    $scope.externalReviewLink = data.data.review_ext_link;
                    $scope.ideaingReviewScore = data.data.ideaing_review_score;

                    // hide category in edit mood
                    $scope.hideCategoryPanel = true;

                    // load media in panel
                    $scope.getMedia();
                }
            });
        };

        //delete a product
        $scope.deleteProduct = function (id, redirect) {
            console.log(redirect);

            $http({
                url: '/api/product/delete-product',
                method: 'POST',
                data: {'ProductId': id}
            }).success(function (data) {
                $scope.outputStatus(data, "Product deleted !");

                if (redirect == true)
                    $window.location = '/admin/product-view';
                else
                    $scope.showAllProduct();
            });

        };

        //preview the product in detials page
        $scope.previewProduct = function (permalink) {
            $window.open('/pro-details/' + permalink, '_blank');
        };

        // Change the media type during add and edit of media content.
        $scope.mediaTypeChange = function () {
            // console.log($scope.selectedMediaType);

            if (($scope.selectedMediaType == 'img-link')) {
                $scope.isMediaUploadable = false;
                $scope.mediaLinkTmp = $scope.mediaLink;
                //   console.log($scope.isMediaUploadable);
            } else if (($scope.selectedMediaType == 'video-link')) {

                $scope.isMediaUploadable = false;
                $scope.mediaLinkTmp = $scope.mediaLink;
                //   console.log( $scope.isMediaUploadable);
            } else if (($scope.selectedMediaType == 'img-upload')) {

                $scope.isMediaUploadable = true;
                $scope.mediaLink = $scope.mediaLinkTmp;
                //  console.log( $scope.isMediaUploadable);
            } else if (($scope.selectedMediaType == 'video-upload')) {

                $scope.isMediaUploadable = true;
                $scope.mediaLink = $scope.mediaLinkTmp;
                // console.log( $scope.isMediaUploadable);
            }

        };

        // add medial content for a product
        $scope.addMediaInfo = function () {
            $http({
                url: '/api/product/add-media-info',
                method: 'POST',
                data: {
                    ProductId: $scope.ProductId,
                    MediaTitle: $scope.mediaTitle,
                    MediaType: $scope.selectedMediaType,
                    MediaLink: $scope.mediaLink,
                    IsHeroItem: $scope.isHeroItem
                }
            }).success(function (data) {
                //   console.log(data);

                if (data.status_code == 200) {
                    $scope.getMedia();
                    $scope.mediaTitle = $scope.selectedMediaType = $scope.mediaLink = $scope.isHeroItem = '';
                }

            })
        };

        // get medial content list for a single product
        $scope.getMedia = function () {
            $http({
                url: '/api/product/get-media/' + $scope.ProductId,
                method: 'GET',
            }).success(function (data) {
                //   console.log(data);

                if (data.status_code == 200) {
                    $scope.mediaList = data.data;
                }

            });
        };

        $scope.deleteMedia = function ($id) {
            $http({
                url: '/api/product/delete-media',
                method: 'POST',
                data: {'MediaId': $id}
            }).success(function (data) {
                //  console.log(data);

                if (data.status_code == 200) {
                    $scope.getMedia();
                }

            });
        };

        // Initialize variables and functions Globally.
        $scope.initPage();
        $scope.getCategory();
    }]);