/*** Created by sanzeeb on 1/7/2016.*/

var productApp = angular.module('productApp', ['ui.bootstrap', 'autocomplete', 'ngSanitize', 'angular-confirm', 'textAngular']);

// directive for heart action for grid items
productApp.directive('heartCounterProduct', ['$http', function($http) {
    return {
        restrict: 'E',
        transclude: true,
        replace: true,
        scope:{
            uid:'=',
            iid:'=',
            plink:'=',
            sec:'=',
        },
        controller:function($scope, $element, $attrs){

           // console.log(window.location.host);
            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;

            $scope.heartCounterAction = function(){

                $http({
                    url: '/api/heart/count-heart',
                    method: "POST",
                    data:{
                        section: $attrs.sec,
                        uid: $scope.uid,
                        iid: $scope.iid,
                        plink: $scope.cleanUrl($scope.plink),
                    }
                }).success(function (data) {
                    $attrs.ustatus = data.UserStatus;

                    $scope.unHeart = data.UserStatus;
                    $scope.heartCounter = data.Count;

                });
            };

            // clean url for ideaing URL (take only permalink)
            $scope.cleanUrl = function(urlString){
                urlString = urlString.toString();
                var domainBuilder = "https://"+window.location.host+"/ideas/";
                var cleanString = urlString.replace(domainBuilder,'');
                return cleanString;
            };

            $scope.heartAction = function(){

                // an anonymous will be returned without performing any action.
                if($attrs.uid==0)
                    return;

                $http({
                    url: '/api/heart/add-heart',
                    method: "POST",
                    data:{
                        section: $attrs.sec,
                        uid: $scope.uid,
                        iid: $scope.iid,
                        plink: $scope.cleanUrl($scope.plink),
                        uht: $scope.unHeart
                    }
                }).success(function (data) {
                    $scope.heartCounterAction();
                    $scope.unHeart = ! $scope.unHeart;
                });
            };
            $scope.heartCounterAction();
        },

        template: '      <div class="">'+
        '                    <a class="likes"'+
        '                       ng-click="heartAction()"'+
        '                    >'+
        '                        <i ng-class="unHeart != false ? \'m-icon m-icon--heart-solid\' : \'m-icon m-icon--ScrollingHeaderHeart\'">'+
        '                                <span class="m-hover">'+
        '                                    <span class="path1"></span><span class="path2"></span>'+
        '                                </span>'+
        '                        </i>'+
        '                        <span class="social-stats__text" ng-bind="heartCounter">&nbsp; </span>'+
        '                    </a>'+
        '                </div>'

    }
}]);


// Setting values of Angular Text Editor
productApp.config(['$provide', function ($provide) {
    // this demonstrates how to register a new tool and add it to the default toolbar
    $provide.decorator('taOptions', ['taRegisterTool', '$delegate', function (taRegisterTool, taOptions) {
        // $delegate is the taOptions we are decorating
        // here we override the default toolbars and classes specified in taOptions.
        taOptions.forceTextAngularSanitize = true; // set false to allow the textAngular-sanitize provider to be replaced
        taOptions.keyMappings = []; // allow customizable keyMappings for specialized key boards or languages

        /*taOptions.toolbar = [
         ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'quote',
         'bold', 'italics', 'underline', 'ul', 'ol', 'redo', 'undo', 'clear',
         'justifyLeft','justifyCenter','justifyRight', 'justifyFull',
         'insertImage', 'insertLink']
         ];*/

        taRegisterTool('insertCustomImage', {
            iconclass: "fa fa-picture-o",
            action: function () {
                this.$editor().$parent.insertCustomImagePopup();

            }
        });

        taOptions.toolbar = [
            ['bold', 'insertCustomImage']
        ];

        taOptions.classes = {
            focussed: 'focussed',
            toolbar: 'btn-toolbar',
            toolbarGroup: 'btn-group',
            toolbarButton: 'btn btn-default',
            toolbarButtonActive: 'active',
            disabled: 'disabled',
            textEditor: 'form-control',
            htmlEditor: 'form-control'
        };
        return taOptions; // whatever you return will be the taOptions
    }]);
    // this demonstrates changing the classes of the icons for the tools for font-awesome v3.x
    /*$provide.decorator('taTools', ['$delegate', function(taTools){
     taTools.bold.iconclass = 'icon-bold';
     taTools.italics.iconclass = 'icon-italic';
     taTools.underline.iconclass = 'icon-underline';
     taTools.ul.iconclass = 'icon-list-ul';
     taTools.ol.iconclass = 'icon-list-ol';
     taTools.undo.iconclass = 'icon-undo';
     taTools.redo.iconclass = 'icon-repeat';
     taTools.justifyLeft.iconclass = 'icon-align-left';
     taTools.justifyRight.iconclass = 'icon-align-right';
     taTools.justifyCenter.iconclass = 'icon-align-center';
     taTools.clear.iconclass = 'icon-ban-circle';
     taTools.insertLink.iconclass = 'icon-link';
     taTools.insertImage.iconclass = 'icon-picture';
     // there is no quote icon in old font-awesome so we change to text as follows
     delete taTools.quote.iconclass;
     taTools.quote.buttontext = 'quote';
     return taTools;
     }]);*/
}]);


productApp.controller('productController', ['$scope', '$http', '$window', '$interval', '$timeout'
    , function ($scope, $http, $window, $interval, $timeout) {

        $scope.focusEditor = function () {
            $timeout(function () {
                angular.element('div[contenteditable=true]').trigger('focus');
            })
        }
        $scope.insertCustomImagePopup = function () {
            alert("Please add the code for photo uploading here");
        }
        $scope.textAreaSetup = function ($element) {
            $element.attr('focus-me', 'focus_editor');
        };
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
            $scope.specList = [];

            $scope.compareIndex = 0;
            $scope.dataLength = 0;//$scope.comparableProductList.length;
            $scope.temporaryViewList = [];

            $scope.showCompareButton = true;

            // Comment section
            $scope.html = "";
            $scope.comments = [];
            $scope.commentsCount = 0;
            $scope.commentsCountView = "";//$scope.commentsCount < 2? $scope.commentsCount +" "+"Comment" : $scope.commentsCount +" "+"Comments";

            $scope.productId = 0;
            $scope.userId = 0;
            $scope.isAdmin = false;
            $scope.isEdit = false;
            $scope.commentId = null;

            // Heart Section

            $scope.unHeart = false;
            $scope.heartCounter = 0;


        };

        // Heart //

        $scope.heartAction = function (userId, ItemId, permalink, section) {

            // an anonymous will be returned withough performing any action.
            if (userId == 0)
                return;

            $http({
                url: '/api/heart/add-heart',
                method: "POST",
                data: {
                    uid: userId,
                    iid: ItemId,
                    plink: permalink,
                    section: section,
                    uht: $scope.unHeart
                }
            }).success(function (data) {
                $scope.heartCounterAction(userId, ItemId, section);
                $scope.unHeart = !$scope.unHeart;
            });
        };

        $scope.heartCounterAction = function (userId, ItemId, section) {
            $http({
                url: '/api/heart/count-heart',
                method: "POST",
                data: {
                    uid: userId,
                    iid: ItemId,
                    section: section
                }
            }).success(function (data) {
                $scope.unHeart = data.UserStatus;
                $scope.heartCounter = data.Count;
            });

        };

        // Comment for product section
        $scope.addCommentForProduct = function (userId, productId, permalink, comment) {
            //console.log(userId,productId,permalink,comment);

            $http({
                url: '/api/comment/add-product-comment',
                method: "POST",
                data: {
                    uid: userId,
                    pid: productId,
                    plink: permalink,
                    comment: comment,
                    img: $window.img
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.getCommentsForProduct($scope.productId);


            });
        };

        $scope.getCommentsForProduct = function (pid) {

            $http({
                url: '/api/comment/get-product-comment/' + pid,
                method: "GET"
            }).success(function (data) {
                $scope.productId = pid;
                $scope.comments = data.data;
                $scope.commentsCount = $scope.comments.length;
                $scope.commentsCountView = $scope.commentsCount < 2 ? $scope.commentsCount + " " + "Comment" : $scope.commentsCount + " " + "Comments";

                //  console.log($scope.comments.length);
            });

        };

        // update comment in the comment view through AJAX call.
        var commnetTimer = $interval(function () {
            //  console.log("in");
            if ($scope.productId != 0) {
                $scope.getCommentsForProduct($scope.productId);
            }
        }, 15000);//10000


        $scope.editComment = function (comment) {
            //  console.log(comment);

            $scope.isEdit = true;

            $scope.commentId = comment.CommentId;

            $scope.html = comment.Comment;


        };

        $scope.updateCommentForProduct = function (id, comment) {
            $http({
                url: '/api/comment/update-comment',
                method: "POST",
                data: {
                    cid: $scope.commentId,
                    comment: $scope.html
                }
            }).success(function (data) {
                $scope.html = "";
                $scope.isEdit = false;
                // console.log("pid :"+ $scope.productId);
                $scope.getCommentsForProduct($scope.productId);
            });

        };


        $scope.deleteCommentForProduct = function (id) {
            $http({
                url: '/api/comment/delete-comment',
                method: "POST",
                data: {
                    cid: id
                }
            }).success(function (data) {
                $scope.getCommentsForProduct($scope.productId);
            });

        };


        // toggle compare button
        $scope.toggleCompareButton = function () {
            $scope.showCompareButton = !$scope.showCompareButton;

        };

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

                $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);
                $scope.dataLength = $scope.comparableProductList.length;
                $scope.selectedProduct = '';

                $scope.toggleCompareButton();

            });

        };

        $scope.deleteSelectedItem = function (index) {
            $scope.comparableProductList.splice(index, 1);

            $scope.dataLength = $scope.comparableProductList.length;
            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };

        $scope.traverseForward = function () {

            if ($scope.compareIndex <= $scope.dataLength - 1)
                $scope.compareIndex++;

            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };

        $scope.traverseBackward = function () {

            if ($scope.compareIndex >= 1)
                $scope.compareIndex--;


            $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);

        };


        $scope.loadProductDetails = function () {
            // console.log(permalink);
            $http({
                url: '/api/pro-details/' + $scope.permalink,
                method: "GET",
            }).success(function (data) {

                if (data.status_code == 200) {
                    $scope.comparableProductList.push(data);


                    $scope.temporaryViewList = $scope.comparableProductList.slice($scope.compareIndex, $scope.compareIndex + 3);
                    $scope.dataLength = $scope.comparableProductList.length;

                    // set spec list for product compare
                    var item = data.data.productInformation.Specifications;

                    for (var i = 0; i < item.length; i++) {
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

/* bootstrap for modularization
//angular.bootstrap(document.getElementById('productApp'),['productApp']);*/

