angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];

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

            //console.log($scope.currentPage)

            $scope.nextLoad =  pagaingApi.getContent($scope.currentPage, $limit, $scope.filterBy).success(function (response) {
                $scope.newStuff[0] = $scope.sliceToRows(response['regular'], response['featured']);
                $scope.content = $scope.content.concat($scope.newStuff);

                $scope.allContent[$scope.currentPage]['regular']  = response['regular'];
                $scope.allContent[$scope.currentPage]['featured'] = response['featured'];

            });

        };

        $scope.loadMore();


        $scope.filterContent = function($criterion){
            $('.main-content').fadeOut(500, function(){
                $scope.filterBy = $criterion;

               $scope.nextLoad = pagaingApi.getData($scope.allContent, $criterion, $scope.sliceToRows).then(function(response){
                    var $newStuff = response;

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

        pagaingApi.getData = function(allContent, $criterion, $sliceFunction) {
            var promiseArray = [];
            var $totalOffset = 0;

            var $allContent = allContent;
            var $page = 1;
            allContent.forEach(function(batch) {
                var filtered = []
                filtered['regular'] = batch['regular'].filter(checkByCriterion);
                var $offset = filtered['regular'].length;
                var $diff = (9 - $offset)  + 3;
                $totalOffset += $offset;

                promiseArray.push(
                    $http.get('/api/paging/get-content/' + 1 + '/' + $diff + '/' + $criterion + '/' + $totalOffset)
                );

                $totalOffset += $diff + 5;

                $page++;

            });


            function checkByCriterion(value){
                return value.type == $criterion;
            }

            var $filtered = $q.all(promiseArray).then(function successCallback(response) {
                var $i = 0;
                var $filtered = [];

                $allContent.forEach(function(batch) {
                    console.log('page');
                    console.log($i);

                        var endContent = [];

                        endContent['regular'] =  batch['regular'].filter(checkByCriterion);

                        if($criterion != null && $criterion != 'idea'){
                            endContent['featured'] = [];
                        }else{
                            endContent['featured'] =  batch['featured']; // we don't filter
                        }

                        endContent['regular'] =  endContent['regular'].concat(response[$i].data['regular']);
                    console.log("response[$i].data['regular']");
                    console.log(response[$i].data['regular']);

                        $filtered[$i] = $sliceFunction(endContent['regular'], endContent['featured'] );
                        $i++;
                    });

                return $filtered;
            });
            return $filtered;

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
