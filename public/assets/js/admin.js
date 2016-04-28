var adminApp = angular.module('adminApp', ['ui.bootstrap', 'ngRateIt', 'ngSanitize', 'angular-confirm', 'textAngular', 'ngTagsInput', 'angularFileUpload']);

adminApp.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

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

// category tree view
adminApp.directive('uiTree', function () {
    return {
        template: '<ul class="uiTree"><ui-tree-node ng-repeat="node in tree"></ui-tree-node></ul>',
        replace: true,
        transclude: true,
        restrict: 'E',
        scope: {
            tree: '=ngModel',
            attrNodeId: "@",
            loadFn: '=',
            expandTo: '=',
            selectedId: '='
        },
        controller: function ($scope, $element, $attrs) {
            $scope.loadFnName = $attrs.loadFn;
            // this seems like an egregious hack, but it is necessary for recursively-generated
            // trees to have access to the loader function
            if ($scope.$parent.loadFn)
                $scope.loadFn = $scope.$parent.loadFn;

            // TODO expandTo shouldn't be two-way, currently we're copying it
            if ($scope.expandTo && $scope.expandTo.length) {
                $scope.expansionNodes = angular.copy($scope.expandTo);
                var arrExpandTo = $scope.expansionNodes.split(",");
                $scope.nextExpandTo = arrExpandTo.shift();
                $scope.expansionNodes = arrExpandTo.join(",");
            }
        }
    };
}).directive('uiTreeNode', ['$compile', '$timeout', function ($compile, $timeout) {
    return {
        restrict: 'E',
        replace: true,
        template: '<li>' +
        '<div class="node" data-node-id="{{ nodeId() }}">' +
        '<a class="icon" ng-click="toggleNode(nodeId())""></a>' +
        '<a ng-hide="selectedId" ng-href="#/assets/{{ nodeId() }}">{{ node.category }}</a>' +
        '<span ng-show="selectedId" ng-class="css()" ng-click="setSelected(node)">' +
        '{{ node.category }}</span>' +
        '</div>' +
        '</li>',
        link: function (scope, elm, attrs) {
            scope.nodeId = function (node) {
                var localNode = node || scope.node;
                return localNode[scope.attrNodeId];
            };
            scope.toggleNode = function (nodeId) {
                var isVisible = elm.children(".uiTree:visible").length > 0;
                var childrenTree = elm.children(".uiTree");
                if (isVisible) {
                    scope.$emit('nodeCollapsed', nodeId);
                } else if (nodeId) {
                    scope.$emit('nodeExpanded', nodeId);
                }
                if (!isVisible && scope.loadFn && childrenTree.length === 0) {
                    // load the children asynchronously
                    var callback = function (arrChildren) {
                        scope.node.children = arrChildren;
                        scope.appendChildren();
                        elm.find("a.icon i").show();
                        elm.find("a.icon img").remove();
                        scope.toggleNode(); // show it
                    };
                    var promiseOrNodes = scope.loadFn(nodeId, callback);
                    if (promiseOrNodes && promiseOrNodes.then) {
                        promiseOrNodes.then(callback);
                    } else {
                        $timeout(function () {
                            callback(promiseOrNodes);
                        }, 0);
                    }
                    elm.find("a.icon i").hide();
                    var imgUrl = "http://www.efsa.europa.eu/efsa_rep/repository/images/ajax-loader.gif";
                    elm.find("a.icon").append('<img src="' + imgUrl + '" width="18" height="18">');
                } else {
                    childrenTree.toggle(!isVisible);
                    elm.find("a.icon i").toggleClass("glyphicon glyphicon-chevron-right");
                    elm.find("a.icon i").toggleClass("glyphicon glyphicon-chevron-down");
                }
            };

            scope.appendChildren = function () {
                // Add children by $compiling and doing a new ui-tree directive
                // We need the load-fn attribute in there if it has been provided
                var childrenHtml = '<ui-tree ng-model="node.children" attr-node-id="' +
                    scope.attrNodeId + '"';
                if (scope.loadFn) {
                    childrenHtml += ' load-fn="' + scope.loadFnName + '"';
                }
                // pass along all the variables
                if (scope.expansionNodes) {
                    childrenHtml += ' expand-to="expansionNodes"';
                }
                if (scope.selectedId) {
                    childrenHtml += ' selected-id="selectedId"';
                }
                childrenHtml += ' style="display: none"></ui-tree>';
                return elm.append($compile(childrenHtml)(scope));
            };

            scope.css = function () {
                return {
                    nodeLabel: true,
                    selected: scope.selectedId && scope.nodeId() === scope.selectedId
                };
            };
            // emit an event up the scope.  Then, from the scope above this tree, a "selectNode"
            // event is expected to be broadcasted downwards to each node in the tree.
            // broadcast "selectNode" from outside of the directive scope.
            scope.setSelected = function (node) {
                scope.$emit("nodeSelected", node);
            };
            scope.$on("selectNode", function (event, node) {
                scope.selectedId = scope.nodeId(node);
            });

            if (scope.node.hasChildren) {
                elm.find("a.icon").append('<i class="glyphicon glyphicon-chevron-right"></i>');
            }

            if (scope.nextExpandTo && scope.nodeId() == parseInt(scope.nextExpandTo, 10)) {
                scope.toggleNode(scope.nodeId());
            }
        }
    };
}]);

adminApp.controller('AdminController', ['$scope', '$http', '$window', '$timeout', '$confirm', '$location', '$anchorScroll', 'FileUploader'
    , function ($scope, $http, $window, $timeout, $confirm, $location, $anchorScroll, FileUploader) {

        // uploader section //

        var uploader = $scope.uploader = new FileUploader({
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
        // End uploader section //


        // Initializing application

        $scope.initPage = function () {
            //   console.log($location.host());
            $scope.catId = '';
            $scope.CategoryId = '';
            $scope.currentCategoryName = '';
            $scope.tempCategoryList = [];

            //category tree view
            $scope.assets = [];
            $scope.selected = {};
            $scope.hierarchy = "";
            $scope.tmp = [];

            $scope.categoryHierarchy = "";

            // show for page
            $scope.showForList = [
                "Homepage", "Shop Landing", "Shop Category", "Room Landing"
            ];
            $scope.ShowFor = '';

            $scope.alerts = [];
            $scope.selectedItem = '';
            $scope.ajaxData = '';

            $scope.tableTemporaryValue = {};
            $scope.alertHTML = '';
            $scope.tmpUrl = '';

            /// product fields initialize
            $scope.ProductAuthorName = ($scope.ProductAuthorName != '')?$scope.ProductAuthorName :'Anonymous User';
            $scope.ProductList = [];
            $scope.ProductVendorId = '';
            $scope.ProductVendorType = 'Amazon';
            $scope.ProductId = '';

            $scope.Name = '';
            $scope.Permalink = '';
            $scope.htmlContent = '<div><br/><br/><br/>1. Describe what the product is<br/><br/></div><div>2. How does it solve one\'s problem<br/><br/></div><div>3. Why is it unique<br/><br/></div><div>4. Mention how the reviewers (Amazon users or CNET or another source) said about it.<br/><br/></div><div>5. List 3 bullet points on its key features in your own words</div>';
            $scope.Price = '';
            $scope.SalePrice = '';
            //    $scope.StoreId = '';
            $scope.AffiliateLink = '';
            $scope.PriceGrabberId = '';
            $scope.FreeShipping = '';
            $scope.CouponCode = '';
            $scope.PostStatus = 'Inactive';
            $scope.PageTitle = '';
            $scope.MetaDescription = '';
            $scope.productTags = '';
            //$scope.ProductAvailability = '';

            //specification
            $scope.Specifications = [];
            $scope.Specifications = [];
            $scope.isUpdateSpecShow = false;

            //review
            $scope.readOnlyReviewCounter = true;
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


            $scope.isUpdateReviewShow = false;
            $scope.externalReviewLink = '';
            $scope.ideaingReviewScore = 0;

            //Media Content
            $scope.mediaTitle = '';
            $scope.mediaTypes = [
                {"key": "img-link", "value": "Image Link"},
                {"key": "img-upload", "value": "Image Upload"},
                {"key": "video-link", "value": "Video Link"},
                {"key": "video-youtube-link", "value": "Youtube Link"},
                {"key": "video-vimeo-link", "value": "Vimeo Link"},
                {"key": "video-upload", "value": "Video Upload"}
            ];
            $scope.mediaLink = "";
            $scope.isMediaUploadable = true;

            $scope.isHeroItem = true;
            $scope.isMainItem = false;
            $scope.isMediaEdit = false;

            $scope.mediaList = [];

            // Pagination info
            $scope.limit = 50;
            $scope.page = 1;
            $scope.total = 0;

            // show category panel for add product
            $scope.hideCategoryPanel = false;

            //filter type setting
            $scope.filterTypes = [
                {"key": "user-filter", "value": "Search by User ..."},
                {"key": "product-filter", "value": "Search by Product ..."},
            ];
            $scope.selectedFilter = '';
            $scope.filterName = '';

            //product compare
            $scope.comparableProductList = [];

            // Tag module
            $scope.TagName = '';
            $scope.TagDescription = '';
            $scope.AllTags = [];

            $scope.selectedTagId = '';

            $scope.Tags = [];

            // product filter with Tag
            $scope.WithTags = false;

            // Store Module
            $scope.StoreId = '';
            $scope.StoreIdentifier = '';
            $scope.StoreName = '';
            $scope.StoreStatus = 'Active';
            $scope.StoreDescription = '';
            //$scope.mediaLink  has initialized above for uploading product

            $scope.storeList = [];

            // User
            $scope.userListPageLimit = 30;
            $scope.userList = [];
            $scope.SelectedUserFilter = '';
            $scope.FilterUserItem = '';
            $scope.userFilterTypes = [
                {"key": "user-name-filter", "value": "Search by Name ..."},
                {"key": "user-email-filter", "value": "Search by Email ..."},
            ];
            $scope.userId = '';
            $scope.FullName = '';
            $scope.Password = null;
            $scope.Email = null;

            $scope.roleCollection = [];
            $scope.userRoles = [];

            $scope.userStatusList = [
                {"key": "Active", "value": "Active"},
                {"key": "Inactive", "value": "Inactive"},
            ];

            $scope.UserStatus = 'Active';

            $scope.IsBlogUser = false;

        };

        // User management //

        $scope.toggleSelection = function toggleSelection(role) {
            var idx = $scope.userRoles.indexOf(role);

            // is currently selected
            if (idx > -1) {
                $scope.userRoles.splice(idx, 1);
            }

            // is newly selected
            else {
                $scope.userRoles.push(role);
            }
        };

        $scope.getUserInfoById = function (id) {
            $http({
                url: '/api/user/get-user/' + id,
                method: "GET",

            }).success(function (data) {
                console.log(data);
                $scope.userId = data.data.id;
                $scope.FullName = data.data.name;
                $scope.Password = null;
                $scope.Email = data.data.email;

                $scope.roleCollection = data.data.RoleCollection;
                $scope.userRoles = data.data.Roles;

                $scope.UserStatus = data.data.status == 'Active' ? 'Active' : 'Inactive';

                $scope.IsBlogUser = data.data.is_blog_user == 'true'? true:false;

                //  $scope.outputStatus(data, 'User added successfully');
                //  $window.location = '/admin/user-list';
            });
        };

        //update user information
        $scope.updateUser = function () {
            $scope.closeAlert();

            $http({
                url: '/api/change-profile',
                method: "POST",
                data: {
                    FullName: $scope.FullName == '' ? null : $scope.FullName,
                    Email: $scope.Email,
                    Password: $scope.Password == '' ? null : $scope.Password,
                    UserRoles: $scope.userRoles,
                    UserStatus: $scope.UserStatus,
                    IsBlogUser: ($scope.IsBlogUser == true)? 'true':'false'
                }
            }).success(function (data) {
                // console.log(data);
                $scope.outputStatus(data, 'User information updated successfully');

                $scope.Password = '';
                $window.location = '/admin/user-list';
            });
        };

        $scope.addUser = function () {
            $scope.closeAlert();

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
                console.log(data);
                $scope.outputStatus(data, 'User added successfully');
                // $window.location = '/admin/user-list';
                $scope.FullName = '';
                $scope.Email = '';
                $scope.Password = '';
            });
        };

        $scope.getUserList = function () {

            // todo - test init .remove after test
          //  console.log('sdf');
            $scope.limit = $scope.userListPageLimit;

            $http({
                url: '/api/user/user-list',
                method: "POST",
                data: {
                    // Pagination info - Reusing from the product pagination
                    limit: $scope.limit,
                    page: $scope.page,
                    total: $scope.total,
                    FilterItem: $scope.SelectedUserFilter,
                    FilterValue: $scope.FilterUserItem
                }
            }).success(function (data) {
             //   console.log(data);
                $scope.limit = data.data.limit;
                $scope.page = data.data.page;
                $scope.total = data.data.count;
                $scope.userList = data.data.result;
            });
        };

        $scope.getSubscribersList = function () {

            // todo - test init .remove after test
            //  console.log('sdf');
            $scope.limit = $scope.userListPageLimit;

            $http({
                url: '/api/user/subscriber-list',
                method: "POST",
                data: {
                    // Pagination info - Reusing from the product pagination
                    limit: $scope.limit,
                    page: $scope.page,
                    total: $scope.total,
                }
            }).success(function (data) {
                //   console.log(data);
                $scope.limit = data.data.limit;
                $scope.page = data.data.page;
                $scope.total = data.data.count;
                $scope.subscriberList = data.data.result;
            });
        };

        $scope.logoutUser = function () {
           // var WpLogoutURL = 'https://ideaing.com/ideas/api?call=logout';
            var WpLogoutURL = '/ideas/api?call=logout';

            $http({
                url: WpLogoutURL,
                method: "GET"

            }).success(function (data) {
                window.location = '/api/logout';
            }).error(function(data) {
                window.location = '/api/logout';
            });
        }

        //// Store ///

        $scope.updateStore = function () {
            $scope.closeAlert();
            // console.log($scope.mediaLink, $scope.StoreDescription, $scope.StoreIdentifier);
            $http({
                url: '/api/store/update-store',
                method: "POST",
                data: {
                    StoreId: $scope.StoreId,
                    StoreIdentifier: $scope.StoreIdentifier,
                    StoreName: $scope.StoreName,
                    StoreStatus: $scope.StoreStatus,
                    StoreDescription: $scope.StoreDescription,
                    MediaLink: $scope.mediaLink
                }
            }).success(function (data) {
                $scope.outputStatus(data, 'Data updated successfully');

                $scope.StoreId = '';
                $scope.StoreIdentifier = '';
                $scope.StoreName = '';
                $scope.StoreDescription = '';
                $scope.mediaLink = '';
                $scope.loadAllStores();

            });
        };

        $scope.loadAllStores = function () {

            // console.log($scope.mediaLink, $scope.StoreDescription, $scope.StoreIdentifier);
            $http({
                url: '/api/store/show-stores',
                method: "GET"
            }).success(function (data) {
                $scope.storeList = data.data;
            });
        };

        $scope.changeStoreActivation = function () {
            $scope.closeAlert();

            $scope.StoreStatus = ($scope.StoreStatus == "Active") ? "Inactive" : "Active";

            $http({
                url: '/api/store/change-status',
                method: "POST",
                data: {
                    StoreId: $scope.StoreId,
                    StoreStatus: $scope.StoreStatus
                }
            }).success(function (data) {
                $scope.loadAllStores();
            });
        };

        $scope.editStore = function (index) {

            $scope.StoreId = $scope.storeList[index].Id;
            $scope.StoreIdentifier = $scope.storeList[index].Identifier;
            $scope.StoreName = $scope.storeList[index].Name;
            $scope.StoreStatus = $scope.storeList[index].Status == 'Active' ? 'Active' : 'Inactive';
            $scope.StoreDescription = $scope.storeList[index].Description;
            $scope.mediaLink = $scope.storeList[index].ImageLink;

        };

        $scope.deleteStore = function (id) {
            $scope.closeAlert();
            $http({
                url: '/api/store/delete-store',
                method: "POST",
                data: {
                    StoreId: id
                }
            }).success(function (data) {
                $scope.loadAllStores();
                $scope.outputStatus(data, 'Store deleted successfully');
            });
        };


        ///// tag //////

        $scope.showTagsByProductId = function () {

            $http({
                url: '/api/tag/show-tag/' + $scope.ProductId,
                method: "GET",
            }).success(function (data) {
                $scope.Tags = data.data;
            });
        };

        $scope.associateTags = function () {
            $http({
                url: '/api/tag/add-tags',
                method: "POST",
                data: {
                    Tags: $scope.Tags,
                    ProductId: $scope.ProductId
                },
            }).success(function (data) {

            });
        };

        $scope.searchTagByName = function (query) {

            // return [{"id":10,"name":"book"}];
            return $http.get('/api/tag/search-tag/' + query);
        };

        // open information in edit mood
        $scope.editTagInfo = function (index) {

            $scope.closeAlert();

            $scope.selectedTagId = $scope.AllTags[index].id;
            $scope.TagName = $scope.AllTags[index].tag_name;
            $scope.TagDescription = $scope.AllTags[index].tag_description;
        };

        $scope.updateTagInfo = function () {

            $scope.closeAlert();

            $http({
                url: '/api/tag/update-tag-info',
                method: "POST",
                data: {
                    TagId: $scope.selectedTagId,
                    TagName: $scope.TagName,
                    TagDescription: $scope.TagDescription
                },
            }).success(function (data) {
                $scope.TagName = '';
                $scope.TagDescription = '';
                $scope.selectedTagId = '';
                $scope.showTags();
                //   console.log('in function: '+data.status_code);
                $scope.outputStatus(data, 'Tag updated successfully');
            });
        };

        $scope.deleteTagInfo = function (tagId) {
            //delete-tag-info
            $scope.closeAlert();

            $http({
                url: '/api/tag/delete-tag-info',
                method: "POST",
                data: {
                    TagId: tagId,
                },
            }).success(function (data) {
                $scope.TagName = '';
                $scope.TagDescription = '';
                $scope.showTags();
                //   console.log('in function: '+data.status_code);
                $scope.outputStatus(data, 'Tag deleted successfully');
            });

        };

        $scope.showTags = function () {

            $http({
                url: '/api/tag/show-tags',
                method: "GET",

            }).success(function (data) {
                $scope.AllTags = data.data;
                //   console.log('in function: '+data.status_code);
                //   $scope.outputStatus(data, 'Tag added successfully');
            });

        };

        $scope.addTagInfo = function () {

            $scope.closeAlert();

            $http({
                url: '/api/tag/add-tag-info',
                method: "POST",
                data: {
                    TagName: $scope.TagName,
                    TagDescription: $scope.TagDescription
                },
            }).success(function (data) {
                $scope.TagName = '';
                $scope.TagDescription = '';
                $scope.showTags();

                //   console.log('in function: '+data.status_code);
                $scope.outputStatus(data, 'Tag added successfully');
            });

            return false;
        };

        ///// category  ////

        function buildCategoryViewString(data) {
            arrow = ' >> ';
            catValue = '';
            for (var i = 0; i < data.data.length; i++) {
                if (i == data.data.length - 1) {
                    arrow = '';
                }

                catValue += (data.data[i]['CategoryName'] + arrow);
             //   console.log(i);
            }
            $scope.categoryHierarchy = catValue;
           // console.log('cat :' + $scope.categoryHierarchy);
          //  console.log('cat :' + catValue);

        }

        $scope.categoryHierarchyView = function(catId){

            $http({
                url: '/api/category/get-category-hierarchy/'+catId,
                method: 'GET',
            }).success(function (data){
                console.log(data);

                buildCategoryViewString(data);

            });

        };

        //////// category tree view ////
        $scope.loadChildren = function (nodeId) {

            $scope.catId = nodeId;

            return $http.get('/api/category/show-category-items/' + $scope.catId).then(function (data) {

                return data['data'].data;
            });
        };
        $scope.$on("nodeSelected", function (event, node) {
            $scope.selected = node;
            $scope.selectedItem = $scope.selected.id;
            // console.log($scope.selectedItem);
            $scope.$broadcast("selectNode", node);

            // generate hierarchy view on node select
            $scope.categoryHierarchyView($scope.selectedItem);
        });

        // category tree view ///

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
            $scope.currentCategoryName = '';
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

                    // data load for tree view
                    if ($scope.catId == '') {
                        $scope.assets = $scope.categoryItems;

                    }

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
                    ExtraInfo: $scope.extraInfo,
                    Icon: $scope.icon,
                    MetaTitle: $scope.meta_title, //$scope.categoryItems[idx].icon
                    MetaDescription: $scope.meta_description, //$scope.categoryItems[idx].icon

                },
            }).success(function (data) {
                $scope.categoryName = '';
                $scope.extraInfo = '';
                $scope.icon = '';
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
            // console.log("Saving contact");
            // console.log($scope.categoryItems[idx]);
            $scope.closeAlert();

            $http({
                url: '/api/category/update-category',
                method: "POST",
                data: {
                    CategoryId: $scope.categoryItems[idx].id,
                    CategoryName: $scope.tableTemporaryValue.category,// $scope.categoryItems[idx].category,
                    ExtraInfo: $scope.tableTemporaryValue.info, //$scope.categoryItems[idx].info
                    Icon: $scope.tableTemporaryValue.icon, //$scope.categoryItems[idx].icon
                    MetaTitle: $scope.tableTemporaryValue.meta_title, //$scope.categoryItems[idx].icon
                    MetaDescription: $scope.tableTemporaryValue.meta_description, //$scope.categoryItems[idx].icon
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
                    ShowFor: $scope.ShowFor,
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
                    IdeaingReviewScore: $scope.ideaingReviewScore,
                    Tags: $scope.Tags
                }
            }).success(function (data) {
                //console.log(data);
                if (data.status_code == 200) {

                    // accociate tags for product on success.
                    $scope.associateTags();
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
                    ShowFor: $scope.ShowFor,
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
                    'counter': (typeof $scope.reviewCounter === 'undefined' || $scope.reviewCounter == '' || isNaN($scope.reviewCounter)) ? 1 : parseInt($scope.reviewCounter)
                }
            );
            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.reviewLink = '';
            console.log($scope.reviewCounter);

            $scope.reviewCounter = '';
            /*$scope.externalReviewLink = '';
             $scope.ideaingReviewScore = 0;*/
            console.log($scope.reviewCounter);

            $scope.calculateAvg();

        }

        $scope.deleteReviewFormField = function (index) {
            $scope.reviews.splice(index, 1);
            $scope.calculateAvg();
        }

        $scope.editReviewFormField = function (index) {
            $scope.$index = index;

            // for Amazon review keep the counter editable
            if (index == 1)
                $scope.readOnlyReviewCounter = false;

            $scope.reviewKey = $scope.reviews[index].key;
            $scope.reviewValue = $scope.reviews[index].value;
            $scope.reviewLink = $scope.reviews[index].link;
            $scope.reviewCounter = (typeof $scope.reviews[index].counter === 'undefined' || $scope.reviews[index].counter == '' || isNaN($scope.reviews[index].counter)) ? 1 : parseInt($scope.reviews[index].counter);
            // $scope.reviewCounter = $scope.reviews[index].counter;
            $scope.isUpdateReviewShow = true;
            $scope.calculateAvg();

        }
        $scope.updateReviewFormField = function () {
            $scope.readOnlyReviewCounter = true;
            $scope.reviews[$scope.$index].key = $scope.reviewKey;
            $scope.reviews[$scope.$index].value = $scope.reviewValue;
            $scope.reviews[$scope.$index].link = $scope.reviewLink;
            $scope.reviews[$scope.$index].counter = (typeof $scope.reviewCounter === 'undefined' || $scope.reviewCounter == '' || isNaN($scope.reviewCounter)) ? 1 : parseInt($scope.reviewCounter);

            $scope.isUpdateReviewShow = false;

            $scope.reviewKey = '';
            $scope.reviewValue = '';
            $scope.reviewLink = '';
            $scope.reviewCounter = '';
            $scope.calculateAvg();
        }

        $scope.calculateAvg = function () {
            $scope.totalCount = 0;
            var reviewers = 0;

            for (var i = 2; i < $scope.reviews.length; i++) {
                $scope.totalCount += $scope.reviews[i].value;

                reviewers += $scope.reviews[i].counter == null ? 0 : parseInt($scope.reviews[i].counter);
            }

            $scope.reviews[0].value = ($scope.totalCount / ($scope.reviews.length - 2)).toFixed(2);
            $scope.reviews[0].counter = reviewers;
            //    console.log($scope.reviews[0].value," - ",$scope.reviews[0].counter);

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
                    ShowFor: $scope.ShowFor,
                    WithTags: $scope.WithTags,

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
            $scope.closeAlert();
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

                    //if ($scope.Specifications == null)
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
                //  $scope.ProductVendorType = data.data.product_vendor_type;
                    $scope.ShowFor = data.data.show_for;
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

                    // load Tags
                    $scope.showTagsByProductId();

                    // load media in panel
                    $scope.getMedia();

                    // initialization category hierarchy view
                    $scope.categoryHierarchyView( $scope.selectedItem );

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

        //preview the product in details page
        $scope.previewProduct = function (permalink) {
            $window.open('/product/' + permalink, '_blank');
        };

        // Change the media type during add and edit of media content.
        $scope.mediaTypeChange = function () {
            // console.log($scope.selectedMediaType);

            if (($scope.selectedMediaType == 'img-link')) {
                $scope.isMediaUploadable = false;
                $scope.mediaLinkTmp = $scope.mediaLink;
                //   console.log($scope.isMediaUploadable);
            } else if (($scope.selectedMediaType == 'video-link') || ($scope.selectedMediaType == 'video-youtube-link') ||($scope.selectedMediaType == 'video-vimeo-link')) {

                $scope.isMediaUploadable = false;
                $scope.mediaLinkTmp = $scope.mediaLink;
                //   console.log( $scope.isMediaUploadable);
            } else if (($scope.selectedMediaType == 'img-upload')) {

                $scope.isMediaUploadable = true;
                $scope.mediaLink = $scope.mediaLinkTmp;
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
                    IsHeroItem: $scope.isHeroItem,
                    IsMainItem: $scope.isMainItem
                }
            }).success(function (data) {
                //   console.log(data);

                if (data.status_code == 200) {
                    $scope.getMedia();
                    $scope.mediaTitle = $scope.selectedMediaType = $scope.mediaLink = $scope.isHeroItem = $scope.isMainItem = '';

                }

            })
        };

        // get media content list for a single product
        $scope.getMedia = function () {
            $http({
                url: '/api/product/get-media/' + $scope.ProductId,
                method: 'GET',
            }).success(function (data) {

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

        $scope.editMedia = function (index) {

            $scope.mediaId = $scope.mediaList[index].id;

            $scope.mediaTitle = $scope.mediaList[index].media_name;
            $scope.selectedMediaType = $scope.mediaList[index].media_type;
            $scope.mediaLink = $scope.mediaList[index].media_link;

            var stat = $scope.mediaList[index].is_hero_item == 1 ? true : false;
            $scope.isHeroItem = stat;
            $scope.isMainItem = $scope.mediaList[index].is_main_item == 1 ? 1 : 0;
            $scope.isMediaEdit = true;
            // console.log($scope.mediaId);

        };

        $scope.updateMediaInfo = function () {
            $http({
                url: '/api/media/update-media',
                method: 'POST',
                data: {
                    MediaId: $scope.mediaId,
                    MediaTitle: $scope.mediaTitle,
                    MediaType: $scope.selectedMediaType,
                    MediaLink: $scope.mediaLink,
                    IsHeroItem: $scope.isHeroItem,
                    IsMainItem: $scope.isMainItem

                }
            }).success(function (data) {
                // console.log(data);
                $scope.mediaId = '';
                $scope.mediaTitle = '';
                $scope.selectedMediaType = '';
                $scope.mediaLink = '';
                $scope.isHeroItem = false;
                $scope.isMainItem = false;
                $scope.isMediaEdit = false;
                $scope.getMedia();

            });
        };

        // Initialize variables and functions Globally.
        $scope.initPage();
        $scope.getCategory();


    }]);;
/*
 angular-file-upload v2.2.0
 https://github.com/nervgh/angular-file-upload
 */

(function webpackUniversalModuleDefinition(root, factory) {
 if(typeof exports === 'object' && typeof module === 'object')
  module.exports = factory();
 else if(typeof define === 'function' && define.amd)
  define([], factory);
 else if(typeof exports === 'object')
  exports["angular-file-upload"] = factory();
 else
  root["angular-file-upload"] = factory();
})(this, function() {
 return /******/ (function(modules) { // webpackBootstrap
  /******/ 	// The module cache
  /******/ 	var installedModules = {};
  /******/
  /******/ 	// The require function
  /******/ 	function __webpack_require__(moduleId) {
   /******/
   /******/ 		// Check if module is in cache
   /******/ 		if(installedModules[moduleId])
   /******/ 			return installedModules[moduleId].exports;
   /******/
   /******/ 		// Create a new module (and put it into the cache)
   /******/ 		var module = installedModules[moduleId] = {
    /******/ 			exports: {},
    /******/ 			id: moduleId,
    /******/ 			loaded: false
    /******/ 		};
   /******/
   /******/ 		// Execute the module function
   /******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
   /******/
   /******/ 		// Flag the module as loaded
   /******/ 		module.loaded = true;
   /******/
   /******/ 		// Return the exports of the module
   /******/ 		return module.exports;
   /******/ 	}
  /******/
  /******/
  /******/ 	// expose the modules object (__webpack_modules__)
  /******/ 	__webpack_require__.m = modules;
  /******/
  /******/ 	// expose the module cache
  /******/ 	__webpack_require__.c = installedModules;
  /******/
  /******/ 	// __webpack_public_path__
  /******/ 	__webpack_require__.p = "";
  /******/
  /******/ 	// Load entry module and return exports
  /******/ 	return __webpack_require__(0);
  /******/ })
  /************************************************************************/
  /******/ ([
  /* 0 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var options = _interopRequire(__webpack_require__(2));

   var serviceFileUploader = _interopRequire(__webpack_require__(3));

   var serviceFileLikeObject = _interopRequire(__webpack_require__(4));

   var serviceFileItem = _interopRequire(__webpack_require__(5));

   var serviceFileDirective = _interopRequire(__webpack_require__(6));

   var serviceFileSelect = _interopRequire(__webpack_require__(7));

   var serviceFileDrop = _interopRequire(__webpack_require__(8));

   var serviceFileOver = _interopRequire(__webpack_require__(9));

   var directiveFileSelect = _interopRequire(__webpack_require__(10));

   var directiveFileDrop = _interopRequire(__webpack_require__(11));

   var directiveFileOver = _interopRequire(__webpack_require__(12));

   angular.module(CONFIG.name, []).value("fileUploaderOptions", options).factory("FileUploader", serviceFileUploader).factory("FileLikeObject", serviceFileLikeObject).factory("FileItem", serviceFileItem).factory("FileDirective", serviceFileDirective).factory("FileSelect", serviceFileSelect).factory("FileDrop", serviceFileDrop).factory("FileOver", serviceFileOver).directive("nvFileSelect", directiveFileSelect).directive("nvFileDrop", directiveFileDrop).directive("nvFileOver", directiveFileOver).run(["FileUploader", "FileLikeObject", "FileItem", "FileDirective", "FileSelect", "FileDrop", "FileOver", function (FileUploader, FileLikeObject, FileItem, FileDirective, FileSelect, FileDrop, FileOver) {
    // only for compatibility
    FileUploader.FileLikeObject = FileLikeObject;
    FileUploader.FileItem = FileItem;
    FileUploader.FileDirective = FileDirective;
    FileUploader.FileSelect = FileSelect;
    FileUploader.FileDrop = FileDrop;
    FileUploader.FileOver = FileOver;
   }]);

   /***/ },
  /* 1 */
  /***/ function(module, exports) {

   module.exports = {
    "name": "angularFileUpload"
   };

   /***/ },
  /* 2 */
  /***/ function(module, exports) {

   "use strict";

   module.exports = {
    url: "/",
    alias: "file",
    headers: {},
    queue: [],
    progress: 0,
    autoUpload: false,
    removeAfterUpload: false,
    method: "POST",
    filters: [],
    formData: [],
    queueLimit: Number.MAX_VALUE,
    withCredentials: false
   };

   /***/ },
  /* 3 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var copy = angular.copy;
   var extend = angular.extend;
   var forEach = angular.forEach;
   var isObject = angular.isObject;
   var isNumber = angular.isNumber;
   var isDefined = angular.isDefined;
   var isArray = angular.isArray;
   var element = angular.element;

   module.exports = function (fileUploaderOptions, $rootScope, $http, $window, FileLikeObject, FileItem) {
    var File = $window.File;
    var FormData = $window.FormData;

    var FileUploader = (function () {
     /**********************
      * PUBLIC
      **********************/
     /**
      * Creates an instance of FileUploader
      * @param {Object} [options]
      * @constructor
      */

     function FileUploader(options) {
      _classCallCheck(this, FileUploader);

      var settings = copy(fileUploaderOptions);

      extend(this, settings, options, {
       isUploading: false,
       _nextIndex: 0,
       _failFilterIndex: -1,
       _directives: { select: [], drop: [], over: [] }
      });

      // add default filters
      this.filters.unshift({ name: "queueLimit", fn: this._queueLimitFilter });
      this.filters.unshift({ name: "folder", fn: this._folderFilter });
     }

     _createClass(FileUploader, {
      addToQueue: {
       /**
        * Adds items to the queue
        * @param {File|HTMLInputElement|Object|FileList|Array<Object>} files
        * @param {Object} [options]
        * @param {Array<Function>|String} filters
        */

       value: function addToQueue(files, options, filters) {
        var _this = this;

        var list = this.isArrayLikeObject(files) ? files : [files];
        var arrayOfFilters = this._getFilters(filters);
        var count = this.queue.length;
        var addedFileItems = [];

        forEach(list, function (some /*{File|HTMLInputElement|Object}*/) {
         var temp = new FileLikeObject(some);

         if (_this._isValidFile(temp, arrayOfFilters, options)) {
          var fileItem = new FileItem(_this, some, options);
          addedFileItems.push(fileItem);
          _this.queue.push(fileItem);
          _this._onAfterAddingFile(fileItem);
         } else {
          var filter = arrayOfFilters[_this._failFilterIndex];
          _this._onWhenAddingFileFailed(temp, filter, options);
         }
        });

        if (this.queue.length !== count) {
         this._onAfterAddingAll(addedFileItems);
         this.progress = this._getTotalProgress();
        }

        this._render();
        if (this.autoUpload) this.uploadAll();
       }
      },
      removeFromQueue: {
       /**
        * Remove items from the queue. Remove last: index = -1
        * @param {FileItem|Number} value
        */

       value: function removeFromQueue(value) {
        var index = this.getIndexOfItem(value);
        var item = this.queue[index];
        if (item.isUploading) item.cancel();
        this.queue.splice(index, 1);
        item._destroy();
        this.progress = this._getTotalProgress();
       }
      },
      clearQueue: {
       /**
        * Clears the queue
        */

       value: function clearQueue() {
        while (this.queue.length) {
         this.queue[0].remove();
        }
        this.progress = 0;
       }
      },
      uploadItem: {
       /**
        * Uploads a item from the queue
        * @param {FileItem|Number} value
        */

       value: function uploadItem(value) {
        var index = this.getIndexOfItem(value);
        var item = this.queue[index];
        var transport = this.isHTML5 ? "_xhrTransport" : "_iframeTransport";

        item._prepareToUploading();
        if (this.isUploading) {
         return;
        }this.isUploading = true;
        this[transport](item);
       }
      },
      cancelItem: {
       /**
        * Cancels uploading of item from the queue
        * @param {FileItem|Number} value
        */

       value: function cancelItem(value) {
        var index = this.getIndexOfItem(value);
        var item = this.queue[index];
        var prop = this.isHTML5 ? "_xhr" : "_form";
        if (item && item.isUploading) item[prop].abort();
       }
      },
      uploadAll: {
       /**
        * Uploads all not uploaded items of queue
        */

       value: function uploadAll() {
        var items = this.getNotUploadedItems().filter(function (item) {
         return !item.isUploading;
        });
        if (!items.length) {
         return;
        }forEach(items, function (item) {
         return item._prepareToUploading();
        });
        items[0].upload();
       }
      },
      cancelAll: {
       /**
        * Cancels all uploads
        */

       value: function cancelAll() {
        var items = this.getNotUploadedItems();
        forEach(items, function (item) {
         return item.cancel();
        });
       }
      },
      isFile: {
       /**
        * Returns "true" if value an instance of File
        * @param {*} value
        * @returns {Boolean}
        * @private
        */

       value: function isFile(value) {
        return this.constructor.isFile(value);
       }
      },
      isFileLikeObject: {
       /**
        * Returns "true" if value an instance of FileLikeObject
        * @param {*} value
        * @returns {Boolean}
        * @private
        */

       value: function isFileLikeObject(value) {
        return this.constructor.isFileLikeObject(value);
       }
      },
      isArrayLikeObject: {
       /**
        * Returns "true" if value is array like object
        * @param {*} value
        * @returns {Boolean}
        */

       value: function isArrayLikeObject(value) {
        return this.constructor.isArrayLikeObject(value);
       }
      },
      getIndexOfItem: {
       /**
        * Returns a index of item from the queue
        * @param {Item|Number} value
        * @returns {Number}
        */

       value: function getIndexOfItem(value) {
        return isNumber(value) ? value : this.queue.indexOf(value);
       }
      },
      getNotUploadedItems: {
       /**
        * Returns not uploaded items
        * @returns {Array}
        */

       value: function getNotUploadedItems() {
        return this.queue.filter(function (item) {
         return !item.isUploaded;
        });
       }
      },
      getReadyItems: {
       /**
        * Returns items ready for upload
        * @returns {Array}
        */

       value: function getReadyItems() {
        return this.queue.filter(function (item) {
         return item.isReady && !item.isUploading;
        }).sort(function (item1, item2) {
         return item1.index - item2.index;
        });
       }
      },
      destroy: {
       /**
        * Destroys instance of FileUploader
        */

       value: function destroy() {
        var _this = this;

        forEach(this._directives, function (key) {
         forEach(_this._directives[key], function (object) {
          object.destroy();
         });
        });
       }
      },
      onAfterAddingAll: {
       /**
        * Callback
        * @param {Array} fileItems
        */

       value: function onAfterAddingAll(fileItems) {}
      },
      onAfterAddingFile: {
       /**
        * Callback
        * @param {FileItem} fileItem
        */

       value: function onAfterAddingFile(fileItem) {}
      },
      onWhenAddingFileFailed: {
       /**
        * Callback
        * @param {File|Object} item
        * @param {Object} filter
        * @param {Object} options
        */

       value: function onWhenAddingFileFailed(item, filter, options) {}
      },
      onBeforeUploadItem: {
       /**
        * Callback
        * @param {FileItem} fileItem
        */

       value: function onBeforeUploadItem(fileItem) {}
      },
      onProgressItem: {
       /**
        * Callback
        * @param {FileItem} fileItem
        * @param {Number} progress
        */

       value: function onProgressItem(fileItem, progress) {}
      },
      onProgressAll: {
       /**
        * Callback
        * @param {Number} progress
        */

       value: function onProgressAll(progress) {}
      },
      onSuccessItem: {
       /**
        * Callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onSuccessItem(item, response, status, headers) {}
      },
      onErrorItem: {
       /**
        * Callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onErrorItem(item, response, status, headers) {}
      },
      onCancelItem: {
       /**
        * Callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onCancelItem(item, response, status, headers) {}
      },
      onCompleteItem: {
       /**
        * Callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onCompleteItem(item, response, status, headers) {}
      },
      onCompleteAll: {
       /**
        * Callback
        */

       value: function onCompleteAll() {}
      },
      _getTotalProgress: {
       /**********************
        * PRIVATE
        **********************/
       /**
        * Returns the total progress
        * @param {Number} [value]
        * @returns {Number}
        * @private
        */

       value: function _getTotalProgress(value) {
        if (this.removeAfterUpload) {
         return value || 0;
        }var notUploaded = this.getNotUploadedItems().length;
        var uploaded = notUploaded ? this.queue.length - notUploaded : this.queue.length;
        var ratio = 100 / this.queue.length;
        var current = (value || 0) * ratio / 100;

        return Math.round(uploaded * ratio + current);
       }
      },
      _getFilters: {
       /**
        * Returns array of filters
        * @param {Array<Function>|String} filters
        * @returns {Array<Function>}
        * @private
        */

       value: function _getFilters(filters) {
        if (!filters) {
         return this.filters;
        }if (isArray(filters)) {
         return filters;
        }var names = filters.match(/[^\s,]+/g);
        return this.filters.filter(function (filter) {
         return names.indexOf(filter.name) !== -1;
        });
       }
      },
      _render: {
       /**
        * Updates html
        * @private
        */

       value: function _render() {
        if (!$rootScope.$$phase) $rootScope.$apply();
       }
      },
      _folderFilter: {
       /**
        * Returns "true" if item is a file (not folder)
        * @param {File|FileLikeObject} item
        * @returns {Boolean}
        * @private
        */

       value: function _folderFilter(item) {
        return !!(item.size || item.type);
       }
      },
      _queueLimitFilter: {
       /**
        * Returns "true" if the limit has not been reached
        * @returns {Boolean}
        * @private
        */

       value: function _queueLimitFilter() {
        return this.queue.length < this.queueLimit;
       }
      },
      _isValidFile: {
       /**
        * Returns "true" if file pass all filters
        * @param {File|Object} file
        * @param {Array<Function>} filters
        * @param {Object} options
        * @returns {Boolean}
        * @private
        */

       value: function _isValidFile(file, filters, options) {
        var _this = this;

        this._failFilterIndex = -1;
        return !filters.length ? true : filters.every(function (filter) {
         _this._failFilterIndex++;
         return filter.fn.call(_this, file, options);
        });
       }
      },
      _isSuccessCode: {
       /**
        * Checks whether upload successful
        * @param {Number} status
        * @returns {Boolean}
        * @private
        */

       value: function _isSuccessCode(status) {
        return status >= 200 && status < 300 || status === 304;
       }
      },
      _transformResponse: {
       /**
        * Transforms the server response
        * @param {*} response
        * @param {Object} headers
        * @returns {*}
        * @private
        */

       value: function _transformResponse(response, headers) {
        var headersGetter = this._headersGetter(headers);
        forEach($http.defaults.transformResponse, function (transformFn) {
         response = transformFn(response, headersGetter);
        });
        return response;
       }
      },
      _parseHeaders: {
       /**
        * Parsed response headers
        * @param headers
        * @returns {Object}
        * @see https://github.com/angular/angular.js/blob/master/src/ng/http.js
        * @private
        */

       value: function _parseHeaders(headers) {
        var parsed = {},
            key,
            val,
            i;

        if (!headers) {
         return parsed;
        }forEach(headers.split("\n"), function (line) {
         i = line.indexOf(":");
         key = line.slice(0, i).trim().toLowerCase();
         val = line.slice(i + 1).trim();

         if (key) {
          parsed[key] = parsed[key] ? parsed[key] + ", " + val : val;
         }
        });

        return parsed;
       }
      },
      _headersGetter: {
       /**
        * Returns function that returns headers
        * @param {Object} parsedHeaders
        * @returns {Function}
        * @private
        */

       value: function _headersGetter(parsedHeaders) {
        return function (name) {
         if (name) {
          return parsedHeaders[name.toLowerCase()] || null;
         }
         return parsedHeaders;
        };
       }
      },
      _xhrTransport: {
       /**
        * The XMLHttpRequest transport
        * @param {FileItem} item
        * @private
        */

       value: function _xhrTransport(item) {
        var _this = this;

        var xhr = item._xhr = new XMLHttpRequest();
        var form = new FormData();

        this._onBeforeUploadItem(item);

        forEach(item.formData, function (obj) {
         forEach(obj, function (value, key) {
          form.append(key, value);
         });
        });

        if (typeof item._file.size != "number") {
         throw new TypeError("The file specified is no longer valid");
        }

        form.append(item.alias, item._file, item.file.name);

        xhr.upload.onprogress = function (event) {
         var progress = Math.round(event.lengthComputable ? event.loaded * 100 / event.total : 0);
         _this._onProgressItem(item, progress);
        };

        xhr.onload = function () {
         var headers = _this._parseHeaders(xhr.getAllResponseHeaders());
         var response = _this._transformResponse(xhr.response, headers);
         var gist = _this._isSuccessCode(xhr.status) ? "Success" : "Error";
         var method = "_on" + gist + "Item";
         _this[method](item, response, xhr.status, headers);
         _this._onCompleteItem(item, response, xhr.status, headers);
        };

        xhr.onerror = function () {
         var headers = _this._parseHeaders(xhr.getAllResponseHeaders());
         var response = _this._transformResponse(xhr.response, headers);
         _this._onErrorItem(item, response, xhr.status, headers);
         _this._onCompleteItem(item, response, xhr.status, headers);
        };

        xhr.onabort = function () {
         var headers = _this._parseHeaders(xhr.getAllResponseHeaders());
         var response = _this._transformResponse(xhr.response, headers);
         _this._onCancelItem(item, response, xhr.status, headers);
         _this._onCompleteItem(item, response, xhr.status, headers);
        };

        xhr.open(item.method, item.url, true);

        xhr.withCredentials = item.withCredentials;

        forEach(item.headers, function (value, name) {
         xhr.setRequestHeader(name, value);
        });

        xhr.send(form);
        this._render();
       }
      },
      _iframeTransport: {
       /**
        * The IFrame transport
        * @param {FileItem} item
        * @private
        */

       value: function _iframeTransport(item) {
        var _this = this;

        var form = element("<form style=\"display: none;\" />");
        var iframe = element("<iframe name=\"iframeTransport" + Date.now() + "\">");
        var input = item._input;

        if (item._form) item._form.replaceWith(input); // remove old form
        item._form = form; // save link to new form

        this._onBeforeUploadItem(item);

        input.prop("name", item.alias);

        forEach(item.formData, function (obj) {
         forEach(obj, function (value, key) {
          var element_ = element("<input type=\"hidden\" name=\"" + key + "\" />");
          element_.val(value);
          form.append(element_);
         });
        });

        form.prop({
         action: item.url,
         method: "POST",
         target: iframe.prop("name"),
         enctype: "multipart/form-data",
         encoding: "multipart/form-data" // old IE
        });

        iframe.bind("load", function () {
         var html = "";
         var status = 200;

         try {
          // Fix for legacy IE browsers that loads internal error page
          // when failed WS response received. In consequence iframe
          // content access denied error is thrown becouse trying to
          // access cross domain page. When such thing occurs notifying
          // with empty response object. See more info at:
          // http://stackoverflow.com/questions/151362/access-is-denied-error-on-accessing-iframe-document-object
          // Note that if non standard 4xx or 5xx error code returned
          // from WS then response content can be accessed without error
          // but 'XHR' status becomes 200. In order to avoid confusion
          // returning response via same 'success' event handler.

          // fixed angular.contents() for iframes
          html = iframe[0].contentDocument.body.innerHTML;
         } catch (e) {
          // in case we run into the access-is-denied error or we have another error on the server side
          // (intentional 500,40... errors), we at least say 'something went wrong' -> 500
          status = 500;
         }

         var xhr = { response: html, status: status, dummy: true };
         var headers = {};
         var response = _this._transformResponse(xhr.response, headers);

         _this._onSuccessItem(item, response, xhr.status, headers);
         _this._onCompleteItem(item, response, xhr.status, headers);
        });

        form.abort = function () {
         var xhr = { status: 0, dummy: true };
         var headers = {};
         var response;

         iframe.unbind("load").prop("src", "javascript:false;");
         form.replaceWith(input);

         _this._onCancelItem(item, response, xhr.status, headers);
         _this._onCompleteItem(item, response, xhr.status, headers);
        };

        input.after(form);
        form.append(input).append(iframe);

        form[0].submit();
        this._render();
       }
      },
      _onWhenAddingFileFailed: {
       /**
        * Inner callback
        * @param {File|Object} item
        * @param {Object} filter
        * @param {Object} options
        * @private
        */

       value: function _onWhenAddingFileFailed(item, filter, options) {
        this.onWhenAddingFileFailed(item, filter, options);
       }
      },
      _onAfterAddingFile: {
       /**
        * Inner callback
        * @param {FileItem} item
        */

       value: function _onAfterAddingFile(item) {
        this.onAfterAddingFile(item);
       }
      },
      _onAfterAddingAll: {
       /**
        * Inner callback
        * @param {Array<FileItem>} items
        */

       value: function _onAfterAddingAll(items) {
        this.onAfterAddingAll(items);
       }
      },
      _onBeforeUploadItem: {
       /**
        *  Inner callback
        * @param {FileItem} item
        * @private
        */

       value: function _onBeforeUploadItem(item) {
        item._onBeforeUpload();
        this.onBeforeUploadItem(item);
       }
      },
      _onProgressItem: {
       /**
        * Inner callback
        * @param {FileItem} item
        * @param {Number} progress
        * @private
        */

       value: function _onProgressItem(item, progress) {
        var total = this._getTotalProgress(progress);
        this.progress = total;
        item._onProgress(progress);
        this.onProgressItem(item, progress);
        this.onProgressAll(total);
        this._render();
       }
      },
      _onSuccessItem: {
       /**
        * Inner callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onSuccessItem(item, response, status, headers) {
        item._onSuccess(response, status, headers);
        this.onSuccessItem(item, response, status, headers);
       }
      },
      _onErrorItem: {
       /**
        * Inner callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onErrorItem(item, response, status, headers) {
        item._onError(response, status, headers);
        this.onErrorItem(item, response, status, headers);
       }
      },
      _onCancelItem: {
       /**
        * Inner callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onCancelItem(item, response, status, headers) {
        item._onCancel(response, status, headers);
        this.onCancelItem(item, response, status, headers);
       }
      },
      _onCompleteItem: {
       /**
        * Inner callback
        * @param {FileItem} item
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onCompleteItem(item, response, status, headers) {
        item._onComplete(response, status, headers);
        this.onCompleteItem(item, response, status, headers);

        var nextItem = this.getReadyItems()[0];
        this.isUploading = false;

        if (isDefined(nextItem)) {
         nextItem.upload();
         return;
        }

        this.onCompleteAll();
        this.progress = this._getTotalProgress();
        this._render();
       }
      }
     }, {
      isFile: {
       /**********************
        * STATIC
        **********************/
       /**
        * Returns "true" if value an instance of File
        * @param {*} value
        * @returns {Boolean}
        * @private
        */

       value: function isFile(value) {
        return File && value instanceof File;
       }
      },
      isFileLikeObject: {
       /**
        * Returns "true" if value an instance of FileLikeObject
        * @param {*} value
        * @returns {Boolean}
        * @private
        */

       value: function isFileLikeObject(value) {
        return value instanceof FileLikeObject;
       }
      },
      isArrayLikeObject: {
       /**
        * Returns "true" if value is array like object
        * @param {*} value
        * @returns {Boolean}
        */

       value: function isArrayLikeObject(value) {
        return isObject(value) && "length" in value;
       }
      },
      inherit: {
       /**
        * Inherits a target (Class_1) by a source (Class_2)
        * @param {Function} target
        * @param {Function} source
        */

       value: function inherit(target, source) {
        target.prototype = Object.create(source.prototype);
        target.prototype.constructor = target;
        target.super_ = source;
       }
      }
     });

     return FileUploader;
    })();

    /**********************
     * PUBLIC
     **********************/
    /**
     * Checks a support the html5 uploader
     * @returns {Boolean}
     * @readonly
     */
    FileUploader.prototype.isHTML5 = !!(File && FormData);
    /**********************
     * STATIC
     **********************/
    /**
     * @borrows FileUploader.prototype.isHTML5
     */
    FileUploader.isHTML5 = FileUploader.prototype.isHTML5;

    return FileUploader;
   };

   module.exports.$inject = ["fileUploaderOptions", "$rootScope", "$http", "$window", "FileLikeObject", "FileItem"];

   /***/ },
  /* 4 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var copy = angular.copy;
   var isElement = angular.isElement;
   var isString = angular.isString;

   module.exports = function () {
    var FileLikeObject = (function () {
     /**
      * Creates an instance of FileLikeObject
      * @param {File|HTMLInputElement|Object} fileOrInput
      * @constructor
      */

     function FileLikeObject(fileOrInput) {
      _classCallCheck(this, FileLikeObject);

      var isInput = isElement(fileOrInput);
      var fakePathOrObject = isInput ? fileOrInput.value : fileOrInput;
      var postfix = isString(fakePathOrObject) ? "FakePath" : "Object";
      var method = "_createFrom" + postfix;
      this[method](fakePathOrObject);
     }

     _createClass(FileLikeObject, {
      _createFromFakePath: {
       /**
        * Creates file like object from fake path string
        * @param {String} path
        * @private
        */

       value: function _createFromFakePath(path) {
        this.lastModifiedDate = null;
        this.size = null;
        this.type = "like/" + path.slice(path.lastIndexOf(".") + 1).toLowerCase();
        this.name = path.slice(path.lastIndexOf("/") + path.lastIndexOf("\\") + 2);
       }
      },
      _createFromObject: {
       /**
        * Creates file like object from object
        * @param {File|FileLikeObject} object
        * @private
        */

       value: function _createFromObject(object) {
        this.lastModifiedDate = copy(object.lastModifiedDate);
        this.size = object.size;
        this.type = object.type;
        this.name = object.name;
       }
      }
     });

     return FileLikeObject;
    })();

    return FileLikeObject;
   };

   module.exports.$inject = [];

   /***/ },
  /* 5 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var copy = angular.copy;
   var extend = angular.extend;
   var element = angular.element;
   var isElement = angular.isElement;

   module.exports = function ($compile, FileLikeObject) {
    var FileItem = (function () {
     /**
      * Creates an instance of FileItem
      * @param {FileUploader} uploader
      * @param {File|HTMLInputElement|Object} some
      * @param {Object} options
      * @constructor
      */

     function FileItem(uploader, some, options) {
      _classCallCheck(this, FileItem);

      var isInput = isElement(some);
      var input = isInput ? element(some) : null;
      var file = !isInput ? some : null;

      extend(this, {
       url: uploader.url,
       alias: uploader.alias,
       headers: copy(uploader.headers),
       formData: copy(uploader.formData),
       removeAfterUpload: uploader.removeAfterUpload,
       withCredentials: uploader.withCredentials,
       method: uploader.method
      }, options, {
       uploader: uploader,
       file: new FileLikeObject(some),
       isReady: false,
       isUploading: false,
       isUploaded: false,
       isSuccess: false,
       isCancel: false,
       isError: false,
       progress: 0,
       index: null,
       _file: file,
       _input: input
      });

      if (input) this._replaceNode(input);
     }

     _createClass(FileItem, {
      upload: {
       /**********************
        * PUBLIC
        **********************/
       /**
        * Uploads a FileItem
        */

       value: function upload() {
        try {
         this.uploader.uploadItem(this);
        } catch (e) {
         this.uploader._onCompleteItem(this, "", 0, []);
         this.uploader._onErrorItem(this, "", 0, []);
        }
       }
      },
      cancel: {
       /**
        * Cancels uploading of FileItem
        */

       value: function cancel() {
        this.uploader.cancelItem(this);
       }
      },
      remove: {
       /**
        * Removes a FileItem
        */

       value: function remove() {
        this.uploader.removeFromQueue(this);
       }
      },
      onBeforeUpload: {
       /**
        * Callback
        * @private
        */

       value: function onBeforeUpload() {}
      },
      onProgress: {
       /**
        * Callback
        * @param {Number} progress
        * @private
        */

       value: function onProgress(progress) {}
      },
      onSuccess: {
       /**
        * Callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onSuccess(response, status, headers) {}
      },
      onError: {
       /**
        * Callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onError(response, status, headers) {}
      },
      onCancel: {
       /**
        * Callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onCancel(response, status, headers) {}
      },
      onComplete: {
       /**
        * Callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        */

       value: function onComplete(response, status, headers) {}
      },
      _onBeforeUpload: {
       /**********************
        * PRIVATE
        **********************/
       /**
        * Inner callback
        */

       value: function _onBeforeUpload() {
        this.isReady = true;
        this.isUploading = true;
        this.isUploaded = false;
        this.isSuccess = false;
        this.isCancel = false;
        this.isError = false;
        this.progress = 0;
        this.onBeforeUpload();
       }
      },
      _onProgress: {
       /**
        * Inner callback
        * @param {Number} progress
        * @private
        */

       value: function _onProgress(progress) {
        this.progress = progress;
        this.onProgress(progress);
       }
      },
      _onSuccess: {
       /**
        * Inner callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onSuccess(response, status, headers) {
        this.isReady = false;
        this.isUploading = false;
        this.isUploaded = true;
        this.isSuccess = true;
        this.isCancel = false;
        this.isError = false;
        this.progress = 100;
        this.index = null;
        this.onSuccess(response, status, headers);
       }
      },
      _onError: {
       /**
        * Inner callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onError(response, status, headers) {
        this.isReady = false;
        this.isUploading = false;
        this.isUploaded = true;
        this.isSuccess = false;
        this.isCancel = false;
        this.isError = true;
        this.progress = 0;
        this.index = null;
        this.onError(response, status, headers);
       }
      },
      _onCancel: {
       /**
        * Inner callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onCancel(response, status, headers) {
        this.isReady = false;
        this.isUploading = false;
        this.isUploaded = false;
        this.isSuccess = false;
        this.isCancel = true;
        this.isError = false;
        this.progress = 0;
        this.index = null;
        this.onCancel(response, status, headers);
       }
      },
      _onComplete: {
       /**
        * Inner callback
        * @param {*} response
        * @param {Number} status
        * @param {Object} headers
        * @private
        */

       value: function _onComplete(response, status, headers) {
        this.onComplete(response, status, headers);
        if (this.removeAfterUpload) this.remove();
       }
      },
      _destroy: {
       /**
        * Destroys a FileItem
        */

       value: function _destroy() {
        if (this._input) this._input.remove();
        if (this._form) this._form.remove();
        delete this._form;
        delete this._input;
       }
      },
      _prepareToUploading: {
       /**
        * Prepares to uploading
        * @private
        */

       value: function _prepareToUploading() {
        this.index = this.index || ++this.uploader._nextIndex;
        this.isReady = true;
       }
      },
      _replaceNode: {
       /**
        * Replaces input element on his clone
        * @param {JQLite|jQuery} input
        * @private
        */

       value: function _replaceNode(input) {
        var clone = $compile(input.clone())(input.scope());
        clone.prop("value", null); // FF fix
        input.css("display", "none");
        input.after(clone); // remove jquery dependency
       }
      }
     });

     return FileItem;
    })();

    return FileItem;
   };

   module.exports.$inject = ["$compile", "FileLikeObject"];

   /***/ },
  /* 6 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var extend = angular.extend;

   module.exports = function () {
    var FileDirective = (function () {
     /**
      * Creates instance of {FileDirective} object
      * @param {Object} options
      * @param {Object} options.uploader
      * @param {HTMLElement} options.element
      * @param {Object} options.events
      * @param {String} options.prop
      * @constructor
      */

     function FileDirective(options) {
      _classCallCheck(this, FileDirective);

      extend(this, options);
      this.uploader._directives[this.prop].push(this);
      this._saveLinks();
      this.bind();
     }

     _createClass(FileDirective, {
      bind: {
       /**
        * Binds events handles
        */

       value: function bind() {
        for (var key in this.events) {
         var prop = this.events[key];
         this.element.bind(key, this[prop]);
        }
       }
      },
      unbind: {
       /**
        * Unbinds events handles
        */

       value: function unbind() {
        for (var key in this.events) {
         this.element.unbind(key, this.events[key]);
        }
       }
      },
      destroy: {
       /**
        * Destroys directive
        */

       value: function destroy() {
        var index = this.uploader._directives[this.prop].indexOf(this);
        this.uploader._directives[this.prop].splice(index, 1);
        this.unbind();
        // this.element = null;
       }
      },
      _saveLinks: {
       /**
        * Saves links to functions
        * @private
        */

       value: function _saveLinks() {
        for (var key in this.events) {
         var prop = this.events[key];
         this[prop] = this[prop].bind(this);
        }
       }
      }
     });

     return FileDirective;
    })();

    /**
     * Map of events
     * @type {Object}
     */
    FileDirective.prototype.events = {};

    return FileDirective;
   };

   module.exports.$inject = [];

   /***/ },
  /* 7 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _get = function get(object, property, receiver) { var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc && desc.writable) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

   var _inherits = function (subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) subClass.__proto__ = superClass; };

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var extend = angular.extend;

   module.exports = function (FileDirective) {
    var FileSelect = (function (_FileDirective) {
     /**
      * Creates instance of {FileSelect} object
      * @param {Object} options
      * @constructor
      */

     function FileSelect(options) {
      _classCallCheck(this, FileSelect);

      var extendedOptions = extend(options, {
       // Map of events
       events: {
        $destroy: "destroy",
        change: "onChange"
       },
       // Name of property inside uploader._directive object
       prop: "select"
      });

      _get(Object.getPrototypeOf(FileSelect.prototype), "constructor", this).call(this, extendedOptions);

      if (!this.uploader.isHTML5) {
       this.element.removeAttr("multiple");
      }
      this.element.prop("value", null); // FF fix
     }

     _inherits(FileSelect, _FileDirective);

     _createClass(FileSelect, {
      getOptions: {
       /**
        * Returns options
        * @return {Object|undefined}
        */

       value: function getOptions() {}
      },
      getFilters: {
       /**
        * Returns filters
        * @return {Array<Function>|String|undefined}
        */

       value: function getFilters() {}
      },
      isEmptyAfterSelection: {
       /**
        * If returns "true" then HTMLInputElement will be cleared
        * @returns {Boolean}
        */

       value: function isEmptyAfterSelection() {
        return !!this.element.attr("multiple");
       }
      },
      onChange: {
       /**
        * Event handler
        */

       value: function onChange() {
        var files = this.uploader.isHTML5 ? this.element[0].files : this.element[0];
        var options = this.getOptions();
        var filters = this.getFilters();

        if (!this.uploader.isHTML5) this.destroy();
        this.uploader.addToQueue(files, options, filters);
        if (this.isEmptyAfterSelection()) {
         this.element.prop("value", null);
         this.element.replaceWith(this.element = this.element.clone(true)); // IE fix
        }
       }
      }
     });

     return FileSelect;
    })(FileDirective);

    return FileSelect;
   };

   module.exports.$inject = ["FileDirective"];

   /***/ },
  /* 8 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _get = function get(object, property, receiver) { var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc && desc.writable) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

   var _inherits = function (subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) subClass.__proto__ = superClass; };

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var extend = angular.extend;
   var forEach = angular.forEach;

   module.exports = function (FileDirective) {
    var FileDrop = (function (_FileDirective) {
     /**
      * Creates instance of {FileDrop} object
      * @param {Object} options
      * @constructor
      */

     function FileDrop(options) {
      _classCallCheck(this, FileDrop);

      var extendedOptions = extend(options, {
       // Map of events
       events: {
        $destroy: "destroy",
        drop: "onDrop",
        dragover: "onDragOver",
        dragleave: "onDragLeave"
       },
       // Name of property inside uploader._directive object
       prop: "drop"
      });

      _get(Object.getPrototypeOf(FileDrop.prototype), "constructor", this).call(this, extendedOptions);
     }

     _inherits(FileDrop, _FileDirective);

     _createClass(FileDrop, {
      getOptions: {
       /**
        * Returns options
        * @return {Object|undefined}
        */

       value: function getOptions() {}
      },
      getFilters: {
       /**
        * Returns filters
        * @return {Array<Function>|String|undefined}
        */

       value: function getFilters() {}
      },
      onDrop: {
       /**
        * Event handler
        */

       value: function onDrop(event) {
        var transfer = this._getTransfer(event);
        if (!transfer) {
         return;
        }var options = this.getOptions();
        var filters = this.getFilters();
        this._preventAndStop(event);
        forEach(this.uploader._directives.over, this._removeOverClass, this);
        this.uploader.addToQueue(transfer.files, options, filters);
       }
      },
      onDragOver: {
       /**
        * Event handler
        */

       value: function onDragOver(event) {
        var transfer = this._getTransfer(event);
        if (!this._haveFiles(transfer.types)) {
         return;
        }transfer.dropEffect = "copy";
        this._preventAndStop(event);
        forEach(this.uploader._directives.over, this._addOverClass, this);
       }
      },
      onDragLeave: {
       /**
        * Event handler
        */

       value: function onDragLeave(event) {
        if (event.currentTarget === this.element[0]) {
         return;
        }this._preventAndStop(event);
        forEach(this.uploader._directives.over, this._removeOverClass, this);
       }
      },
      _getTransfer: {
       /**
        * Helper
        */

       value: function _getTransfer(event) {
        return event.dataTransfer ? event.dataTransfer : event.originalEvent.dataTransfer; // jQuery fix;
       }
      },
      _preventAndStop: {
       /**
        * Helper
        */

       value: function _preventAndStop(event) {
        event.preventDefault();
        event.stopPropagation();
       }
      },
      _haveFiles: {
       /**
        * Returns "true" if types contains files
        * @param {Object} types
        */

       value: function _haveFiles(types) {
        if (!types) {
         return false;
        }if (types.indexOf) {
         return types.indexOf("Files") !== -1;
        } else if (types.contains) {
         return types.contains("Files");
        } else {
         return false;
        }
       }
      },
      _addOverClass: {
       /**
        * Callback
        */

       value: function _addOverClass(item) {
        item.addOverClass();
       }
      },
      _removeOverClass: {
       /**
        * Callback
        */

       value: function _removeOverClass(item) {
        item.removeOverClass();
       }
      }
     });

     return FileDrop;
    })(FileDirective);

    return FileDrop;
   };

   module.exports.$inject = ["FileDirective"];

   /***/ },
  /* 9 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var _createClass = (function () { function defineProperties(target, props) { for (var key in props) { var prop = props[key]; prop.configurable = true; if (prop.value) prop.writable = true; } Object.defineProperties(target, props); } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

   var _get = function get(object, property, receiver) { var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc && desc.writable) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

   var _inherits = function (subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) subClass.__proto__ = superClass; };

   var _classCallCheck = function (instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } };

   var CONFIG = _interopRequire(__webpack_require__(1));

   var extend = angular.extend;

   module.exports = function (FileDirective) {
    var FileOver = (function (_FileDirective) {
     /**
      * Creates instance of {FileDrop} object
      * @param {Object} options
      * @constructor
      */

     function FileOver(options) {
      _classCallCheck(this, FileOver);

      var extendedOptions = extend(options, {
       // Map of events
       events: {
        $destroy: "destroy"
       },
       // Name of property inside uploader._directive object
       prop: "over",
       // Over class
       overClass: "nv-file-over"
      });

      _get(Object.getPrototypeOf(FileOver.prototype), "constructor", this).call(this, extendedOptions);
     }

     _inherits(FileOver, _FileDirective);

     _createClass(FileOver, {
      addOverClass: {
       /**
        * Adds over class
        */

       value: function addOverClass() {
        this.element.addClass(this.getOverClass());
       }
      },
      removeOverClass: {
       /**
        * Removes over class
        */

       value: function removeOverClass() {
        this.element.removeClass(this.getOverClass());
       }
      },
      getOverClass: {
       /**
        * Returns over class
        * @returns {String}
        */

       value: function getOverClass() {
        return this.overClass;
       }
      }
     });

     return FileOver;
    })(FileDirective);

    return FileOver;
   };

   module.exports.$inject = ["FileDirective"];

   /***/ },
  /* 10 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var CONFIG = _interopRequire(__webpack_require__(1));

   module.exports = function ($parse, FileUploader, FileSelect) {

    return {
     link: function (scope, element, attributes) {
      var uploader = scope.$eval(attributes.uploader);

      if (!(uploader instanceof FileUploader)) {
       throw new TypeError("\"Uploader\" must be an instance of FileUploader");
      }

      var object = new FileSelect({
       uploader: uploader,
       element: element
      });

      object.getOptions = $parse(attributes.options).bind(object, scope);
      object.getFilters = function () {
       return attributes.filters;
      };
     }
    };
   };

   module.exports.$inject = ["$parse", "FileUploader", "FileSelect"];

   /***/ },
  /* 11 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var CONFIG = _interopRequire(__webpack_require__(1));

   module.exports = function ($parse, FileUploader, FileDrop) {

    return {
     link: function (scope, element, attributes) {
      var uploader = scope.$eval(attributes.uploader);

      if (!(uploader instanceof FileUploader)) {
       throw new TypeError("\"Uploader\" must be an instance of FileUploader");
      }

      if (!uploader.isHTML5) return;

      var object = new FileDrop({
       uploader: uploader,
       element: element
      });

      object.getOptions = $parse(attributes.options).bind(object, scope);
      object.getFilters = function () {
       return attributes.filters;
      };
     }
    };
   };

   module.exports.$inject = ["$parse", "FileUploader", "FileDrop"];

   /***/ },
  /* 12 */
  /***/ function(module, exports, __webpack_require__) {

   "use strict";

   var _interopRequire = function (obj) { return obj && obj.__esModule ? obj["default"] : obj; };

   var CONFIG = _interopRequire(__webpack_require__(1));

   module.exports = function (FileUploader, FileOver) {

    return {
     link: function (scope, element, attributes) {
      var uploader = scope.$eval(attributes.uploader);

      if (!(uploader instanceof FileUploader)) {
       throw new TypeError("\"Uploader\" must be an instance of FileUploader");
      }

      var object = new FileOver({
       uploader: uploader,
       element: element
      });

      object.getOverClass = function () {
       return attributes.overClass || object.overClass;
      };
     }
    };
   };

   module.exports.$inject = ["FileUploader", "FileOver"];

   /***/ }
  /******/ ])
});
;
//# sourceMappingURL=angular-file-upload.js.map;
/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>2)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.6",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.6",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.6",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.6",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.6",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.6",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");
d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.6",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);;
/*! jQuery v2.1.4 | (c) 2005, 2015 jQuery Foundation, Inc. | jquery.org/license */
!function(a,b){"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){var c=[],d=c.slice,e=c.concat,f=c.push,g=c.indexOf,h={},i=h.toString,j=h.hasOwnProperty,k={},l=a.document,m="2.1.4",n=function(a,b){return new n.fn.init(a,b)},o=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,p=/^-ms-/,q=/-([\da-z])/gi,r=function(a,b){return b.toUpperCase()};n.fn=n.prototype={jquery:m,constructor:n,selector:"",length:0,toArray:function(){return d.call(this)},get:function(a){return null!=a?0>a?this[a+this.length]:this[a]:d.call(this)},pushStack:function(a){var b=n.merge(this.constructor(),a);return b.prevObject=this,b.context=this.context,b},each:function(a,b){return n.each(this,a,b)},map:function(a){return this.pushStack(n.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(d.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(0>a?b:0);return this.pushStack(c>=0&&b>c?[this[c]]:[])},end:function(){return this.prevObject||this.constructor(null)},push:f,sort:c.sort,splice:c.splice},n.extend=n.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||n.isFunction(g)||(g={}),h===i&&(g=this,h--);i>h;h++)if(null!=(a=arguments[h]))for(b in a)c=g[b],d=a[b],g!==d&&(j&&d&&(n.isPlainObject(d)||(e=n.isArray(d)))?(e?(e=!1,f=c&&n.isArray(c)?c:[]):f=c&&n.isPlainObject(c)?c:{},g[b]=n.extend(j,f,d)):void 0!==d&&(g[b]=d));return g},n.extend({expando:"jQuery"+(m+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===n.type(a)},isArray:Array.isArray,isWindow:function(a){return null!=a&&a===a.window},isNumeric:function(a){return!n.isArray(a)&&a-parseFloat(a)+1>=0},isPlainObject:function(a){return"object"!==n.type(a)||a.nodeType||n.isWindow(a)?!1:a.constructor&&!j.call(a.constructor.prototype,"isPrototypeOf")?!1:!0},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?h[i.call(a)]||"object":typeof a},globalEval:function(a){var b,c=eval;a=n.trim(a),a&&(1===a.indexOf("use strict")?(b=l.createElement("script"),b.text=a,l.head.appendChild(b).parentNode.removeChild(b)):c(a))},camelCase:function(a){return a.replace(p,"ms-").replace(q,r)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()},each:function(a,b,c){var d,e=0,f=a.length,g=s(a);if(c){if(g){for(;f>e;e++)if(d=b.apply(a[e],c),d===!1)break}else for(e in a)if(d=b.apply(a[e],c),d===!1)break}else if(g){for(;f>e;e++)if(d=b.call(a[e],e,a[e]),d===!1)break}else for(e in a)if(d=b.call(a[e],e,a[e]),d===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(o,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(s(Object(a))?n.merge(c,"string"==typeof a?[a]:a):f.call(c,a)),c},inArray:function(a,b,c){return null==b?-1:g.call(b,a,c)},merge:function(a,b){for(var c=+b.length,d=0,e=a.length;c>d;d++)a[e++]=b[d];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;g>f;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,f=0,g=a.length,h=s(a),i=[];if(h)for(;g>f;f++)d=b(a[f],f,c),null!=d&&i.push(d);else for(f in a)d=b(a[f],f,c),null!=d&&i.push(d);return e.apply([],i)},guid:1,proxy:function(a,b){var c,e,f;return"string"==typeof b&&(c=a[b],b=a,a=c),n.isFunction(a)?(e=d.call(arguments,2),f=function(){return a.apply(b||this,e.concat(d.call(arguments)))},f.guid=a.guid=a.guid||n.guid++,f):void 0},now:Date.now,support:k}),n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(a,b){h["[object "+b+"]"]=b.toLowerCase()});function s(a){var b="length"in a&&a.length,c=n.type(a);return"function"===c||n.isWindow(a)?!1:1===a.nodeType&&b?!0:"array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a}var t=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=ha(),z=ha(),A=ha(),B=function(a,b){return a===b&&(l=!0),0},C=1<<31,D={}.hasOwnProperty,E=[],F=E.pop,G=E.push,H=E.push,I=E.slice,J=function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},K="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",L="[\\x20\\t\\r\\n\\f]",M="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",N=M.replace("w","w#"),O="\\["+L+"*("+M+")(?:"+L+"*([*^$|!~]?=)"+L+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+N+"))|)"+L+"*\\]",P=":("+M+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+O+")*)|.*)\\)|)",Q=new RegExp(L+"+","g"),R=new RegExp("^"+L+"+|((?:^|[^\\\\])(?:\\\\.)*)"+L+"+$","g"),S=new RegExp("^"+L+"*,"+L+"*"),T=new RegExp("^"+L+"*([>+~]|"+L+")"+L+"*"),U=new RegExp("="+L+"*([^\\]'\"]*?)"+L+"*\\]","g"),V=new RegExp(P),W=new RegExp("^"+N+"$"),X={ID:new RegExp("^#("+M+")"),CLASS:new RegExp("^\\.("+M+")"),TAG:new RegExp("^("+M.replace("w","w*")+")"),ATTR:new RegExp("^"+O),PSEUDO:new RegExp("^"+P),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+L+"*(even|odd|(([+-]|)(\\d*)n|)"+L+"*(?:([+-]|)"+L+"*(\\d+)|))"+L+"*\\)|)","i"),bool:new RegExp("^(?:"+K+")$","i"),needsContext:new RegExp("^"+L+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+L+"*((?:-\\d)?\\d*)"+L+"*\\)|)(?=[^-]|$)","i")},Y=/^(?:input|select|textarea|button)$/i,Z=/^h\d$/i,$=/^[^{]+\{\s*\[native \w/,_=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,aa=/[+~]/,ba=/'|\\/g,ca=new RegExp("\\\\([\\da-f]{1,6}"+L+"?|("+L+")|.)","ig"),da=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:0>d?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},ea=function(){m()};try{H.apply(E=I.call(v.childNodes),v.childNodes),E[v.childNodes.length].nodeType}catch(fa){H={apply:E.length?function(a,b){G.apply(a,I.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function ga(a,b,d,e){var f,h,j,k,l,o,r,s,w,x;if((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,d=d||[],k=b.nodeType,"string"!=typeof a||!a||1!==k&&9!==k&&11!==k)return d;if(!e&&p){if(11!==k&&(f=_.exec(a)))if(j=f[1]){if(9===k){if(h=b.getElementById(j),!h||!h.parentNode)return d;if(h.id===j)return d.push(h),d}else if(b.ownerDocument&&(h=b.ownerDocument.getElementById(j))&&t(b,h)&&h.id===j)return d.push(h),d}else{if(f[2])return H.apply(d,b.getElementsByTagName(a)),d;if((j=f[3])&&c.getElementsByClassName)return H.apply(d,b.getElementsByClassName(j)),d}if(c.qsa&&(!q||!q.test(a))){if(s=r=u,w=b,x=1!==k&&a,1===k&&"object"!==b.nodeName.toLowerCase()){o=g(a),(r=b.getAttribute("id"))?s=r.replace(ba,"\\$&"):b.setAttribute("id",s),s="[id='"+s+"'] ",l=o.length;while(l--)o[l]=s+ra(o[l]);w=aa.test(a)&&pa(b.parentNode)||b,x=o.join(",")}if(x)try{return H.apply(d,w.querySelectorAll(x)),d}catch(y){}finally{r||b.removeAttribute("id")}}}return i(a.replace(R,"$1"),b,d,e)}function ha(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ia(a){return a[u]=!0,a}function ja(a){var b=n.createElement("div");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function ka(a,b){var c=a.split("|"),e=a.length;while(e--)d.attrHandle[c[e]]=b}function la(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&(~b.sourceIndex||C)-(~a.sourceIndex||C);if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function ma(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function na(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function oa(a){return ia(function(b){return b=+b,ia(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function pa(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=ga.support={},f=ga.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return b?"HTML"!==b.nodeName:!1},m=ga.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=g.documentElement,e=g.defaultView,e&&e!==e.top&&(e.addEventListener?e.addEventListener("unload",ea,!1):e.attachEvent&&e.attachEvent("onunload",ea)),p=!f(g),c.attributes=ja(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=ja(function(a){return a.appendChild(g.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=$.test(g.getElementsByClassName),c.getById=ja(function(a){return o.appendChild(a).id=u,!g.getElementsByName||!g.getElementsByName(u).length}),c.getById?(d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c&&c.parentNode?[c]:[]}},d.filter.ID=function(a){var b=a.replace(ca,da);return function(a){return a.getAttribute("id")===b}}):(delete d.find.ID,d.filter.ID=function(a){var b=a.replace(ca,da);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){return p?b.getElementsByClassName(a):void 0},r=[],q=[],(c.qsa=$.test(g.querySelectorAll))&&(ja(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\f]' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+L+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+L+"*(?:value|"+K+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),ja(function(a){var b=g.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+L+"*[*^$|!~]?="),a.querySelectorAll(":enabled").length||q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=$.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&ja(function(a){c.disconnectedMatch=s.call(a,"div"),s.call(a,"[s!='']:x"),r.push("!=",P)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=$.test(o.compareDocumentPosition),t=b||$.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===g||a.ownerDocument===v&&t(v,a)?-1:b===g||b.ownerDocument===v&&t(v,b)?1:k?J(k,a)-J(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,h=[a],i=[b];if(!e||!f)return a===g?-1:b===g?1:e?-1:f?1:k?J(k,a)-J(k,b):0;if(e===f)return la(a,b);c=a;while(c=c.parentNode)h.unshift(c);c=b;while(c=c.parentNode)i.unshift(c);while(h[d]===i[d])d++;return d?la(h[d],i[d]):h[d]===v?-1:i[d]===v?1:0},g):n},ga.matches=function(a,b){return ga(a,null,null,b)},ga.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(U,"='$1']"),!(!c.matchesSelector||!p||r&&r.test(b)||q&&q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return ga(b,n,null,[a]).length>0},ga.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},ga.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&D.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},ga.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},ga.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=ga.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=ga.selectors={cacheLength:50,createPseudo:ia,match:X,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(ca,da),a[3]=(a[3]||a[4]||a[5]||"").replace(ca,da),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||ga.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&ga.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return X.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&V.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(ca,da).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+L+")"+a+"("+L+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=ga.attr(d,a);return null==e?"!="===b:b?(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(Q," ")+" ").indexOf(c)>-1:"|="===b?e===c||e.slice(0,c.length+1)===c+"-":!1):!0}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h;if(q){if(f){while(p){l=b;while(l=l[p])if(h?l.nodeName.toLowerCase()===r:1===l.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){k=q[u]||(q[u]={}),j=k[a]||[],n=j[0]===w&&j[1],m=j[0]===w&&j[2],l=n&&q.childNodes[n];while(l=++n&&l&&l[p]||(m=n=0)||o.pop())if(1===l.nodeType&&++m&&l===b){k[a]=[w,n,m];break}}else if(s&&(j=(b[u]||(b[u]={}))[a])&&j[0]===w)m=j[1];else while(l=++n&&l&&l[p]||(m=n=0)||o.pop())if((h?l.nodeName.toLowerCase()===r:1===l.nodeType)&&++m&&(s&&((l[u]||(l[u]={}))[a]=[w,m]),l===b))break;return m-=e,m===d||m%d===0&&m/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||ga.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ia(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=J(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ia(function(a){var b=[],c=[],d=h(a.replace(R,"$1"));return d[u]?ia(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ia(function(a){return function(b){return ga(a,b).length>0}}),contains:ia(function(a){return a=a.replace(ca,da),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ia(function(a){return W.test(a||"")||ga.error("unsupported lang: "+a),a=a.replace(ca,da).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:function(a){return a.disabled===!1},disabled:function(a){return a.disabled===!0},checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return Z.test(a.nodeName)},input:function(a){return Y.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:oa(function(){return[0]}),last:oa(function(a,b){return[b-1]}),eq:oa(function(a,b,c){return[0>c?c+b:c]}),even:oa(function(a,b){for(var c=0;b>c;c+=2)a.push(c);return a}),odd:oa(function(a,b){for(var c=1;b>c;c+=2)a.push(c);return a}),lt:oa(function(a,b,c){for(var d=0>c?c+b:c;--d>=0;)a.push(d);return a}),gt:oa(function(a,b,c){for(var d=0>c?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=ma(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=na(b);function qa(){}qa.prototype=d.filters=d.pseudos,d.setFilters=new qa,g=ga.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){(!c||(e=S.exec(h)))&&(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=T.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(R," ")}),h=h.slice(c.length));for(g in d.filter)!(e=X[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?ga.error(a):z(a,i).slice(0)};function ra(a){for(var b=0,c=a.length,d="";c>b;b++)d+=a[b].value;return d}function sa(a,b,c){var d=b.dir,e=c&&"parentNode"===d,f=x++;return b.first?function(b,c,f){while(b=b[d])if(1===b.nodeType||e)return a(b,c,f)}:function(b,c,g){var h,i,j=[w,f];if(g){while(b=b[d])if((1===b.nodeType||e)&&a(b,c,g))return!0}else while(b=b[d])if(1===b.nodeType||e){if(i=b[u]||(b[u]={}),(h=i[d])&&h[0]===w&&h[1]===f)return j[2]=h[2];if(i[d]=j,j[2]=a(b,c,g))return!0}}}function ta(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function ua(a,b,c){for(var d=0,e=b.length;e>d;d++)ga(a,b[d],c);return c}function va(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;i>h;h++)(f=a[h])&&(!c||c(f,d,e))&&(g.push(f),j&&b.push(h));return g}function wa(a,b,c,d,e,f){return d&&!d[u]&&(d=wa(d)),e&&!e[u]&&(e=wa(e,f)),ia(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||ua(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:va(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=va(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?J(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=va(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):H.apply(g,r)})}function xa(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=sa(function(a){return a===b},h,!0),l=sa(function(a){return J(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];f>i;i++)if(c=d.relative[a[i].type])m=[sa(ta(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;f>e;e++)if(d.relative[a[e].type])break;return wa(i>1&&ta(m),i>1&&ra(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(R,"$1"),c,e>i&&xa(a.slice(i,e)),f>e&&xa(a=a.slice(e)),f>e&&ra(a))}m.push(c)}return ta(m)}function ya(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,m,o,p=0,q="0",r=f&&[],s=[],t=j,u=f||e&&d.find.TAG("*",k),v=w+=null==t?1:Math.random()||.1,x=u.length;for(k&&(j=g!==n&&g);q!==x&&null!=(l=u[q]);q++){if(e&&l){m=0;while(o=a[m++])if(o(l,g,h)){i.push(l);break}k&&(w=v)}c&&((l=!o&&l)&&p--,f&&r.push(l))}if(p+=q,c&&q!==p){m=0;while(o=b[m++])o(r,s,g,h);if(f){if(p>0)while(q--)r[q]||s[q]||(s[q]=F.call(i));s=va(s)}H.apply(i,s),k&&!f&&s.length>0&&p+b.length>1&&ga.uniqueSort(i)}return k&&(w=v,j=t),r};return c?ia(f):f}return h=ga.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=xa(b[c]),f[u]?d.push(f):e.push(f);f=A(a,ya(e,d)),f.selector=a}return f},i=ga.select=function(a,b,e,f){var i,j,k,l,m,n="function"==typeof a&&a,o=!f&&g(a=n.selector||a);if(e=e||[],1===o.length){if(j=o[0]=o[0].slice(0),j.length>2&&"ID"===(k=j[0]).type&&c.getById&&9===b.nodeType&&p&&d.relative[j[1].type]){if(b=(d.find.ID(k.matches[0].replace(ca,da),b)||[])[0],!b)return e;n&&(b=b.parentNode),a=a.slice(j.shift().value.length)}i=X.needsContext.test(a)?0:j.length;while(i--){if(k=j[i],d.relative[l=k.type])break;if((m=d.find[l])&&(f=m(k.matches[0].replace(ca,da),aa.test(j[0].type)&&pa(b.parentNode)||b))){if(j.splice(i,1),a=f.length&&ra(j),!a)return H.apply(e,f),e;break}}}return(n||h(a,o))(f,b,!p,e,aa.test(a)&&pa(b.parentNode)||b),e},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=ja(function(a){return 1&a.compareDocumentPosition(n.createElement("div"))}),ja(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||ka("type|href|height|width",function(a,b,c){return c?void 0:a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&ja(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||ka("value",function(a,b,c){return c||"input"!==a.nodeName.toLowerCase()?void 0:a.defaultValue}),ja(function(a){return null==a.getAttribute("disabled")})||ka(K,function(a,b,c){var d;return c?void 0:a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),ga}(a);n.find=t,n.expr=t.selectors,n.expr[":"]=n.expr.pseudos,n.unique=t.uniqueSort,n.text=t.getText,n.isXMLDoc=t.isXML,n.contains=t.contains;var u=n.expr.match.needsContext,v=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,w=/^.[^:#\[\.,]*$/;function x(a,b,c){if(n.isFunction(b))return n.grep(a,function(a,d){return!!b.call(a,d,a)!==c});if(b.nodeType)return n.grep(a,function(a){return a===b!==c});if("string"==typeof b){if(w.test(b))return n.filter(b,a,c);b=n.filter(b,a)}return n.grep(a,function(a){return g.call(b,a)>=0!==c})}n.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?n.find.matchesSelector(d,a)?[d]:[]:n.find.matches(a,n.grep(b,function(a){return 1===a.nodeType}))},n.fn.extend({find:function(a){var b,c=this.length,d=[],e=this;if("string"!=typeof a)return this.pushStack(n(a).filter(function(){for(b=0;c>b;b++)if(n.contains(e[b],this))return!0}));for(b=0;c>b;b++)n.find(a,e[b],d);return d=this.pushStack(c>1?n.unique(d):d),d.selector=this.selector?this.selector+" "+a:a,d},filter:function(a){return this.pushStack(x(this,a||[],!1))},not:function(a){return this.pushStack(x(this,a||[],!0))},is:function(a){return!!x(this,"string"==typeof a&&u.test(a)?n(a):a||[],!1).length}});var y,z=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,A=n.fn.init=function(a,b){var c,d;if(!a)return this;if("string"==typeof a){if(c="<"===a[0]&&">"===a[a.length-1]&&a.length>=3?[null,a,null]:z.exec(a),!c||!c[1]&&b)return!b||b.jquery?(b||y).find(a):this.constructor(b).find(a);if(c[1]){if(b=b instanceof n?b[0]:b,n.merge(this,n.parseHTML(c[1],b&&b.nodeType?b.ownerDocument||b:l,!0)),v.test(c[1])&&n.isPlainObject(b))for(c in b)n.isFunction(this[c])?this[c](b[c]):this.attr(c,b[c]);return this}return d=l.getElementById(c[2]),d&&d.parentNode&&(this.length=1,this[0]=d),this.context=l,this.selector=a,this}return a.nodeType?(this.context=this[0]=a,this.length=1,this):n.isFunction(a)?"undefined"!=typeof y.ready?y.ready(a):a(n):(void 0!==a.selector&&(this.selector=a.selector,this.context=a.context),n.makeArray(a,this))};A.prototype=n.fn,y=n(l);var B=/^(?:parents|prev(?:Until|All))/,C={children:!0,contents:!0,next:!0,prev:!0};n.extend({dir:function(a,b,c){var d=[],e=void 0!==c;while((a=a[b])&&9!==a.nodeType)if(1===a.nodeType){if(e&&n(a).is(c))break;d.push(a)}return d},sibling:function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c}}),n.fn.extend({has:function(a){var b=n(a,this),c=b.length;return this.filter(function(){for(var a=0;c>a;a++)if(n.contains(this,b[a]))return!0})},closest:function(a,b){for(var c,d=0,e=this.length,f=[],g=u.test(a)||"string"!=typeof a?n(a,b||this.context):0;e>d;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&n.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?n.unique(f):f)},index:function(a){return a?"string"==typeof a?g.call(n(a),this[0]):g.call(this,a.jquery?a[0]:a):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(n.unique(n.merge(this.get(),n(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function D(a,b){while((a=a[b])&&1!==a.nodeType);return a}n.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return n.dir(a,"parentNode")},parentsUntil:function(a,b,c){return n.dir(a,"parentNode",c)},next:function(a){return D(a,"nextSibling")},prev:function(a){return D(a,"previousSibling")},nextAll:function(a){return n.dir(a,"nextSibling")},prevAll:function(a){return n.dir(a,"previousSibling")},nextUntil:function(a,b,c){return n.dir(a,"nextSibling",c)},prevUntil:function(a,b,c){return n.dir(a,"previousSibling",c)},siblings:function(a){return n.sibling((a.parentNode||{}).firstChild,a)},children:function(a){return n.sibling(a.firstChild)},contents:function(a){return a.contentDocument||n.merge([],a.childNodes)}},function(a,b){n.fn[a]=function(c,d){var e=n.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=n.filter(d,e)),this.length>1&&(C[a]||n.unique(e),B.test(a)&&e.reverse()),this.pushStack(e)}});var E=/\S+/g,F={};function G(a){var b=F[a]={};return n.each(a.match(E)||[],function(a,c){b[c]=!0}),b}n.Callbacks=function(a){a="string"==typeof a?F[a]||G(a):n.extend({},a);var b,c,d,e,f,g,h=[],i=!a.once&&[],j=function(l){for(b=a.memory&&l,c=!0,g=e||0,e=0,f=h.length,d=!0;h&&f>g;g++)if(h[g].apply(l[0],l[1])===!1&&a.stopOnFalse){b=!1;break}d=!1,h&&(i?i.length&&j(i.shift()):b?h=[]:k.disable())},k={add:function(){if(h){var c=h.length;!function g(b){n.each(b,function(b,c){var d=n.type(c);"function"===d?a.unique&&k.has(c)||h.push(c):c&&c.length&&"string"!==d&&g(c)})}(arguments),d?f=h.length:b&&(e=c,j(b))}return this},remove:function(){return h&&n.each(arguments,function(a,b){var c;while((c=n.inArray(b,h,c))>-1)h.splice(c,1),d&&(f>=c&&f--,g>=c&&g--)}),this},has:function(a){return a?n.inArray(a,h)>-1:!(!h||!h.length)},empty:function(){return h=[],f=0,this},disable:function(){return h=i=b=void 0,this},disabled:function(){return!h},lock:function(){return i=void 0,b||k.disable(),this},locked:function(){return!i},fireWith:function(a,b){return!h||c&&!i||(b=b||[],b=[a,b.slice?b.slice():b],d?i.push(b):j(b)),this},fire:function(){return k.fireWith(this,arguments),this},fired:function(){return!!c}};return k},n.extend({Deferred:function(a){var b=[["resolve","done",n.Callbacks("once memory"),"resolved"],["reject","fail",n.Callbacks("once memory"),"rejected"],["notify","progress",n.Callbacks("memory")]],c="pending",d={state:function(){return c},always:function(){return e.done(arguments).fail(arguments),this},then:function(){var a=arguments;return n.Deferred(function(c){n.each(b,function(b,f){var g=n.isFunction(a[b])&&a[b];e[f[1]](function(){var a=g&&g.apply(this,arguments);a&&n.isFunction(a.promise)?a.promise().done(c.resolve).fail(c.reject).progress(c.notify):c[f[0]+"With"](this===d?c.promise():this,g?[a]:arguments)})}),a=null}).promise()},promise:function(a){return null!=a?n.extend(a,d):d}},e={};return d.pipe=d.then,n.each(b,function(a,f){var g=f[2],h=f[3];d[f[1]]=g.add,h&&g.add(function(){c=h},b[1^a][2].disable,b[2][2].lock),e[f[0]]=function(){return e[f[0]+"With"](this===e?d:this,arguments),this},e[f[0]+"With"]=g.fireWith}),d.promise(e),a&&a.call(e,e),e},when:function(a){var b=0,c=d.call(arguments),e=c.length,f=1!==e||a&&n.isFunction(a.promise)?e:0,g=1===f?a:n.Deferred(),h=function(a,b,c){return function(e){b[a]=this,c[a]=arguments.length>1?d.call(arguments):e,c===i?g.notifyWith(b,c):--f||g.resolveWith(b,c)}},i,j,k;if(e>1)for(i=new Array(e),j=new Array(e),k=new Array(e);e>b;b++)c[b]&&n.isFunction(c[b].promise)?c[b].promise().done(h(b,k,c)).fail(g.reject).progress(h(b,j,i)):--f;return f||g.resolveWith(k,c),g.promise()}});var H;n.fn.ready=function(a){return n.ready.promise().done(a),this},n.extend({isReady:!1,readyWait:1,holdReady:function(a){a?n.readyWait++:n.ready(!0)},ready:function(a){(a===!0?--n.readyWait:n.isReady)||(n.isReady=!0,a!==!0&&--n.readyWait>0||(H.resolveWith(l,[n]),n.fn.triggerHandler&&(n(l).triggerHandler("ready"),n(l).off("ready"))))}});function I(){l.removeEventListener("DOMContentLoaded",I,!1),a.removeEventListener("load",I,!1),n.ready()}n.ready.promise=function(b){return H||(H=n.Deferred(),"complete"===l.readyState?setTimeout(n.ready):(l.addEventListener("DOMContentLoaded",I,!1),a.addEventListener("load",I,!1))),H.promise(b)},n.ready.promise();var J=n.access=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===n.type(c)){e=!0;for(h in c)n.access(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,n.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(n(a),c)})),b))for(;i>h;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f};n.acceptData=function(a){return 1===a.nodeType||9===a.nodeType||!+a.nodeType};function K(){Object.defineProperty(this.cache={},0,{get:function(){return{}}}),this.expando=n.expando+K.uid++}K.uid=1,K.accepts=n.acceptData,K.prototype={key:function(a){if(!K.accepts(a))return 0;var b={},c=a[this.expando];if(!c){c=K.uid++;try{b[this.expando]={value:c},Object.defineProperties(a,b)}catch(d){b[this.expando]=c,n.extend(a,b)}}return this.cache[c]||(this.cache[c]={}),c},set:function(a,b,c){var d,e=this.key(a),f=this.cache[e];if("string"==typeof b)f[b]=c;else if(n.isEmptyObject(f))n.extend(this.cache[e],b);else for(d in b)f[d]=b[d];return f},get:function(a,b){var c=this.cache[this.key(a)];return void 0===b?c:c[b]},access:function(a,b,c){var d;return void 0===b||b&&"string"==typeof b&&void 0===c?(d=this.get(a,b),void 0!==d?d:this.get(a,n.camelCase(b))):(this.set(a,b,c),void 0!==c?c:b)},remove:function(a,b){var c,d,e,f=this.key(a),g=this.cache[f];if(void 0===b)this.cache[f]={};else{n.isArray(b)?d=b.concat(b.map(n.camelCase)):(e=n.camelCase(b),b in g?d=[b,e]:(d=e,d=d in g?[d]:d.match(E)||[])),c=d.length;while(c--)delete g[d[c]]}},hasData:function(a){return!n.isEmptyObject(this.cache[a[this.expando]]||{})},discard:function(a){a[this.expando]&&delete this.cache[a[this.expando]]}};var L=new K,M=new K,N=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,O=/([A-Z])/g;function P(a,b,c){var d;if(void 0===c&&1===a.nodeType)if(d="data-"+b.replace(O,"-$1").toLowerCase(),c=a.getAttribute(d),"string"==typeof c){try{c="true"===c?!0:"false"===c?!1:"null"===c?null:+c+""===c?+c:N.test(c)?n.parseJSON(c):c}catch(e){}M.set(a,b,c)}else c=void 0;return c}n.extend({hasData:function(a){return M.hasData(a)||L.hasData(a)},data:function(a,b,c){
return M.access(a,b,c)},removeData:function(a,b){M.remove(a,b)},_data:function(a,b,c){return L.access(a,b,c)},_removeData:function(a,b){L.remove(a,b)}}),n.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=M.get(f),1===f.nodeType&&!L.get(f,"hasDataAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=n.camelCase(d.slice(5)),P(f,d,e[d])));L.set(f,"hasDataAttrs",!0)}return e}return"object"==typeof a?this.each(function(){M.set(this,a)}):J(this,function(b){var c,d=n.camelCase(a);if(f&&void 0===b){if(c=M.get(f,a),void 0!==c)return c;if(c=M.get(f,d),void 0!==c)return c;if(c=P(f,d,void 0),void 0!==c)return c}else this.each(function(){var c=M.get(this,d);M.set(this,d,b),-1!==a.indexOf("-")&&void 0!==c&&M.set(this,a,b)})},null,b,arguments.length>1,null,!0)},removeData:function(a){return this.each(function(){M.remove(this,a)})}}),n.extend({queue:function(a,b,c){var d;return a?(b=(b||"fx")+"queue",d=L.get(a,b),c&&(!d||n.isArray(c)?d=L.access(a,b,n.makeArray(c)):d.push(c)),d||[]):void 0},dequeue:function(a,b){b=b||"fx";var c=n.queue(a,b),d=c.length,e=c.shift(),f=n._queueHooks(a,b),g=function(){n.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return L.get(a,c)||L.access(a,c,{empty:n.Callbacks("once memory").add(function(){L.remove(a,[b+"queue",c])})})}}),n.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?n.queue(this[0],a):void 0===b?this:this.each(function(){var c=n.queue(this,a,b);n._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&n.dequeue(this,a)})},dequeue:function(a){return this.each(function(){n.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=n.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=L.get(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}});var Q=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,R=["Top","Right","Bottom","Left"],S=function(a,b){return a=b||a,"none"===n.css(a,"display")||!n.contains(a.ownerDocument,a)},T=/^(?:checkbox|radio)$/i;!function(){var a=l.createDocumentFragment(),b=a.appendChild(l.createElement("div")),c=l.createElement("input");c.setAttribute("type","radio"),c.setAttribute("checked","checked"),c.setAttribute("name","t"),b.appendChild(c),k.checkClone=b.cloneNode(!0).cloneNode(!0).lastChild.checked,b.innerHTML="<textarea>x</textarea>",k.noCloneChecked=!!b.cloneNode(!0).lastChild.defaultValue}();var U="undefined";k.focusinBubbles="onfocusin"in a;var V=/^key/,W=/^(?:mouse|pointer|contextmenu)|click/,X=/^(?:focusinfocus|focusoutblur)$/,Y=/^([^.]*)(?:\.(.+)|)$/;function Z(){return!0}function $(){return!1}function _(){try{return l.activeElement}catch(a){}}n.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=L.get(a);if(r){c.handler&&(f=c,c=f.handler,e=f.selector),c.guid||(c.guid=n.guid++),(i=r.events)||(i=r.events={}),(g=r.handle)||(g=r.handle=function(b){return typeof n!==U&&n.event.triggered!==b.type?n.event.dispatch.apply(a,arguments):void 0}),b=(b||"").match(E)||[""],j=b.length;while(j--)h=Y.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o&&(l=n.event.special[o]||{},o=(e?l.delegateType:l.bindType)||o,l=n.event.special[o]||{},k=n.extend({type:o,origType:q,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&n.expr.match.needsContext.test(e),namespace:p.join(".")},f),(m=i[o])||(m=i[o]=[],m.delegateCount=0,l.setup&&l.setup.call(a,d,p,g)!==!1||a.addEventListener&&a.addEventListener(o,g,!1)),l.add&&(l.add.call(a,k),k.handler.guid||(k.handler.guid=c.guid)),e?m.splice(m.delegateCount++,0,k):m.push(k),n.event.global[o]=!0)}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=L.hasData(a)&&L.get(a);if(r&&(i=r.events)){b=(b||"").match(E)||[""],j=b.length;while(j--)if(h=Y.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o){l=n.event.special[o]||{},o=(d?l.delegateType:l.bindType)||o,m=i[o]||[],h=h[2]&&new RegExp("(^|\\.)"+p.join("\\.(?:.*\\.|)")+"(\\.|$)"),g=f=m.length;while(f--)k=m[f],!e&&q!==k.origType||c&&c.guid!==k.guid||h&&!h.test(k.namespace)||d&&d!==k.selector&&("**"!==d||!k.selector)||(m.splice(f,1),k.selector&&m.delegateCount--,l.remove&&l.remove.call(a,k));g&&!m.length&&(l.teardown&&l.teardown.call(a,p,r.handle)!==!1||n.removeEvent(a,o,r.handle),delete i[o])}else for(o in i)n.event.remove(a,o+b[j],c,d,!0);n.isEmptyObject(i)&&(delete r.handle,L.remove(a,"events"))}},trigger:function(b,c,d,e){var f,g,h,i,k,m,o,p=[d||l],q=j.call(b,"type")?b.type:b,r=j.call(b,"namespace")?b.namespace.split("."):[];if(g=h=d=d||l,3!==d.nodeType&&8!==d.nodeType&&!X.test(q+n.event.triggered)&&(q.indexOf(".")>=0&&(r=q.split("."),q=r.shift(),r.sort()),k=q.indexOf(":")<0&&"on"+q,b=b[n.expando]?b:new n.Event(q,"object"==typeof b&&b),b.isTrigger=e?2:3,b.namespace=r.join("."),b.namespace_re=b.namespace?new RegExp("(^|\\.)"+r.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=d),c=null==c?[b]:n.makeArray(c,[b]),o=n.event.special[q]||{},e||!o.trigger||o.trigger.apply(d,c)!==!1)){if(!e&&!o.noBubble&&!n.isWindow(d)){for(i=o.delegateType||q,X.test(i+q)||(g=g.parentNode);g;g=g.parentNode)p.push(g),h=g;h===(d.ownerDocument||l)&&p.push(h.defaultView||h.parentWindow||a)}f=0;while((g=p[f++])&&!b.isPropagationStopped())b.type=f>1?i:o.bindType||q,m=(L.get(g,"events")||{})[b.type]&&L.get(g,"handle"),m&&m.apply(g,c),m=k&&g[k],m&&m.apply&&n.acceptData(g)&&(b.result=m.apply(g,c),b.result===!1&&b.preventDefault());return b.type=q,e||b.isDefaultPrevented()||o._default&&o._default.apply(p.pop(),c)!==!1||!n.acceptData(d)||k&&n.isFunction(d[q])&&!n.isWindow(d)&&(h=d[k],h&&(d[k]=null),n.event.triggered=q,d[q](),n.event.triggered=void 0,h&&(d[k]=h)),b.result}},dispatch:function(a){a=n.event.fix(a);var b,c,e,f,g,h=[],i=d.call(arguments),j=(L.get(this,"events")||{})[a.type]||[],k=n.event.special[a.type]||{};if(i[0]=a,a.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,a)!==!1){h=n.event.handlers.call(this,a,j),b=0;while((f=h[b++])&&!a.isPropagationStopped()){a.currentTarget=f.elem,c=0;while((g=f.handlers[c++])&&!a.isImmediatePropagationStopped())(!a.namespace_re||a.namespace_re.test(g.namespace))&&(a.handleObj=g,a.data=g.data,e=((n.event.special[g.origType]||{}).handle||g.handler).apply(f.elem,i),void 0!==e&&(a.result=e)===!1&&(a.preventDefault(),a.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,a),a.result}},handlers:function(a,b){var c,d,e,f,g=[],h=b.delegateCount,i=a.target;if(h&&i.nodeType&&(!a.button||"click"!==a.type))for(;i!==this;i=i.parentNode||this)if(i.disabled!==!0||"click"!==a.type){for(d=[],c=0;h>c;c++)f=b[c],e=f.selector+" ",void 0===d[e]&&(d[e]=f.needsContext?n(e,this).index(i)>=0:n.find(e,this,null,[i]).length),d[e]&&d.push(f);d.length&&g.push({elem:i,handlers:d})}return h<b.length&&g.push({elem:this,handlers:b.slice(h)}),g},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){return null==a.which&&(a.which=null!=b.charCode?b.charCode:b.keyCode),a}},mouseHooks:{props:"button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,b){var c,d,e,f=b.button;return null==a.pageX&&null!=b.clientX&&(c=a.target.ownerDocument||l,d=c.documentElement,e=c.body,a.pageX=b.clientX+(d&&d.scrollLeft||e&&e.scrollLeft||0)-(d&&d.clientLeft||e&&e.clientLeft||0),a.pageY=b.clientY+(d&&d.scrollTop||e&&e.scrollTop||0)-(d&&d.clientTop||e&&e.clientTop||0)),a.which||void 0===f||(a.which=1&f?1:2&f?3:4&f?2:0),a}},fix:function(a){if(a[n.expando])return a;var b,c,d,e=a.type,f=a,g=this.fixHooks[e];g||(this.fixHooks[e]=g=W.test(e)?this.mouseHooks:V.test(e)?this.keyHooks:{}),d=g.props?this.props.concat(g.props):this.props,a=new n.Event(f),b=d.length;while(b--)c=d[b],a[c]=f[c];return a.target||(a.target=l),3===a.target.nodeType&&(a.target=a.target.parentNode),g.filter?g.filter(a,f):a},special:{load:{noBubble:!0},focus:{trigger:function(){return this!==_()&&this.focus?(this.focus(),!1):void 0},delegateType:"focusin"},blur:{trigger:function(){return this===_()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return"checkbox"===this.type&&this.click&&n.nodeName(this,"input")?(this.click(),!1):void 0},_default:function(a){return n.nodeName(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}},simulate:function(a,b,c,d){var e=n.extend(new n.Event,c,{type:a,isSimulated:!0,originalEvent:{}});d?n.event.trigger(e,null,b):n.event.dispatch.call(b,e),e.isDefaultPrevented()&&c.preventDefault()}},n.removeEvent=function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c,!1)},n.Event=function(a,b){return this instanceof n.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?Z:$):this.type=a,b&&n.extend(this,b),this.timeStamp=a&&a.timeStamp||n.now(),void(this[n.expando]=!0)):new n.Event(a,b)},n.Event.prototype={isDefaultPrevented:$,isPropagationStopped:$,isImmediatePropagationStopped:$,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=Z,a&&a.preventDefault&&a.preventDefault()},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=Z,a&&a.stopPropagation&&a.stopPropagation()},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=Z,a&&a.stopImmediatePropagation&&a.stopImmediatePropagation(),this.stopPropagation()}},n.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){n.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return(!e||e!==d&&!n.contains(d,e))&&(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),k.focusinBubbles||n.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){n.event.simulate(b,a.target,n.event.fix(a),!0)};n.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=L.access(d,b);e||d.addEventListener(a,c,!0),L.access(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=L.access(d,b)-1;e?L.access(d,b,e):(d.removeEventListener(a,c,!0),L.remove(d,b))}}}),n.fn.extend({on:function(a,b,c,d,e){var f,g;if("object"==typeof a){"string"!=typeof b&&(c=c||b,b=void 0);for(g in a)this.on(g,b,c,a[g],e);return this}if(null==c&&null==d?(d=b,c=b=void 0):null==d&&("string"==typeof b?(d=c,c=void 0):(d=c,c=b,b=void 0)),d===!1)d=$;else if(!d)return this;return 1===e&&(f=d,d=function(a){return n().off(a),f.apply(this,arguments)},d.guid=f.guid||(f.guid=n.guid++)),this.each(function(){n.event.add(this,a,d,c,b)})},one:function(a,b,c,d){return this.on(a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,n(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return(b===!1||"function"==typeof b)&&(c=b,b=void 0),c===!1&&(c=$),this.each(function(){n.event.remove(this,a,c,b)})},trigger:function(a,b){return this.each(function(){n.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];return c?n.event.trigger(a,b,c,!0):void 0}});var aa=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,ba=/<([\w:]+)/,ca=/<|&#?\w+;/,da=/<(?:script|style|link)/i,ea=/checked\s*(?:[^=]|=\s*.checked.)/i,fa=/^$|\/(?:java|ecma)script/i,ga=/^true\/(.*)/,ha=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,ia={option:[1,"<select multiple='multiple'>","</select>"],thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};ia.optgroup=ia.option,ia.tbody=ia.tfoot=ia.colgroup=ia.caption=ia.thead,ia.th=ia.td;function ja(a,b){return n.nodeName(a,"table")&&n.nodeName(11!==b.nodeType?b:b.firstChild,"tr")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function ka(a){return a.type=(null!==a.getAttribute("type"))+"/"+a.type,a}function la(a){var b=ga.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function ma(a,b){for(var c=0,d=a.length;d>c;c++)L.set(a[c],"globalEval",!b||L.get(b[c],"globalEval"))}function na(a,b){var c,d,e,f,g,h,i,j;if(1===b.nodeType){if(L.hasData(a)&&(f=L.access(a),g=L.set(b,f),j=f.events)){delete g.handle,g.events={};for(e in j)for(c=0,d=j[e].length;d>c;c++)n.event.add(b,e,j[e][c])}M.hasData(a)&&(h=M.access(a),i=n.extend({},h),M.set(b,i))}}function oa(a,b){var c=a.getElementsByTagName?a.getElementsByTagName(b||"*"):a.querySelectorAll?a.querySelectorAll(b||"*"):[];return void 0===b||b&&n.nodeName(a,b)?n.merge([a],c):c}function pa(a,b){var c=b.nodeName.toLowerCase();"input"===c&&T.test(a.type)?b.checked=a.checked:("input"===c||"textarea"===c)&&(b.defaultValue=a.defaultValue)}n.extend({clone:function(a,b,c){var d,e,f,g,h=a.cloneNode(!0),i=n.contains(a.ownerDocument,a);if(!(k.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||n.isXMLDoc(a)))for(g=oa(h),f=oa(a),d=0,e=f.length;e>d;d++)pa(f[d],g[d]);if(b)if(c)for(f=f||oa(a),g=g||oa(h),d=0,e=f.length;e>d;d++)na(f[d],g[d]);else na(a,h);return g=oa(h,"script"),g.length>0&&ma(g,!i&&oa(a,"script")),h},buildFragment:function(a,b,c,d){for(var e,f,g,h,i,j,k=b.createDocumentFragment(),l=[],m=0,o=a.length;o>m;m++)if(e=a[m],e||0===e)if("object"===n.type(e))n.merge(l,e.nodeType?[e]:e);else if(ca.test(e)){f=f||k.appendChild(b.createElement("div")),g=(ba.exec(e)||["",""])[1].toLowerCase(),h=ia[g]||ia._default,f.innerHTML=h[1]+e.replace(aa,"<$1></$2>")+h[2],j=h[0];while(j--)f=f.lastChild;n.merge(l,f.childNodes),f=k.firstChild,f.textContent=""}else l.push(b.createTextNode(e));k.textContent="",m=0;while(e=l[m++])if((!d||-1===n.inArray(e,d))&&(i=n.contains(e.ownerDocument,e),f=oa(k.appendChild(e),"script"),i&&ma(f),c)){j=0;while(e=f[j++])fa.test(e.type||"")&&c.push(e)}return k},cleanData:function(a){for(var b,c,d,e,f=n.event.special,g=0;void 0!==(c=a[g]);g++){if(n.acceptData(c)&&(e=c[L.expando],e&&(b=L.cache[e]))){if(b.events)for(d in b.events)f[d]?n.event.remove(c,d):n.removeEvent(c,d,b.handle);L.cache[e]&&delete L.cache[e]}delete M.cache[c[M.expando]]}}}),n.fn.extend({text:function(a){return J(this,function(a){return void 0===a?n.text(this):this.empty().each(function(){(1===this.nodeType||11===this.nodeType||9===this.nodeType)&&(this.textContent=a)})},null,a,arguments.length)},append:function(){return this.domManip(arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=ja(this,a);b.appendChild(a)}})},prepend:function(){return this.domManip(arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=ja(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return this.domManip(arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return this.domManip(arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},remove:function(a,b){for(var c,d=a?n.filter(a,this):this,e=0;null!=(c=d[e]);e++)b||1!==c.nodeType||n.cleanData(oa(c)),c.parentNode&&(b&&n.contains(c.ownerDocument,c)&&ma(oa(c,"script")),c.parentNode.removeChild(c));return this},empty:function(){for(var a,b=0;null!=(a=this[b]);b++)1===a.nodeType&&(n.cleanData(oa(a,!1)),a.textContent="");return this},clone:function(a,b){return a=null==a?!1:a,b=null==b?a:b,this.map(function(){return n.clone(this,a,b)})},html:function(a){return J(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a&&1===b.nodeType)return b.innerHTML;if("string"==typeof a&&!da.test(a)&&!ia[(ba.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(aa,"<$1></$2>");try{for(;d>c;c++)b=this[c]||{},1===b.nodeType&&(n.cleanData(oa(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=arguments[0];return this.domManip(arguments,function(b){a=this.parentNode,n.cleanData(oa(this)),a&&a.replaceChild(b,this)}),a&&(a.length||a.nodeType)?this:this.remove()},detach:function(a){return this.remove(a,!0)},domManip:function(a,b){a=e.apply([],a);var c,d,f,g,h,i,j=0,l=this.length,m=this,o=l-1,p=a[0],q=n.isFunction(p);if(q||l>1&&"string"==typeof p&&!k.checkClone&&ea.test(p))return this.each(function(c){var d=m.eq(c);q&&(a[0]=p.call(this,c,d.html())),d.domManip(a,b)});if(l&&(c=n.buildFragment(a,this[0].ownerDocument,!1,this),d=c.firstChild,1===c.childNodes.length&&(c=d),d)){for(f=n.map(oa(c,"script"),ka),g=f.length;l>j;j++)h=c,j!==o&&(h=n.clone(h,!0,!0),g&&n.merge(f,oa(h,"script"))),b.call(this[j],h,j);if(g)for(i=f[f.length-1].ownerDocument,n.map(f,la),j=0;g>j;j++)h=f[j],fa.test(h.type||"")&&!L.access(h,"globalEval")&&n.contains(i,h)&&(h.src?n._evalUrl&&n._evalUrl(h.src):n.globalEval(h.textContent.replace(ha,"")))}return this}}),n.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){n.fn[a]=function(a){for(var c,d=[],e=n(a),g=e.length-1,h=0;g>=h;h++)c=h===g?this:this.clone(!0),n(e[h])[b](c),f.apply(d,c.get());return this.pushStack(d)}});var qa,ra={};function sa(b,c){var d,e=n(c.createElement(b)).appendTo(c.body),f=a.getDefaultComputedStyle&&(d=a.getDefaultComputedStyle(e[0]))?d.display:n.css(e[0],"display");return e.detach(),f}function ta(a){var b=l,c=ra[a];return c||(c=sa(a,b),"none"!==c&&c||(qa=(qa||n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement),b=qa[0].contentDocument,b.write(),b.close(),c=sa(a,b),qa.detach()),ra[a]=c),c}var ua=/^margin/,va=new RegExp("^("+Q+")(?!px)[a-z%]+$","i"),wa=function(b){return b.ownerDocument.defaultView.opener?b.ownerDocument.defaultView.getComputedStyle(b,null):a.getComputedStyle(b,null)};function xa(a,b,c){var d,e,f,g,h=a.style;return c=c||wa(a),c&&(g=c.getPropertyValue(b)||c[b]),c&&(""!==g||n.contains(a.ownerDocument,a)||(g=n.style(a,b)),va.test(g)&&ua.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f)),void 0!==g?g+"":g}function ya(a,b){return{get:function(){return a()?void delete this.get:(this.get=b).apply(this,arguments)}}}!function(){var b,c,d=l.documentElement,e=l.createElement("div"),f=l.createElement("div");if(f.style){f.style.backgroundClip="content-box",f.cloneNode(!0).style.backgroundClip="",k.clearCloneStyle="content-box"===f.style.backgroundClip,e.style.cssText="border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute",e.appendChild(f);function g(){f.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",f.innerHTML="",d.appendChild(e);var g=a.getComputedStyle(f,null);b="1%"!==g.top,c="4px"===g.width,d.removeChild(e)}a.getComputedStyle&&n.extend(k,{pixelPosition:function(){return g(),b},boxSizingReliable:function(){return null==c&&g(),c},reliableMarginRight:function(){var b,c=f.appendChild(l.createElement("div"));return c.style.cssText=f.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",c.style.marginRight=c.style.width="0",f.style.width="1px",d.appendChild(e),b=!parseFloat(a.getComputedStyle(c,null).marginRight),d.removeChild(e),f.removeChild(c),b}})}}(),n.swap=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e};var za=/^(none|table(?!-c[ea]).+)/,Aa=new RegExp("^("+Q+")(.*)$","i"),Ba=new RegExp("^([+-])=("+Q+")","i"),Ca={position:"absolute",visibility:"hidden",display:"block"},Da={letterSpacing:"0",fontWeight:"400"},Ea=["Webkit","O","Moz","ms"];function Fa(a,b){if(b in a)return b;var c=b[0].toUpperCase()+b.slice(1),d=b,e=Ea.length;while(e--)if(b=Ea[e]+c,b in a)return b;return d}function Ga(a,b,c){var d=Aa.exec(b);return d?Math.max(0,d[1]-(c||0))+(d[2]||"px"):b}function Ha(a,b,c,d,e){for(var f=c===(d?"border":"content")?4:"width"===b?1:0,g=0;4>f;f+=2)"margin"===c&&(g+=n.css(a,c+R[f],!0,e)),d?("content"===c&&(g-=n.css(a,"padding"+R[f],!0,e)),"margin"!==c&&(g-=n.css(a,"border"+R[f]+"Width",!0,e))):(g+=n.css(a,"padding"+R[f],!0,e),"padding"!==c&&(g+=n.css(a,"border"+R[f]+"Width",!0,e)));return g}function Ia(a,b,c){var d=!0,e="width"===b?a.offsetWidth:a.offsetHeight,f=wa(a),g="border-box"===n.css(a,"boxSizing",!1,f);if(0>=e||null==e){if(e=xa(a,b,f),(0>e||null==e)&&(e=a.style[b]),va.test(e))return e;d=g&&(k.boxSizingReliable()||e===a.style[b]),e=parseFloat(e)||0}return e+Ha(a,b,c||(g?"border":"content"),d,f)+"px"}function Ja(a,b){for(var c,d,e,f=[],g=0,h=a.length;h>g;g++)d=a[g],d.style&&(f[g]=L.get(d,"olddisplay"),c=d.style.display,b?(f[g]||"none"!==c||(d.style.display=""),""===d.style.display&&S(d)&&(f[g]=L.access(d,"olddisplay",ta(d.nodeName)))):(e=S(d),"none"===c&&e||L.set(d,"olddisplay",e?c:n.css(d,"display"))));for(g=0;h>g;g++)d=a[g],d.style&&(b&&"none"!==d.style.display&&""!==d.style.display||(d.style.display=b?f[g]||"":"none"));return a}n.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=xa(a,"opacity");return""===c?"1":c}}}},cssNumber:{columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":"cssFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=n.camelCase(b),i=a.style;return b=n.cssProps[h]||(n.cssProps[h]=Fa(i,h)),g=n.cssHooks[b]||n.cssHooks[h],void 0===c?g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:i[b]:(f=typeof c,"string"===f&&(e=Ba.exec(c))&&(c=(e[1]+1)*e[2]+parseFloat(n.css(a,b)),f="number"),null!=c&&c===c&&("number"!==f||n.cssNumber[h]||(c+="px"),k.clearCloneStyle||""!==c||0!==b.indexOf("background")||(i[b]="inherit"),g&&"set"in g&&void 0===(c=g.set(a,c,d))||(i[b]=c)),void 0)}},css:function(a,b,c,d){var e,f,g,h=n.camelCase(b);return b=n.cssProps[h]||(n.cssProps[h]=Fa(a.style,h)),g=n.cssHooks[b]||n.cssHooks[h],g&&"get"in g&&(e=g.get(a,!0,c)),void 0===e&&(e=xa(a,b,d)),"normal"===e&&b in Da&&(e=Da[b]),""===c||c?(f=parseFloat(e),c===!0||n.isNumeric(f)?f||0:e):e}}),n.each(["height","width"],function(a,b){n.cssHooks[b]={get:function(a,c,d){return c?za.test(n.css(a,"display"))&&0===a.offsetWidth?n.swap(a,Ca,function(){return Ia(a,b,d)}):Ia(a,b,d):void 0},set:function(a,c,d){var e=d&&wa(a);return Ga(a,c,d?Ha(a,b,d,"border-box"===n.css(a,"boxSizing",!1,e),e):0)}}}),n.cssHooks.marginRight=ya(k.reliableMarginRight,function(a,b){return b?n.swap(a,{display:"inline-block"},xa,[a,"marginRight"]):void 0}),n.each({margin:"",padding:"",border:"Width"},function(a,b){n.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];4>d;d++)e[a+R[d]+b]=f[d]||f[d-2]||f[0];return e}},ua.test(a)||(n.cssHooks[a+b].set=Ga)}),n.fn.extend({css:function(a,b){return J(this,function(a,b,c){var d,e,f={},g=0;if(n.isArray(b)){for(d=wa(a),e=b.length;e>g;g++)f[b[g]]=n.css(a,b[g],!1,d);return f}return void 0!==c?n.style(a,b,c):n.css(a,b)},a,b,arguments.length>1)},show:function(){return Ja(this,!0)},hide:function(){return Ja(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){S(this)?n(this).show():n(this).hide()})}});function Ka(a,b,c,d,e){return new Ka.prototype.init(a,b,c,d,e)}n.Tween=Ka,Ka.prototype={constructor:Ka,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||"swing",this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(n.cssNumber[c]?"":"px")},cur:function(){var a=Ka.propHooks[this.prop];return a&&a.get?a.get(this):Ka.propHooks._default.get(this)},run:function(a){var b,c=Ka.propHooks[this.prop];return this.options.duration?this.pos=b=n.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):this.pos=b=a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):Ka.propHooks._default.set(this),this}},Ka.prototype.init.prototype=Ka.prototype,Ka.propHooks={_default:{get:function(a){var b;return null==a.elem[a.prop]||a.elem.style&&null!=a.elem.style[a.prop]?(b=n.css(a.elem,a.prop,""),b&&"auto"!==b?b:0):a.elem[a.prop]},set:function(a){n.fx.step[a.prop]?n.fx.step[a.prop](a):a.elem.style&&(null!=a.elem.style[n.cssProps[a.prop]]||n.cssHooks[a.prop])?n.style(a.elem,a.prop,a.now+a.unit):a.elem[a.prop]=a.now}}},Ka.propHooks.scrollTop=Ka.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},n.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2}},n.fx=Ka.prototype.init,n.fx.step={};var La,Ma,Na=/^(?:toggle|show|hide)$/,Oa=new RegExp("^(?:([+-])=|)("+Q+")([a-z%]*)$","i"),Pa=/queueHooks$/,Qa=[Va],Ra={"*":[function(a,b){var c=this.createTween(a,b),d=c.cur(),e=Oa.exec(b),f=e&&e[3]||(n.cssNumber[a]?"":"px"),g=(n.cssNumber[a]||"px"!==f&&+d)&&Oa.exec(n.css(c.elem,a)),h=1,i=20;if(g&&g[3]!==f){f=f||g[3],e=e||[],g=+d||1;do h=h||".5",g/=h,n.style(c.elem,a,g+f);while(h!==(h=c.cur()/d)&&1!==h&&--i)}return e&&(g=c.start=+g||+d||0,c.unit=f,c.end=e[1]?g+(e[1]+1)*e[2]:+e[2]),c}]};function Sa(){return setTimeout(function(){La=void 0}),La=n.now()}function Ta(a,b){var c,d=0,e={height:a};for(b=b?1:0;4>d;d+=2-b)c=R[d],e["margin"+c]=e["padding"+c]=a;return b&&(e.opacity=e.width=a),e}function Ua(a,b,c){for(var d,e=(Ra[b]||[]).concat(Ra["*"]),f=0,g=e.length;g>f;f++)if(d=e[f].call(c,b,a))return d}function Va(a,b,c){var d,e,f,g,h,i,j,k,l=this,m={},o=a.style,p=a.nodeType&&S(a),q=L.get(a,"fxshow");c.queue||(h=n._queueHooks(a,"fx"),null==h.unqueued&&(h.unqueued=0,i=h.empty.fire,h.empty.fire=function(){h.unqueued||i()}),h.unqueued++,l.always(function(){l.always(function(){h.unqueued--,n.queue(a,"fx").length||h.empty.fire()})})),1===a.nodeType&&("height"in b||"width"in b)&&(c.overflow=[o.overflow,o.overflowX,o.overflowY],j=n.css(a,"display"),k="none"===j?L.get(a,"olddisplay")||ta(a.nodeName):j,"inline"===k&&"none"===n.css(a,"float")&&(o.display="inline-block")),c.overflow&&(o.overflow="hidden",l.always(function(){o.overflow=c.overflow[0],o.overflowX=c.overflow[1],o.overflowY=c.overflow[2]}));for(d in b)if(e=b[d],Na.exec(e)){if(delete b[d],f=f||"toggle"===e,e===(p?"hide":"show")){if("show"!==e||!q||void 0===q[d])continue;p=!0}m[d]=q&&q[d]||n.style(a,d)}else j=void 0;if(n.isEmptyObject(m))"inline"===("none"===j?ta(a.nodeName):j)&&(o.display=j);else{q?"hidden"in q&&(p=q.hidden):q=L.access(a,"fxshow",{}),f&&(q.hidden=!p),p?n(a).show():l.done(function(){n(a).hide()}),l.done(function(){var b;L.remove(a,"fxshow");for(b in m)n.style(a,b,m[b])});for(d in m)g=Ua(p?q[d]:0,d,l),d in q||(q[d]=g.start,p&&(g.end=g.start,g.start="width"===d||"height"===d?1:0))}}function Wa(a,b){var c,d,e,f,g;for(c in a)if(d=n.camelCase(c),e=b[d],f=a[c],n.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=n.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function Xa(a,b,c){var d,e,f=0,g=Qa.length,h=n.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=La||Sa(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;i>g;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),1>f&&i?c:(h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:n.extend({},b),opts:n.extend(!0,{specialEasing:{}},c),originalProperties:b,originalOptions:c,startTime:La||Sa(),duration:c.duration,tweens:[],createTween:function(b,c){var d=n.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;d>c;c++)j.tweens[c].run(1);return b?h.resolveWith(a,[j,b]):h.rejectWith(a,[j,b]),this}}),k=j.props;for(Wa(k,j.opts.specialEasing);g>f;f++)if(d=Qa[f].call(j,a,k,j.opts))return d;return n.map(k,Ua,j),n.isFunction(j.opts.start)&&j.opts.start.call(a,j),n.fx.timer(n.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always)}n.Animation=n.extend(Xa,{tweener:function(a,b){n.isFunction(a)?(b=a,a=["*"]):a=a.split(" ");for(var c,d=0,e=a.length;e>d;d++)c=a[d],Ra[c]=Ra[c]||[],Ra[c].unshift(b)},prefilter:function(a,b){b?Qa.unshift(a):Qa.push(a)}}),n.speed=function(a,b,c){var d=a&&"object"==typeof a?n.extend({},a):{complete:c||!c&&b||n.isFunction(a)&&a,duration:a,easing:c&&b||b&&!n.isFunction(b)&&b};return d.duration=n.fx.off?0:"number"==typeof d.duration?d.duration:d.duration in n.fx.speeds?n.fx.speeds[d.duration]:n.fx.speeds._default,(null==d.queue||d.queue===!0)&&(d.queue="fx"),d.old=d.complete,d.complete=function(){n.isFunction(d.old)&&d.old.call(this),d.queue&&n.dequeue(this,d.queue)},d},n.fn.extend({fadeTo:function(a,b,c,d){return this.filter(S).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=n.isEmptyObject(a),f=n.speed(b,c,d),g=function(){var b=Xa(this,n.extend({},a),f);(e||L.get(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=n.timers,g=L.get(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&Pa.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));(b||!c)&&n.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=L.get(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=n.timers,g=d?d.length:0;for(c.finish=!0,n.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;g>b;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),n.each(["toggle","show","hide"],function(a,b){var c=n.fn[b];n.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(Ta(b,!0),a,d,e)}}),n.each({slideDown:Ta("show"),slideUp:Ta("hide"),slideToggle:Ta("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){n.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),n.timers=[],n.fx.tick=function(){var a,b=0,c=n.timers;for(La=n.now();b<c.length;b++)a=c[b],a()||c[b]!==a||c.splice(b--,1);c.length||n.fx.stop(),La=void 0},n.fx.timer=function(a){n.timers.push(a),a()?n.fx.start():n.timers.pop()},n.fx.interval=13,n.fx.start=function(){Ma||(Ma=setInterval(n.fx.tick,n.fx.interval))},n.fx.stop=function(){clearInterval(Ma),Ma=null},n.fx.speeds={slow:600,fast:200,_default:400},n.fn.delay=function(a,b){return a=n.fx?n.fx.speeds[a]||a:a,b=b||"fx",this.queue(b,function(b,c){var d=setTimeout(b,a);c.stop=function(){clearTimeout(d)}})},function(){var a=l.createElement("input"),b=l.createElement("select"),c=b.appendChild(l.createElement("option"));a.type="checkbox",k.checkOn=""!==a.value,k.optSelected=c.selected,b.disabled=!0,k.optDisabled=!c.disabled,a=l.createElement("input"),a.value="t",a.type="radio",k.radioValue="t"===a.value}();var Ya,Za,$a=n.expr.attrHandle;n.fn.extend({attr:function(a,b){return J(this,n.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){n.removeAttr(this,a)})}}),n.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(a&&3!==f&&8!==f&&2!==f)return typeof a.getAttribute===U?n.prop(a,b,c):(1===f&&n.isXMLDoc(a)||(b=b.toLowerCase(),d=n.attrHooks[b]||(n.expr.match.bool.test(b)?Za:Ya)),
void 0===c?d&&"get"in d&&null!==(e=d.get(a,b))?e:(e=n.find.attr(a,b),null==e?void 0:e):null!==c?d&&"set"in d&&void 0!==(e=d.set(a,c,b))?e:(a.setAttribute(b,c+""),c):void n.removeAttr(a,b))},removeAttr:function(a,b){var c,d,e=0,f=b&&b.match(E);if(f&&1===a.nodeType)while(c=f[e++])d=n.propFix[c]||c,n.expr.match.bool.test(c)&&(a[d]=!1),a.removeAttribute(c)},attrHooks:{type:{set:function(a,b){if(!k.radioValue&&"radio"===b&&n.nodeName(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}}}),Za={set:function(a,b,c){return b===!1?n.removeAttr(a,c):a.setAttribute(c,c),c}},n.each(n.expr.match.bool.source.match(/\w+/g),function(a,b){var c=$a[b]||n.find.attr;$a[b]=function(a,b,d){var e,f;return d||(f=$a[b],$a[b]=e,e=null!=c(a,b,d)?b.toLowerCase():null,$a[b]=f),e}});var _a=/^(?:input|select|textarea|button)$/i;n.fn.extend({prop:function(a,b){return J(this,n.prop,a,b,arguments.length>1)},removeProp:function(a){return this.each(function(){delete this[n.propFix[a]||a]})}}),n.extend({propFix:{"for":"htmlFor","class":"className"},prop:function(a,b,c){var d,e,f,g=a.nodeType;if(a&&3!==g&&8!==g&&2!==g)return f=1!==g||!n.isXMLDoc(a),f&&(b=n.propFix[b]||b,e=n.propHooks[b]),void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){return a.hasAttribute("tabindex")||_a.test(a.nodeName)||a.href?a.tabIndex:-1}}}}),k.optSelected||(n.propHooks.selected={get:function(a){var b=a.parentNode;return b&&b.parentNode&&b.parentNode.selectedIndex,null}}),n.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){n.propFix[this.toLowerCase()]=this});var ab=/[\t\r\n\f]/g;n.fn.extend({addClass:function(a){var b,c,d,e,f,g,h="string"==typeof a&&a,i=0,j=this.length;if(n.isFunction(a))return this.each(function(b){n(this).addClass(a.call(this,b,this.className))});if(h)for(b=(a||"").match(E)||[];j>i;i++)if(c=this[i],d=1===c.nodeType&&(c.className?(" "+c.className+" ").replace(ab," "):" ")){f=0;while(e=b[f++])d.indexOf(" "+e+" ")<0&&(d+=e+" ");g=n.trim(d),c.className!==g&&(c.className=g)}return this},removeClass:function(a){var b,c,d,e,f,g,h=0===arguments.length||"string"==typeof a&&a,i=0,j=this.length;if(n.isFunction(a))return this.each(function(b){n(this).removeClass(a.call(this,b,this.className))});if(h)for(b=(a||"").match(E)||[];j>i;i++)if(c=this[i],d=1===c.nodeType&&(c.className?(" "+c.className+" ").replace(ab," "):"")){f=0;while(e=b[f++])while(d.indexOf(" "+e+" ")>=0)d=d.replace(" "+e+" "," ");g=a?n.trim(d):"",c.className!==g&&(c.className=g)}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):this.each(n.isFunction(a)?function(c){n(this).toggleClass(a.call(this,c,this.className,b),b)}:function(){if("string"===c){var b,d=0,e=n(this),f=a.match(E)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else(c===U||"boolean"===c)&&(this.className&&L.set(this,"__className__",this.className),this.className=this.className||a===!1?"":L.get(this,"__className__")||"")})},hasClass:function(a){for(var b=" "+a+" ",c=0,d=this.length;d>c;c++)if(1===this[c].nodeType&&(" "+this[c].className+" ").replace(ab," ").indexOf(b)>=0)return!0;return!1}});var bb=/\r/g;n.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=n.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,n(this).val()):a,null==e?e="":"number"==typeof e?e+="":n.isArray(e)&&(e=n.map(e,function(a){return null==a?"":a+""})),b=n.valHooks[this.type]||n.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=n.valHooks[e.type]||n.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(bb,""):null==c?"":c)}}}),n.extend({valHooks:{option:{get:function(a){var b=n.find.attr(a,"value");return null!=b?b:n.trim(n.text(a))}},select:{get:function(a){for(var b,c,d=a.options,e=a.selectedIndex,f="select-one"===a.type||0>e,g=f?null:[],h=f?e+1:d.length,i=0>e?h:f?e:0;h>i;i++)if(c=d[i],!(!c.selected&&i!==e||(k.optDisabled?c.disabled:null!==c.getAttribute("disabled"))||c.parentNode.disabled&&n.nodeName(c.parentNode,"optgroup"))){if(b=n(c).val(),f)return b;g.push(b)}return g},set:function(a,b){var c,d,e=a.options,f=n.makeArray(b),g=e.length;while(g--)d=e[g],(d.selected=n.inArray(d.value,f)>=0)&&(c=!0);return c||(a.selectedIndex=-1),f}}}}),n.each(["radio","checkbox"],function(){n.valHooks[this]={set:function(a,b){return n.isArray(b)?a.checked=n.inArray(n(a).val(),b)>=0:void 0}},k.checkOn||(n.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})}),n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){n.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),n.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)},bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)}});var cb=n.now(),db=/\?/;n.parseJSON=function(a){return JSON.parse(a+"")},n.parseXML=function(a){var b,c;if(!a||"string"!=typeof a)return null;try{c=new DOMParser,b=c.parseFromString(a,"text/xml")}catch(d){b=void 0}return(!b||b.getElementsByTagName("parsererror").length)&&n.error("Invalid XML: "+a),b};var eb=/#.*$/,fb=/([?&])_=[^&]*/,gb=/^(.*?):[ \t]*([^\r\n]*)$/gm,hb=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,ib=/^(?:GET|HEAD)$/,jb=/^\/\//,kb=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,lb={},mb={},nb="*/".concat("*"),ob=a.location.href,pb=kb.exec(ob.toLowerCase())||[];function qb(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(E)||[];if(n.isFunction(c))while(d=f[e++])"+"===d[0]?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function rb(a,b,c,d){var e={},f=a===mb;function g(h){var i;return e[h]=!0,n.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function sb(a,b){var c,d,e=n.ajaxSettings.flatOptions||{};for(c in b)void 0!==b[c]&&((e[c]?a:d||(d={}))[c]=b[c]);return d&&n.extend(!0,a,d),a}function tb(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===d&&(d=a.mimeType||b.getResponseHeader("Content-Type"));if(d)for(e in h)if(h[e]&&h[e].test(d)){i.unshift(e);break}if(i[0]in c)f=i[0];else{for(e in c){if(!i[0]||a.converters[e+" "+i[0]]){f=e;break}g||(g=e)}f=f||g}return f?(f!==i[0]&&i.unshift(f),c[f]):void 0}function ub(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}n.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:ob,type:"GET",isLocal:hb.test(pb[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":nb,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":n.parseJSON,"text xml":n.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?sb(sb(a,n.ajaxSettings),b):sb(n.ajaxSettings,a)},ajaxPrefilter:qb(lb),ajaxTransport:qb(mb),ajax:function(a,b){"object"==typeof a&&(b=a,a=void 0),b=b||{};var c,d,e,f,g,h,i,j,k=n.ajaxSetup({},b),l=k.context||k,m=k.context&&(l.nodeType||l.jquery)?n(l):n.event,o=n.Deferred(),p=n.Callbacks("once memory"),q=k.statusCode||{},r={},s={},t=0,u="canceled",v={readyState:0,getResponseHeader:function(a){var b;if(2===t){if(!f){f={};while(b=gb.exec(e))f[b[1].toLowerCase()]=b[2]}b=f[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return 2===t?e:null},setRequestHeader:function(a,b){var c=a.toLowerCase();return t||(a=s[c]=s[c]||a,r[a]=b),this},overrideMimeType:function(a){return t||(k.mimeType=a),this},statusCode:function(a){var b;if(a)if(2>t)for(b in a)q[b]=[q[b],a[b]];else v.always(a[v.status]);return this},abort:function(a){var b=a||u;return c&&c.abort(b),x(0,b),this}};if(o.promise(v).complete=p.add,v.success=v.done,v.error=v.fail,k.url=((a||k.url||ob)+"").replace(eb,"").replace(jb,pb[1]+"//"),k.type=b.method||b.type||k.method||k.type,k.dataTypes=n.trim(k.dataType||"*").toLowerCase().match(E)||[""],null==k.crossDomain&&(h=kb.exec(k.url.toLowerCase()),k.crossDomain=!(!h||h[1]===pb[1]&&h[2]===pb[2]&&(h[3]||("http:"===h[1]?"80":"443"))===(pb[3]||("http:"===pb[1]?"80":"443")))),k.data&&k.processData&&"string"!=typeof k.data&&(k.data=n.param(k.data,k.traditional)),rb(lb,k,b,v),2===t)return v;i=n.event&&k.global,i&&0===n.active++&&n.event.trigger("ajaxStart"),k.type=k.type.toUpperCase(),k.hasContent=!ib.test(k.type),d=k.url,k.hasContent||(k.data&&(d=k.url+=(db.test(d)?"&":"?")+k.data,delete k.data),k.cache===!1&&(k.url=fb.test(d)?d.replace(fb,"$1_="+cb++):d+(db.test(d)?"&":"?")+"_="+cb++)),k.ifModified&&(n.lastModified[d]&&v.setRequestHeader("If-Modified-Since",n.lastModified[d]),n.etag[d]&&v.setRequestHeader("If-None-Match",n.etag[d])),(k.data&&k.hasContent&&k.contentType!==!1||b.contentType)&&v.setRequestHeader("Content-Type",k.contentType),v.setRequestHeader("Accept",k.dataTypes[0]&&k.accepts[k.dataTypes[0]]?k.accepts[k.dataTypes[0]]+("*"!==k.dataTypes[0]?", "+nb+"; q=0.01":""):k.accepts["*"]);for(j in k.headers)v.setRequestHeader(j,k.headers[j]);if(k.beforeSend&&(k.beforeSend.call(l,v,k)===!1||2===t))return v.abort();u="abort";for(j in{success:1,error:1,complete:1})v[j](k[j]);if(c=rb(mb,k,b,v)){v.readyState=1,i&&m.trigger("ajaxSend",[v,k]),k.async&&k.timeout>0&&(g=setTimeout(function(){v.abort("timeout")},k.timeout));try{t=1,c.send(r,x)}catch(w){if(!(2>t))throw w;x(-1,w)}}else x(-1,"No Transport");function x(a,b,f,h){var j,r,s,u,w,x=b;2!==t&&(t=2,g&&clearTimeout(g),c=void 0,e=h||"",v.readyState=a>0?4:0,j=a>=200&&300>a||304===a,f&&(u=tb(k,v,f)),u=ub(k,u,v,j),j?(k.ifModified&&(w=v.getResponseHeader("Last-Modified"),w&&(n.lastModified[d]=w),w=v.getResponseHeader("etag"),w&&(n.etag[d]=w)),204===a||"HEAD"===k.type?x="nocontent":304===a?x="notmodified":(x=u.state,r=u.data,s=u.error,j=!s)):(s=x,(a||!x)&&(x="error",0>a&&(a=0))),v.status=a,v.statusText=(b||x)+"",j?o.resolveWith(l,[r,x,v]):o.rejectWith(l,[v,x,s]),v.statusCode(q),q=void 0,i&&m.trigger(j?"ajaxSuccess":"ajaxError",[v,k,j?r:s]),p.fireWith(l,[v,x]),i&&(m.trigger("ajaxComplete",[v,k]),--n.active||n.event.trigger("ajaxStop")))}return v},getJSON:function(a,b,c){return n.get(a,b,c,"json")},getScript:function(a,b){return n.get(a,void 0,b,"script")}}),n.each(["get","post"],function(a,b){n[b]=function(a,c,d,e){return n.isFunction(c)&&(e=e||d,d=c,c=void 0),n.ajax({url:a,type:b,dataType:e,data:c,success:d})}}),n._evalUrl=function(a){return n.ajax({url:a,type:"GET",dataType:"script",async:!1,global:!1,"throws":!0})},n.fn.extend({wrapAll:function(a){var b;return n.isFunction(a)?this.each(function(b){n(this).wrapAll(a.call(this,b))}):(this[0]&&(b=n(a,this[0].ownerDocument).eq(0).clone(!0),this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstElementChild)a=a.firstElementChild;return a}).append(this)),this)},wrapInner:function(a){return this.each(n.isFunction(a)?function(b){n(this).wrapInner(a.call(this,b))}:function(){var b=n(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=n.isFunction(a);return this.each(function(c){n(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){n.nodeName(this,"body")||n(this).replaceWith(this.childNodes)}).end()}}),n.expr.filters.hidden=function(a){return a.offsetWidth<=0&&a.offsetHeight<=0},n.expr.filters.visible=function(a){return!n.expr.filters.hidden(a)};var vb=/%20/g,wb=/\[\]$/,xb=/\r?\n/g,yb=/^(?:submit|button|image|reset|file)$/i,zb=/^(?:input|select|textarea|keygen)/i;function Ab(a,b,c,d){var e;if(n.isArray(b))n.each(b,function(b,e){c||wb.test(a)?d(a,e):Ab(a+"["+("object"==typeof e?b:"")+"]",e,c,d)});else if(c||"object"!==n.type(b))d(a,b);else for(e in b)Ab(a+"["+e+"]",b[e],c,d)}n.param=function(a,b){var c,d=[],e=function(a,b){b=n.isFunction(b)?b():null==b?"":b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};if(void 0===b&&(b=n.ajaxSettings&&n.ajaxSettings.traditional),n.isArray(a)||a.jquery&&!n.isPlainObject(a))n.each(a,function(){e(this.name,this.value)});else for(c in a)Ab(c,a[c],b,e);return d.join("&").replace(vb,"+")},n.fn.extend({serialize:function(){return n.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=n.prop(this,"elements");return a?n.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!n(this).is(":disabled")&&zb.test(this.nodeName)&&!yb.test(a)&&(this.checked||!T.test(a))}).map(function(a,b){var c=n(this).val();return null==c?null:n.isArray(c)?n.map(c,function(a){return{name:b.name,value:a.replace(xb,"\r\n")}}):{name:b.name,value:c.replace(xb,"\r\n")}}).get()}}),n.ajaxSettings.xhr=function(){try{return new XMLHttpRequest}catch(a){}};var Bb=0,Cb={},Db={0:200,1223:204},Eb=n.ajaxSettings.xhr();a.attachEvent&&a.attachEvent("onunload",function(){for(var a in Cb)Cb[a]()}),k.cors=!!Eb&&"withCredentials"in Eb,k.ajax=Eb=!!Eb,n.ajaxTransport(function(a){var b;return k.cors||Eb&&!a.crossDomain?{send:function(c,d){var e,f=a.xhr(),g=++Bb;if(f.open(a.type,a.url,a.async,a.username,a.password),a.xhrFields)for(e in a.xhrFields)f[e]=a.xhrFields[e];a.mimeType&&f.overrideMimeType&&f.overrideMimeType(a.mimeType),a.crossDomain||c["X-Requested-With"]||(c["X-Requested-With"]="XMLHttpRequest");for(e in c)f.setRequestHeader(e,c[e]);b=function(a){return function(){b&&(delete Cb[g],b=f.onload=f.onerror=null,"abort"===a?f.abort():"error"===a?d(f.status,f.statusText):d(Db[f.status]||f.status,f.statusText,"string"==typeof f.responseText?{text:f.responseText}:void 0,f.getAllResponseHeaders()))}},f.onload=b(),f.onerror=b("error"),b=Cb[g]=b("abort");try{f.send(a.hasContent&&a.data||null)}catch(h){if(b)throw h}},abort:function(){b&&b()}}:void 0}),n.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(a){return n.globalEval(a),a}}}),n.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET")}),n.ajaxTransport("script",function(a){if(a.crossDomain){var b,c;return{send:function(d,e){b=n("<script>").prop({async:!0,charset:a.scriptCharset,src:a.url}).on("load error",c=function(a){b.remove(),c=null,a&&e("error"===a.type?404:200,a.type)}),l.head.appendChild(b[0])},abort:function(){c&&c()}}}});var Fb=[],Gb=/(=)\?(?=&|$)|\?\?/;n.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=Fb.pop()||n.expando+"_"+cb++;return this[a]=!0,a}}),n.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(Gb.test(b.url)?"url":"string"==typeof b.data&&!(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&Gb.test(b.data)&&"data");return h||"jsonp"===b.dataTypes[0]?(e=b.jsonpCallback=n.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(Gb,"$1"+e):b.jsonp!==!1&&(b.url+=(db.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||n.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,Fb.push(e)),g&&n.isFunction(f)&&f(g[0]),g=f=void 0}),"script"):void 0}),n.parseHTML=function(a,b,c){if(!a||"string"!=typeof a)return null;"boolean"==typeof b&&(c=b,b=!1),b=b||l;var d=v.exec(a),e=!c&&[];return d?[b.createElement(d[1])]:(d=n.buildFragment([a],b,e),e&&e.length&&n(e).remove(),n.merge([],d.childNodes))};var Hb=n.fn.load;n.fn.load=function(a,b,c){if("string"!=typeof a&&Hb)return Hb.apply(this,arguments);var d,e,f,g=this,h=a.indexOf(" ");return h>=0&&(d=n.trim(a.slice(h)),a=a.slice(0,h)),n.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(e="POST"),g.length>0&&n.ajax({url:a,type:e,dataType:"html",data:b}).done(function(a){f=arguments,g.html(d?n("<div>").append(n.parseHTML(a)).find(d):a)}).complete(c&&function(a,b){g.each(c,f||[a.responseText,b,a])}),this},n.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){n.fn[b]=function(a){return this.on(b,a)}}),n.expr.filters.animated=function(a){return n.grep(n.timers,function(b){return a===b.elem}).length};var Ib=a.document.documentElement;function Jb(a){return n.isWindow(a)?a:9===a.nodeType&&a.defaultView}n.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=n.css(a,"position"),l=n(a),m={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=n.css(a,"top"),i=n.css(a,"left"),j=("absolute"===k||"fixed"===k)&&(f+i).indexOf("auto")>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),n.isFunction(b)&&(b=b.call(a,c,h)),null!=b.top&&(m.top=b.top-h.top+g),null!=b.left&&(m.left=b.left-h.left+e),"using"in b?b.using.call(a,m):l.css(m)}},n.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){n.offset.setOffset(this,a,b)});var b,c,d=this[0],e={top:0,left:0},f=d&&d.ownerDocument;if(f)return b=f.documentElement,n.contains(b,d)?(typeof d.getBoundingClientRect!==U&&(e=d.getBoundingClientRect()),c=Jb(f),{top:e.top+c.pageYOffset-b.clientTop,left:e.left+c.pageXOffset-b.clientLeft}):e},position:function(){if(this[0]){var a,b,c=this[0],d={top:0,left:0};return"fixed"===n.css(c,"position")?b=c.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),n.nodeName(a[0],"html")||(d=a.offset()),d.top+=n.css(a[0],"borderTopWidth",!0),d.left+=n.css(a[0],"borderLeftWidth",!0)),{top:b.top-d.top-n.css(c,"marginTop",!0),left:b.left-d.left-n.css(c,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent||Ib;while(a&&!n.nodeName(a,"html")&&"static"===n.css(a,"position"))a=a.offsetParent;return a||Ib})}}),n.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(b,c){var d="pageYOffset"===c;n.fn[b]=function(e){return J(this,function(b,e,f){var g=Jb(b);return void 0===f?g?g[c]:b[e]:void(g?g.scrollTo(d?a.pageXOffset:f,d?f:a.pageYOffset):b[e]=f)},b,e,arguments.length,null)}}),n.each(["top","left"],function(a,b){n.cssHooks[b]=ya(k.pixelPosition,function(a,c){return c?(c=xa(a,b),va.test(c)?n(a).position()[b]+"px":c):void 0})}),n.each({Height:"height",Width:"width"},function(a,b){n.each({padding:"inner"+a,content:b,"":"outer"+a},function(c,d){n.fn[d]=function(d,e){var f=arguments.length&&(c||"boolean"!=typeof d),g=c||(d===!0||e===!0?"margin":"border");return J(this,function(b,c,d){var e;return n.isWindow(b)?b.document.documentElement["client"+a]:9===b.nodeType?(e=b.documentElement,Math.max(b.body["scroll"+a],e["scroll"+a],b.body["offset"+a],e["offset"+a],e["client"+a])):void 0===d?n.css(b,c,g):n.style(b,c,d,g)},b,f?d:void 0,f,null)}})}),n.fn.size=function(){return this.length},n.fn.andSelf=n.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return n});var Kb=a.jQuery,Lb=a.$;return n.noConflict=function(b){return a.$===n&&(a.$=Lb),b&&a.jQuery===n&&(a.jQuery=Kb),n},typeof b===U&&(a.jQuery=a.$=n),n});
//# sourceMappingURL=jquery.min.map;
/*
 * metismenu - v1.1.3
 * Easy menu jQuery plugin for Twitter Bootstrap 3
 * https://github.com/onokumus/metisMenu
 *
 * Made by Osman Nuri Okumus
 * Under MIT License
 */
!function(a,b,c){function d(b,c){this.element=a(b),this.settings=a.extend({},f,c),this._defaults=f,this._name=e,this.init()}var e="metisMenu",f={toggle:!0,doubleTapToGo:!1};d.prototype={init:function(){var b=this.element,d=this.settings.toggle,f=this;this.isIE()<=9?(b.find("li.active").has("ul").children("ul").collapse("show"),b.find("li").not(".active").has("ul").children("ul").collapse("hide")):(b.find("li.active").has("ul").children("ul").addClass("collapse in"),b.find("li").not(".active").has("ul").children("ul").addClass("collapse")),f.settings.doubleTapToGo&&b.find("li.active").has("ul").children("a").addClass("doubleTapToGo"),b.find("li").has("ul").children("a").on("click."+e,function(b){return b.preventDefault(),f.settings.doubleTapToGo&&f.doubleTapToGo(a(this))&&"#"!==a(this).attr("href")&&""!==a(this).attr("href")?(b.stopPropagation(),void(c.location=a(this).attr("href"))):(a(this).parent("li").toggleClass("active").children("ul").collapse("toggle"),void(d&&a(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide")))})},isIE:function(){for(var a,b=3,d=c.createElement("div"),e=d.getElementsByTagName("i");d.innerHTML="<!--[if gt IE "+ ++b+"]><i></i><![endif]-->",e[0];)return b>4?b:a},doubleTapToGo:function(a){var b=this.element;return a.hasClass("doubleTapToGo")?(a.removeClass("doubleTapToGo"),!0):a.parent().children("ul").length?(b.find(".doubleTapToGo").removeClass("doubleTapToGo"),a.addClass("doubleTapToGo"),!1):void 0},remove:function(){this.element.off("."+e),this.element.removeData(e)}},a.fn[e]=function(b){return this.each(function(){var c=a(this);c.data(e)&&c.data(e).remove(),c.data(e,new d(this,b))}),this}}(jQuery,window,document);;
var module=angular.module("ngRateIt",["ng"]);module.directive("ngRateIt",["$q",function(a){"use strict";var b=function(b,c,d){d.readOnly||(b.readOnly=function(){return!1}),d.resetable||(b.resetable=function(){return!0}),d.beforeRated||(b.beforeRated=function(){var b=a.defer();return b.resolve(),b.promise}),d.rated||(b.rated=function(){}),d.beforeReset||(b.beforeReset=function(){var b=a.defer();return b.resolve(),b.promise}),d.reset||(b.reset=function(){}),d.over||(b.over=function(){})};return{scope:{ngModel:"=",min:"=?min",max:"=?max",step:"=?step",readOnly:"&?readOnly",pristine:"=?pristine",resetable:"&?resetable",starWidth:"=?starWidth",starHeight:"=?starHeight",rated:"=?rated",reset:"=?reset",over:"=?over",beforeRated:"=?beforeRated",beforeReset:"=?beforeReset"},templateUrl:"ngRateIt/ng-rate-it.html",require:"ngModel",replace:!0,link:b,controller:"ngRateItController"}}]).controller("ngRateItController",["$scope","$timeout",function(a,b){"use strict";a.isHovering=!1,a.offsetLeft=0,a.orgValue=angular.copy(a.ngModel),a.hoverValue=0,a.min=a.min||0,a.max=a.max||5,a.step=a.step||.5,a.pristine=a.orgValue===a.ngModel,a.starWidth=a.starWidth||16,a.starHeight=a.starHeight||16,a.resetCssOffset=4;var c=a.$watch("ngModel",function(){a.pristine=a.orgValue===a.ngModel});a.removeRating=function(){a.resetable()&&!a.readOnly()&&a.beforeReset().then(function(){a.ngModel=a.min,a.reset()})},a.setValue=function(){if(a.isHovering&&!a.readOnly()){var c=angular.copy(a.min+a.hoverValue);a.beforeRated(c).then(function(){a.ngModel=c,a.isHovering=!1,b(function(){a.rated()})})}},a.onEnter=function(b){a.isHovering=!0,a.offsetLeft=0;var c=b.originalTarget||b.srcElement||b.target;a.offsetLeft=c.getBoundingClientRect().left},a.onHover=function(b){a.isHovering=!0,a.hoverValue=Math.round((b.clientX-a.offsetLeft)/a.starWidth/a.step)*a.step,a.over(b,a.hoverValue)},a.onLeave=function(){a.isHovering=!1,a.hoverValue=0},a.$on("$destroy",function(){c()})}]).run(["$templateCache",function(a){"use strict";a.put("ngRateIt/ng-rate-it.html",'<div class="ngrateit" ng-class="{\'ngrateit-readonly\': readOnly()}"><a class="ngrateit-background ngrateit-reset" ng-mouseenter="resetCssOffset=5;" ng-mouseleave="resetCssOffset=4;" ng-if="!readOnly() && resetable()" ng-click="removeRating()" ng-style="{\'width\': starWidth+\'px\', \'height\': starHeight+\'px\', \'background-position\': \'0 \'+(-resetCssOffset*starHeight)+\'px\'}"></a><div class="ngrateit-star_wrapper" ng-click="setValue()" ng-mouseenter="onEnter($event)" ng-mousemove="onHover($event)" ng-mouseleave="onLeave();" ng-style="{\'width\': ((max-min)*starWidth)+\'px\', \'height\': starHeight+\'px\'}"><div class="ngrateit-background"></div>'+"<div class=\"ngrateit-value\" ng-hide=\"!readOnly() && hoverValue>0 && hoverValue!==(ngModel-min)\" ng-style=\"{'width': (ngModel-min)*starWidth+'px', 'background-position': '0 '+(-2*starHeight)+'px'}\"></div><div class=\"ngrateit-hover\" ng-if=\"!readOnly() && hoverValue!==(ngModel-min)\" ng-style=\"{'width': hoverValue*starWidth+'px', 'background-position': '0 '+(-3*starHeight)+'px'}\" ></div></div></div>")}]);