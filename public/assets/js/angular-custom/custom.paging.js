angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );
        $scope.filterLoad = [];

        $scope.firstLoad = pagaingApi.getContent(1).success(function (response) {
            $scope.allContent[0] = response;
            $scope.content[0] = $scope.sliceToRows(response['regular'], response['featured']);
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            $scope.allContent[$scope.currentPage] = [];

            if(typeof $scope.filterBy === 'undefined'){
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
            //$('.homepage-grid').fadeOut(function(){
            $replacer = [];

            if($scope.filterBy === $criterion){
                    return true;

            }else if(typeof $criterion === 'undefined' || $criterion === null || $criterion === 'all'){
                    $scope.nextLoad = pagaingApi.getContent(1).success(function (response) {
                        $scope.allContent[0] = response;
                        $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
                    });

                    $('.homepage-grid').fadeOut(1000, function(){
                        $scope.content = $replacer;
                        $('.homepage-grid').fadeIn(1000);
                    });

                    return true;
                }else if(typeof $scope.filterBy !== 'undefined'){ // change from one filter to another
                    $scope.nextLoad =  pagaingApi.getContent(1, 9, $criterion).success(function (response) {
                        $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
                        $scope.allContent[0] = response;
                    });

                    //$scope.content = [];
                    //$scope.content = $replacer;
                    //$('.main-content').fadeIn();

                    $('.homepage-grid').fadeOut(1000, function(){
                        $scope.content = $replacer;
                        $('.homepage-grid').fadeIn(1000);
                    });

                    $scope.filterBy = $criterion;
                    return true;
                }


                $scope.filterBy = $criterion;
                var $replacer = [];
                var $i = 0;
                $scope.allContent.forEach(function(batch) {

                    $scope.filtered = [];

                    $scope.filtered['regular'] =  batch['regular'].filter(checkByCriterion);

                    if($criterion != null && $criterion != 'idea'){
                        $scope.filtered['featured'] = [];
                    }else{
                        $scope.filtered['featured'] = batch['featured']; // we don't filter
                    }

                    if($scope.filtered['regular'].length < 9){
                        var $diff = 9 - $scope.filtered['regular'].length;

                        $scope.nextLoad = pagaingApi.getContent($scope.currentPage, $diff, $criterion, $scope.filtered ).success(function (response) {
                            $scope.filtered['regular'] =  $scope.filtered['regular'].concat(response['regular']);
                            if($criterion == null && $criterion == 'idea' && $scope.filtered['featured'] == []){
                                $scope.filtered['featured'] = response['featured'];
                            }
                            $replacer[$i] = $scope.sliceToRows($scope.filtered['regular'], $scope.filtered['featured']);
                            $i++;
                        });
                    }
                }, this);

                function checkByCriterion(value){
                    return value.type == $criterion;
                }

            $('.homepage-grid').fadeOut(1000, function(){
                $scope.content = $replacer;
                $('.homepage-grid').fadeIn(1000);
            });
 
            $scope.allContent = $scope.allContent.concat($replacer)

        };

        $scope.sliceToRows = function($regular, $featured){
            //console.log(7)
            //console.log($regular)
            //console.log($featured)

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
    //'pagingApp.directives',
    'cgBusy'
]);

angular.module('pagingApp.services', []).
    factory('pagaingApi', function($http) {

        var pagaingApi = {};

        pagaingApi.getContent = function(page, limit, only) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + only,
            });
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
