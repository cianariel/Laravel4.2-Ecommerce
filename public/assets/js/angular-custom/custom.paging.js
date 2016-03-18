
angular.module('pagingApp', [
    'pagingApp.controllers',
    //'pagingApp.services',
    'pagingApp.filters',
    'cgBusy'
]);

angular.module('pagingApp.controllers', [ 'ui.bootstrap'])
    .controller('pagingController', function($scope, $timeout, $uibModal, $http, pagingApi, $filter) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];
        $scope.ideaCategory = false;
        //$scope.globalOffset = 0;

        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        var $route =  $filter('getURISegment')(2);
        var $limit = 0;

        if($route == 'idea'){
            $scope.currentTag = $filter('getURISegment')(3);
        }else if($route == 'ideas'){
            $scope.filterBy = 'idea';
            if($filter('getURISegment')(3) == 'category'){
                $scope.ideaCategory = $filter('getURISegment')(4);
            }else{
                $scope.ideaCategory = $filter('getURISegment')(3);
            }
            var $limit = 9;
        }

        $scope.firstLoad = pagingApi.getGridContent(1, $limit, $scope.currentTag, $scope.filterBy,  $scope.ideaCategory).success(function (response) {
            $scope.allContent[0] = response;
            $scope.content[0] = $scope.sliceToRows(response['regular'], response['featured']);
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            $scope.allContent[$scope.currentPage] = [];

            if(!$scope.filterBy || typeof $scope.filterBy === 'undefined'){
                var $limit = 0;
                $scope.filterBy = null;
            }else{
                var $limit = 9;
            }

            $scope.nextLoad =  pagingApi.getGridContent($scope.currentPage, $limit, $scope.currentTag, $scope.filterBy, $scope.ideaCategory).success(function (response) {
                $scope.newStuff[0] = $scope.sliceToRows(response['regular'], response['featured']);
                $scope.content = $scope.content.concat($scope.newStuff);

                $scope.allContent[$scope.currentPage]['regular']  = response['regular'];
                $scope.allContent[$scope.currentPage]['featured'] = response['featured'];
            });
        };


        $scope.filterContent = function($criterion){
            $('.main-content').fadeOut(500, function(){
                var $replacer = [];

                if($scope.filterBy === $criterion){
                    return true;

                }else if(typeof $criterion === 'undefined' || $criterion === null || $criterion === 'all'){
                    $scope.nextLoad = pagingApi.getGridContent(1, 0, $scope.currentTag).success(function (response) {
                        $scope.allContent[0] = response;
                        $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
                    });
                    $scope.currentPage = 1;
                    $scope.filterBy = null;

                    $scope.content = $replacer;
                    $('.main-content').fadeIn();

                    return true;

                }

                $scope.filterBy = $criterion;

                $scope.nextLoad = pagingApi.getFilteredContent($scope.currentPage, $scope.currentTag, $criterion, $scope.sliceToRows).then(function(response){
                    var $newStuff       = response;

                    $scope.content = $newStuff;
                    $scope.allContent = $scope.allContent.concat($newStuff);
                    $('.main-content').fadeIn(500);
                });
            });
        };

        $scope.sliceToRows = function($regular, $featured){
            var $return = [];
            $return['row-1'] = $regular.slice(0, 3);
            $return['row-2'] = $featured[0] ? [$featured[0]] : false;
            $return['row-3'] = $regular.slice(3, 6);
            $return['row-4'] = $featured[1] ? [$featured[1]] : false;
            $return['row-5'] = $regular.slice(6, 9);
            $return['row-6'] = $featured[2] ? [$featured[2]] : false;

            return $return;
        };

        $scope.fadeAnimation = function($node, $action, $callback){
            $($node).fadeOut(
                $callback()
            );

        };

        // email subscription //

        $scope.subscribe = function () {

            $scope.responseMessage = '';

            $http({
                url: '/api/subscribe',
                method: "POST",
                data: {
                    'Email': $scope.SubscriberEmail
                }
            }).success(function (data) {

                if (data.status_code == 406) {

                    $scope.responseMessage = "Invalid Email !";
                }

                else if (data.status_code == 200) {
                    $scope.responseMessage = "Successfully Subscribed";
                    $scope.SubscriberEmail = '';

                } else {
                    $scope.responseMessage = "Email already subscribed";
                }
            });

        };

        $scope.open = function (key) {
            var templateUrl = "room-related-product-" + key + ".html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              controller: 'ModalInstanceCtrltest'
            });
        };

        $scope.openProfileSetting = function () {
            var templateUrl = "profile-setting.html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              windowClass : 'profile-setting-modal',
              controller: 'ModalInstanceCtrltest'
            });
        };

        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
            }
            

    })
/*    .controller('headerController', function ($scope, $uibModal, $http, pagingApi, $filter, layoutApi) {

        /!*$scope.openProfileSetting = function () {
         var templateUrl = "profile-setting.html";
         var modalInstance = $uibModal.open({
         templateUrl: templateUrl,
         size: 'lg',
         windowClass : 'profile-setting-modal',
         controller: 'ModalInstanceCtrltest'
         });
         };*!/

        /!*layoutApi.getProductsForShopMenu().success(function (response) {
         $scope.productsForShopMenu = response;
         });*!/

    })*/
    .controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance, pagingApi) {
      $scope.ok = function () {
        $uibModalInstance.close();
      };

      $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
      };

        $scope.openSharingModal = function ($service) {
            pagingApi.openSharingModal($service);
        };
    })
    .controller('shoplandingController', ['$scope', '$http', 'pagingApi', '$timeout', '$uibModal', function ($scope, $http, pagingApi, $timeout, $uibModal) {
        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        }

        
        $scope.nextLoad = pagingApi.getPlainContent(1, 3, 'deal', 'idea').success(function (response) {
            $scope.dailyDeals = response;
            $timeout(function() {
                jQuery('#daily-deals').royalSlider({
                    arrowsNav: true,
                    loop: false,
                    keyboardNavEnabled: true,
                    controlsInside: false,
                    imageScaleMode: 'fit',
                    arrowsNavAutoHide: false,
                    controlNavigation: 'bullets',
                    thumbsFitInViewport: false,
                    navigateByClick: false,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType:'move',
                    globalCaption: false,
                    deeplinking: {
                      enabled: true,
                      change: false
                    },
                    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                    imgWidth: "100%",
                    autoHeight: true,
                    imageScaleMode: "fill",
                    //    autoScaleSliderWidth: 1500,
                    //    autoScaleSliderHeight: 500,
                    //    autoScaleSlider: true
                });
                }, 
            100);
            
            
              

        });


        pagingApi.getPlainContent(1, 9, false, 'product').success(function (response) {
            $scope.newestArrivals = [];
            for(var i=0; i<= response.length; i++){
                if(i%3 == 0){
                    var newestArrival = [response[i]];
                }else{
                    newestArrival.push(response[i]);
                    if(i%3 == 2 || i == response.length-1){
                        $scope.newestArrivals.push(newestArrival);
                    }
                }
            }
            
            $timeout(function(){
                jQuery('#newest-arrivals').royalSlider({
                    arrowsNav: true,
                    loop: false,
                    keyboardNavEnabled: true,
                    controlsInside: false,
                    arrowsNavAutoHide: false,
                    controlNavigation: 'bullets',
                    thumbsFitInViewport: false,
                    navigateByClick: false,
                    startSlideId: 0,
                    autoPlay: false,
                    transitionType:'move',
                    globalCaption: false,
                    deeplinking: {
                      enabled: true,
                      change: false
                    },
                    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                    imgWidth: "100%",
                    imageScaleMode: "fill",
                    autoHeight: true
                }, 100);
            })
        });
    }])

    .controller('shopcategoryController', function ($scope, $filter, pagingApi, $uibModal, $timeout) {
        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };
        $scope.openProductPopup = function(id){
            pagingApi.openProductPopup($scope, $uibModal, $timeout, id);
        }
        $scope.currentPage = 1;
        $scope.currentCategory = false;
        $scope.$filterBy = false;
        $scope.sortBy = false;

        var $route =  $filter('getURISegment')(2);
        var $category = false;


        if($route == 'shop'){
            if($category = $filter('getURISegment')(5)){
                $scope.currentCategory = $category;
            }else if($category = $filter('getURISegment')(4)){
                $scope.currentCategory = $category;
            }else{
                $scope.currentCategory = $filter('getURISegment')(3);
            }
        }

        $scope.nextLoad = pagingApi.getPlainContent(1, 15,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {

            if($scope.sortBy){
                response.sort(function(a, b) {
                    return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                });
            }

            $scope.content = response;
        });

        $scope.loadMore = function() {
            $scope.currentPage++;

            var $limit = 15;

            $scope.nextLoad =  pagingApi.getPlainContent($scope.currentPage, $limit,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {
                var $newStuff = $scope.content.concat(response)

                if($scope.sortBy){
                    $newStuff.sort(function (a, b) {
                        return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                    });
                }

                $scope.content = $newStuff;
            });
        };

        //$scope.sortContent = function($sortBy){
        //
        //    if($sortBy === $scope.sortBy){
        //        return true;
        //    }
        //
        //    $('a[data-sortby]').removeClass('active');
        //    $('a[data-sortby="'+$sortBy+'"]').addClass('active');
        //
        //    var contentBlock =  $('.grid-box-3');
        //
        //    contentBlock.fadeOut(500, function(){
        //        $scope.nextLoad =  pagingApi.getPlainContent(1, 15,  $scope.currentCategory, 'product', $scope.currentCategory).success(function (response) {
        //            if($sortBy) {
        //                response.sort(function (a, b) {
        //                    return parseFloat(a[$sortBy]) - parseFloat(b[$sortBy]);
        //                });
        //                $scope.sortBy = $sortBy;
        //                $scope.content = response;
        //                contentBlock.fadeIn();
        //            }else{
        //                $scope.content = response;
        //                contentBlock.fadeIn();
        //            }
        //            $scope.sortBy = $sortBy;
        //
        //        });
        //    });
        //}

        $scope.filterPlainContent = function($filterBy, $sortBy) {

            //if($filterBy === $scope.currentCategory){
            //    return true;
            //}

            if($filterBy){
                if($('a[data-filterby="'+$filterBy+'"]').hasClass('active')){
                    return true;
                }

                $scope.currentCategory = $filterBy;
                $('a[data-filterby]').removeClass('active');
                $('a[data-filterby="'+$filterBy+'"]').addClass('active');

            }

            if($sortBy && $sortBy != 'undefined' && $sortBy != $scope.sortBy){

                if($('a[data-sotyby="'+$sortBy+'"]').hasClass('active')){
                    return true;
                }

                $('a[data-sortby]').removeClass('active');
                $('a[data-sortby="'+$sortBy+'"]').addClass('active');
            }

            var contentBlock =  $('.grid-box-3');

            contentBlock.fadeOut(500, function(){

                $scope.nextLoad =  pagingApi.getPlainContent(1, 15,   $scope.currentCategory, 'product',  $scope.currentCategory).success(function (response) {
                    if($sortBy != false){
                        $scope.sortBy = $sortBy;
                    }

                    if($scope.sortBy && $scope.sortBy != 'default' ){
                        response.sort(function (a, b) {
                            return parseFloat(a[$scope.sortBy]) - parseFloat(b[$scope.sortBy]);
                        });
                    }

                    $scope.content = response;
                    contentBlock.fadeIn();
                });
            });
        }
    })
    .directive('a', function() {
    return {
        restrict: 'E',
        link: function(scope, elem, attrs) {
            if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
                elem.on('click', function(e){
                    e.preventDefault();
                });
            }
        }
    };
  })
    .factory('pagingApi', function($http, $window, $q) {
        var pagingApi = {};
        pagingApi.openProductPopup = function ($scope, $uibModal, $timeout, productId) {
            var body = angular.element(document).find('body');
            if(body[0].offsetWidth < 880){
                return;
            }
            
            document.getElementsByTagName('html')[0].className += " hide-overflow ";
            var templateUrl = "product-popup.html";
            var modalInstance = $uibModal.open({
              templateUrl: templateUrl,
              size: 'lg',
              windowClass : 'product-popup-modal',
              controller: 'ModalInstanceCtrltest'
            });
            modalInstance.opened.then(function(){
                $timeout(function() {
                    $http({
                        url: '/api/product/get-product/' + productId,
                        method: "get",
                    }).success(function (data) {
                        if (data.status_code == 200) {
                            var data = data.data;
                            var imageHTML = "";
                            for(var key in data.selfImages.picture){
                                var picture = data.selfImages.picture[key];
                                imageHTML += '\
                                    <div>\
                                        <img class="rsImg " \
                                             src="'+ picture['link'] +'"\
                                             class="attachment-large wp-post-image"\
                                             alt=""/>\
                                    </div>\
                                '
                            }
                            $('.product-popup-modal #product-slider').html(imageHTML);
                            $('.product-popup-modal .p-title').html(data.productInformation['ProductName']);
                            
                            var html = '\
                                <a class="get-round" href="'+ data.productInformation['AffiliateLink'] +'" target="_blank">Get it</a>\
                                <img class="vendor-logo" width="107" src="'+ data.storeInformation['ImagePath'] +'" alt="'+ data.storeInformation['StoreName'] +'">\
                            ';
                            $('.product-popup-modal .p-get-it-amazon .p-body').html(html);
                            
                            
//                            $('.product-popup-modal .get-round').attr('href', data.productInformation['AffiliateLink']);
                            
                            if(data.productInformation['Review']){
                                var pScore = parseInt(((( Number(data.productInformation['Review'][0].value) > 0 ? Number(data.productInformation['Review'][0].value) : Number(data.productInformation['Review'][1].value)) + Number(data.productInformation['Review'][1].value))/2)*20) + "%";
                            }else{
                                var pScore = "0%";
                            }
                            $('.product-popup-modal .p-score').html(pScore);
                            
                            var price;
                            if(data.productInformation['SellPrice']){
                                price = data.productInformation['SellPrice'];
                            }else{
                                price = 0;
                            }
                            $('.product-popup-modal .aws-price').html(price);
                            
                            var features;
                            if(data.productInformation['Description']){
                                features = data.productInformation['Description'];
                            }else{
                                features = "";
                            }
                            $('#features').html(features);
                            
                            var starRatingHtml = "";
                                $stars = data.productInformation['Review'][0].value;
                                $fStar = Math.floor($stars);
                                $cStar = Math.ceil($stars);
                                $halfStar = -1;
                                if ($fStar == $cStar)
                                    $halfStar = $cStar;

                                for($i=1; $i<=5; $i++){
                                    if($i <= $fStar){
                                        starRatingHtml += '\
                                        <span class="star active">\
                                            <i class="m-icon--star-blue-full"></i>\
                                        </span>\
                                        ';
                                    }else if($cStar == $i){
                                        starRatingHtml += '\
                                        <span class="star half">\
                                            <i class=" m-icon--star-blue-half2"></i>\
                                        </span>\
                                        ';
                                    }else{
                                        starRatingHtml += '\
                                        <span class="star">\
                                            <i class=" m-icon--star-blue-full-lines"></i>\
                                        </span>\
                                        ';
                                    }
                                }
                                $(".product-popup-modal .critic .star-rating").html(starRatingHtml);
                                var counter = data.productInformation['Review'][0].counter == '' ? 0 : data.productInformation['Review'][0].counter;
                                if(counter>1){
                                    var starRatingLabelHtml =  counter + '\
                                        <span class="light-black">\
                                            Reviews\
                                        </span>\
                                    ';
                                }else{
                                    var starRatingLabelHtml =  counter + '\
                                        <span class="light-black">\
                                            Review\
                                        </span>\
                                    ';
                                }
                                $(".product-popup-modal .critic .star-rating-label").html(starRatingLabelHtml);

                            var criticOuterRatingHtml = "";
                                if(data.productInformation['Review']){
                                    var outrReviews = data.productInformation['Review'].slice(2);
                                    for( reviewKey in outrReviews ){
                                        var review = outrReviews[reviewKey];
                                        console.log("reviewKey", reviewKey)
                                        console.log("review", review)
                                        criticOuterRatingHtml += '\
                                            <div class="critic-outer-rating">\
                                                <div class="line-label ">\
                                                    <a\
                                                        href="' + review.link + '"\
                                                        target="_blank">'+ review.key + '\
                                                    </a></div>\
                                                <div class="star-rating" style="text-align: center">';
                                                
                                                    $stars = review.value ? review.value : 0;
                                                    $fStar = Math.floor($stars);
                                                    $cStar = Math.ceil($stars);
                                                    $halfStar = -1;
                                                    if ($fStar == $cStar)
                                                        $halfStar = $cStar;
                                                    // TODO - move to model or Angular

                                                    for($i=1; $i<=5; $i++){
                                                        if($i <= $fStar){
                                                            criticOuterRatingHtml += '\
                                                                <span class="star active">\
                                                                    <i class="m-icon--star-blue-full"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                        else if($cStar == $i){
                                                            criticOuterRatingHtml += '\
                                                                <span class="star half">\
                                                                    <i class=" m-icon--star-blue-half2"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                        else{
                                                            criticOuterRatingHtml += '\
                                                                <span class="star">\
                                                                    <i class=" m-icon--star-blue-full-lines"></i>\
                                                                </span>\
                                                            ';
                                                        }
                                                    }
                                        criticOuterRatingHtml += '\
                                                </div>\
                                            </div>\
                                        ';
                                    }
                                }
                            jQuery(".product-popup-modal .critic #critic-outer-rating-holder").html(criticOuterRatingHtml);

                            var starRatingHtml = "";
                                $stars = data.productInformation['Review'][1].value;
                                $fStar = Math.floor($stars);
                                $cStar = Math.ceil($stars);
                                $halfStar = -1;
                                if ($fStar == $cStar)
                                    $halfStar = $cStar;

                                for($i=1; $i<=5; $i++){
                                    if($i <= $fStar){
                                        starRatingHtml += '\
                                        <span class="star active">\
                                            <i class="m-icon--star-blue-full"></i>\
                                        </span>\
                                        ';
                                    }else if($cStar == $i){
                                        starRatingHtml += '\
                                        <span class="star half">\
                                            <i class=" m-icon--star-blue-half2"></i>\
                                        </span>\
                                        ';
                                    }else{
                                        starRatingHtml += '\
                                        <span class="star">\
                                            <i class=" m-icon--star-blue-full-lines"></i>\
                                        </span>\
                                        ';
                                    }
                                }
                                $(".product-popup-modal .amazon .star-rating").html(starRatingHtml);
                                var counter = data.productInformation['Review'][1].counter == '' ? 0 : data.productInformation['Review'][1].counter;
                                var starRatingLabelHtml = '<a href="' + (data.productInformation['Review'][1].link ? data.productInformation['Review'][1].link : "#") + '" target="_blank">'; 
                                if(counter>1){
                                    starRatingLabelHtml +=  counter + '\
                                        <span class="light-black">\
                                            Reviews\
                                        </span>\
                                    ';
                                }else{
                                    starRatingLabelHtml +=  counter + '\
                                        <span class="light-black">\
                                            Review\
                                        </span>\
                                    ';
                                }
                                starRatingLabelHtml += "</a>";
                                $(".product-popup-modal .amazon .star-rating-label").html(starRatingLabelHtml);
                            
                            var criticQuoteHtml = '\
                                <div>' + (data.productInformation['ReviewExtLink'] ? data.productInformation['ReviewExtLink'] : "") + '</div>';
                            $('.product-popup-modal .critic-quote').html(criticQuoteHtml);

                            $http({
                                url: '/api/comment/get-product-comment/'+productId,
                                method: "GET"
                            }).success(function (result) {
                                var comments = result.data;
                                var commentsCount = comments.length;
                                var commentsCountView = commentsCount < 2 ? commentsCount +" "+"Comment" : commentsCount +" "+"Comments";
                                var commentsHtml = "";
                                for(var i=0; i<comments.length; i++){
                                    var comment = comments[i];
                                    commentsHtml += '\
                                        <div class="p-comment-row">\
                                            <div class="pull-left text-center p-comment-user">\
                                                <img src="'+ comment.Picture + '" width="50px" class="p-photo"><br>' + comment.UserName + '</div>\
                                            <div class="p-comment">'
                                                + comment.Comment +
                                                '<div class="p-footer">\
                                                    <time class="p-time pull-left">'+comment.PostTime+'</time>\
                                                    <div class="clearfix"></div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    ';
                                }
                                
                                
                                $('.p-comment-content-holder').html(commentsHtml);
                                $('.p-comment-responses').html(commentsCountView);
                                console.log("comments", comments)
                              //  console.log($scope.comments.length);
                            });

                            
                    jQuery('#product-slider').royalSlider({
                        loop: false,
                        keyboardNavEnabled: true,
                        controlsInside: false,
                                imageScaleMode: 'fit',
                        arrowsNavAutoHide: false,
                        controlNavigation: 'thumbnails',
                        thumbsFitInViewport: false,
                        navigateByClick: true,
                        startSlideId: 0,
                        autoPlay: false,
                        transitionType: 'move',
                        globalCaption: false,
                        autoScaleSlider: false,
                                imgHeight: "100%",
//                                imgWidth: "100%",
//                                imgWidth: "100%",
//                                autoHeight: true,
                        deeplinking: {
                          enabled: true,
                          change: false
                        },
                        
                        autoHeight: true,
                    });
                    document.getElementById( 'product-slider' ).style.visibility = 'visible';
                        }
                    });                    
                    
                }, 100);

            })
            modalInstance.result.finally(function(){
                var className = document.getElementsByTagName('html')[0].className;
                className = className.replace('hide-overflow', '');
                document.getElementsByTagName('html')[0].className = className;
            });
        };

        pagingApi.fakeUpdateCounts = function ($service) {
            var currentCounters =  $('.share-buttons a[data-service="' + $service + '"]').children('.share-count');
            var totalCounters = $('b.share-count.all');
			
			var currentCount = Number(currentCounters.html());
			currentCounters.html(currentCount + 1);

			var totalCount = Number(totalCounters.html());
			totalCounters.html(totalCount + 1);
		}

        pagingApi.openSharingModal = function ($service, $scope) {
            var baseUrl = 'https://' + window.location.host + window.location.pathname;
            var shareUrl = false;

            var $pitnerestShare = function(){
                    var e=document.createElement('script');
                    e.setAttribute('type','text/javascript');
                    e.setAttribute('charset','UTF-8');
                    e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
                    document.body.appendChild(e);

                setTimeout(function(){
					pagingApi.fakeUpdateCounts('pinterest');
                }, 10000);
            }

            switch($service){
                case 'facebook':
                    shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + baseUrl;
                    break;
                case 'twitter':
                    shareUrl = 'https://twitter.com/share?url=' + baseUrl + '&counturl=' + baseUrl + '&text=@Ideaing';
                    break;
                case 'googleplus':
                    shareUrl = 'https://plus.google.com/share?url=' + baseUrl;
                    break;
                case 'pinterest':
                    $pitnerestShare();
                    return true
            }

            if(!shareUrl){
                return false;
            }

            //$scope.openWindow = function() {
            var $modal = $window.open(shareUrl, 'C-Sharpcorner', 'width=500,height=400');
            //};

            // TODO -- fire counter updates for shares, only on pages where they are used (CMS)

            var timer = setInterval(function() {
                if($modal.closed) {
                    clearInterval(timer);

                    setTimeout(function(){
			pagingApi.fakeUpdateCounts($service);
                    }, 2000);
                    //setTimeout(function(){
                    //    $scope.countSocialShares();
                    //}, 1000);
                    console.log('share counters updated')
                }
            }, 1000);

        };
        
        
        

        pagingApi.getPlainContent = function(page, limit, tag, type, productCategoryID, sortBy) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + tag + '/' + type + '/' + productCategoryID + '/' + sortBy,
            });
        }

        pagingApi.getGridContent = function(page, limit, tag, type, ideaCategory) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-grid-content/' + page + '/' + limit + '/' + tag + '/' + type + '/' + ideaCategory,
            });
        }

        pagingApi.getFilteredContent = function(currentPage, $tag, $type, $sliceFunction) {
            var promiseArray = [];

            for(var $page = 1; $page < currentPage + 1; $page++) {

                promiseArray.push(
                    $http.get('/api/paging/get-grid-content/' + $page + '/' + 9 + '/' + $tag+ '/' + $type)
                );
            }

            var $return = $q.all(promiseArray).then(function successCallback(response) {
                var $i = 0;
                var $filtered = [];

                response.forEach(function(batch) {

                    var endContent = [];

                    endContent['regular'] = batch.data['regular'];

                    if($type != null && $type != 'idea'){
                        endContent['featured'] = [];
                    }else{
                        endContent['featured'] =  batch.data['featured']; // we don't filter
                    }

                    $filtered[$i] = $sliceFunction(endContent['regular'], endContent['featured'] );
                    $i++;
                });

                var $return = $filtered;

                return $return;
            });
            return $return;
        }

        return pagingApi;
    })


//
//angular.module('pagingApp.services', []).
//    factory('pagingApi', function($http, $q) {
//
//        var pagingApi = {};
//
//        pagingApi.getGridContent = function(page, limit, tag, category) {
//            return $http({
//                method: 'GET',
//                url: '/api/paging/get-content/' + page + '/' + limit + '/' + tag + '/' + category,
//            });
//        }
//
//        pagingApi.getFilteredContent = function(currentPage, $tag, $category, $sliceFunction) {
//            var promiseArray = [];
//
//            for(var $page = 1; $page < currentPage + 2; $page++) {
//
//                promiseArray.push(
//                    $http.get('/api/paging/get-content/' + $page + '/' + 9 + '/' + $tag+ '/' + $category)
//                );
//            }
//
//            var $return = $q.all(promiseArray).then(function successCallback(response) {
//                var $i = 0;
//                var $filtered = [];
//
//                response.forEach(function(batch) {
//
//                    var endContent = [];
//
//                    endContent['regular'] = batch.data['regular'];
//
//                    if($category != null && $category != 'idea'){
//                        endContent['featured'] = [];
//                    }else{
//                        endContent['featured'] =  batch.data['featured']; // we don't filter
//                    }
//
//                    $filtered[$i] = $sliceFunction(endContent['regular'], endContent['featured'] );
//                    $i++;
//                });
//
//                var $return = $filtered;
//
//                return $return;
//            });
//            return $return;
//        }
//
//        return pagingApi;
//    });

/*.factory('layoutApi', function($http) {

        var layoutApi = {};

        layoutApi.getProductsForShopMenu = function() {
            return $http({
                method: 'GET',
                url: '/api/layout/get-shop-menu/',
            });
        }


        return layoutApi;
    })
    .directive('a', function() {
        return {
            restrict: 'E',
            link: function(scope, elem, attrs) {
                if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
                    elem.on('click', function(e){
                        e.preventDefault();
                    });
                }
            }
        };
    });*/
;

angular.module('pagingApp').value('cgBusyDefaults',{
    message:'',
    backdrop: false,
    templateUrl: '/assets/svg/spinner.html',
    delay: 300,
    minDuration: 700,
    wrapperClass: ''
});

angular.module('pagingApp.filters', [])
    .filter('getURISegment', function($location) {
        return function(segment) {
            var baseUrl = $location.protocol() + '://' + $location.host() + '/';

            var query = $location.absUrl().replace(baseUrl, '');
            var data = query.split("/");
            if(data[segment-2]) {
                return data[segment-2];
            }
            return false;
        }
    });

// bootstrap for modularization ( add id="pagingApp" with initializing ng-app='pagingApp')
//angular.bootstrap(document.getElementById('pagingApp'),['pagingApp']);



