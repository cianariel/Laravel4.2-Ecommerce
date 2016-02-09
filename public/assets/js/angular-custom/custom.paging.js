angular.module('pagingApp.controllers', [ 'ui.bootstrap']).
    controller('pagingController', function($scope, $uibModal,$http,pagaingApi, $filter) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];
        //$scope.globalOffset = 0;

        $scope.renderHTML = function(html_code)
        {
            var decoded = angular.element('<div />').html(html_code).text();
            return decoded;
        };

        var $route =  $filter('getURISegment')(2);

        if($route == 'room'){
            $scope.currentTag = $filter('getURISegment')(3);
        }

        $scope.firstLoad = pagaingApi.getContent(1, 0, $scope.currentTag).success(function (response) {
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

            $scope.nextLoad =  pagaingApi.getContent($scope.currentPage, $limit, $scope.currentTag, $scope.filterBy).success(function (response) {
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
                    $scope.nextLoad = pagaingApi.getContent(1, 0, $scope.currentTag).success(function (response) {
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

                console.log(2)
                console.log($scope.currentTag)
                $scope.nextLoad = pagaingApi.getFilteredContent($scope.currentPage, $scope.currentTag, $criterion, $scope.sliceToRows).then(function(response){
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
    })
    .controller('ModalInstanceCtrltest', function ($scope, $uibModalInstance) {
      $scope.ok = function () {
        $uibModalInstance.close();
      };

      $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
      };
    });

//angular.module('pagingApp.directives', [])
//    .directive('a', function() {
//        return {
//            restrict: 'E',
//            link: function(scope, elem, attrs) {
//                if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
//                    elem.on('click', function(e){
//                        e.preventDefault();
//                    });
//                }
//            }
//        };
//    });


angular.module('pagingApp', [
    'pagingApp.controllers',
    'pagingApp.services',
    'pagingApp.filters',
    'cgBusy'
]);

angular.module('pagingApp.services', []).
    factory('pagaingApi', function($http, $q) {

        var pagaingApi = {};

        pagaingApi.getContent = function(page, limit, tag, category) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + tag + '/' + category,
            });
        }

        pagaingApi.getFilteredContent = function(currentPage, $tag, $category, $sliceFunction) {
            var promiseArray = [];

            for(var $page = 1; $page < currentPage + 2; $page++) {

                promiseArray.push(
                    $http.get('/api/paging/get-content/' + $page + '/' + 9 + '/' + $tag+ '/' + $category)
                );
            }

            var $return = $q.all(promiseArray).then(function successCallback(response) {
                var $i = 0;
                var $filtered = [];

                response.forEach(function(batch) {

                    var endContent = [];

                    endContent['regular'] = batch.data['regular'];

                    if($category != null && $category != 'idea'){
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

        return pagaingApi;
    });

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
angular.bootstrap(document.getElementById('pagingApp'),['pagingApp']);

