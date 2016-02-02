angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];
        //$scope.globalOffset = 0;

        $scope.firstLoad = pagaingApi.getContent(1, 0).success(function (response) {
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

            $scope.nextLoad =  pagaingApi.getContent($scope.currentPage, $limit, $scope.filterBy).success(function (response) {
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
                        $scope.nextLoad = pagaingApi.getContent(1).success(function (response) {
                            $scope.allContent[0] = response;
                            $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
                        });

                            $scope.content = $replacer;
                            $('.main-content').fadeIn();

                        return true;

                    }
                //else if(typeof $scope.filterBy !== 'undefined' && $scope.filterBy && $scope.filterBy !== null){ // change from one filter to another - reset to the first pagination
                //    $scope.currentPage = 1;
                //
                //    console.log('3')
                //}

               $scope.filterBy = $criterion;

               $scope.nextLoad = pagaingApi.getData($scope.currentPage, $criterion, $scope.sliceToRows).then(function(response){
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




    });

angular.module('pagingApp', [
    'pagingApp.controllers',
    'pagingApp.services',
    //'pagingApp.directives',
    'cgBusy'
]);

angular.module('pagingApp.services', []).
    factory('pagaingApi', function($http, $q) {

        var pagaingApi = {};

        pagaingApi.getContent = function(page, limit, only, offset) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + only + '/' + offset,
            });
        }

        pagaingApi.getData = function(currentPage, $criterion, $sliceFunction) {
            var promiseArray = [];

            for(var $page = 1; $page < currentPage + 1; $page++) {

                promiseArray.push(
                    $http.get('/api/paging/get-content/' + $page + '/' + 9 + '/' + $criterion)
                );
                $page++;
            }

            var $return = $q.all(promiseArray).then(function successCallback(response) {
                var $i = 0;
                var $filtered = [];

                response.forEach(function(batch) {
                    console.log('page');
                    console.log($i);

                        var endContent = [];

                        endContent['regular'] = batch.data['regular'];

                        if($criterion != null && $criterion != 'idea'){
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
    wrapperClass: 'my-class my-class2'
});
