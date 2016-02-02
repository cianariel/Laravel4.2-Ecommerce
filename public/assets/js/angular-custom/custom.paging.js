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
            $('.main-content').fadeOut(500);
            //$('.homepage-grid').fadeOut();

            setTimeout(function(){

            $replacer = [];

            //if($scope.filterBy === $criterion){
            //        return true;
            //
            //}else if(typeof $criterion === 'undefined' || $criterion === null || $criterion === 'all'){
            //        $scope.nextLoad = pagaingApi.getContent(1).success(function (response) {
            //            $scope.allContent[0] = response;
            //            $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
            //        });
            //
            //            $scope.content = $replacer;
            //            $('.main-content').fadeIn();
            //
            //        return true;
            //    }else if(typeof $scope.filterBy !== 'undefined' && $scope.filterBy && $scope.filterBy !== null){ // change from one filter to another
            //        $scope.nextLoad = pagaingApi.getContent(1, 9, $criterion).success(function (response) {
            //            $replacer[0] = $scope.sliceToRows(response['regular'], response['featured']);
            //            $scope.allContent[0] = response;
            //        });
            //
            //            $scope.content = $replacer;
            //            $('.main-content').fadeIn();
            //
            //        $scope.filterBy = $criterion;
            //        return true;
            //    }


                $scope.filterBy = $criterion;
                var $replacer = [];
                var $i = 1;
                console.log( '$scope.allContent')
                console.log( $scope.allContent)
                console.log( '$scope.content')
                console.log( $scope.content)

                $scope.totalOffset = 0;

                $scope.allContent.forEach(function(batch) {

                    filtered = [];
                    filtered[$i] = [];

                    filtered[$i]['regular'] =  batch['regular'].filter(checkByCriterion);
                    var $offset = filtered[$i]['regular'].length;
                    var $diff = 9 - $offset;
                    $scope.totalOffset += $offset;

                        $scope.nextLoad = pagaingApi.getContent($i, $diff, $criterion, $scope.totalOffset).success(function (response) {

                            var $filtered = [];
                            $filtered['regular'] =  batch['regular'].filter(checkByCriterion);

                            if($criterion != null && $criterion != 'idea'){
                                $filtered['featured'] = [];
                            }else{
                                $filtered['featured'] = batch['featured']; // we don't filter
                            }

                            //if($scope.filtered['regular'].length < 9){


                            console.log('$diff')
                            console.log($diff)

                            console.log('$scope.totalOffset')
                            console.log($scope.totalOffset)


                            var $newContent =  [];
                            $newContent['regular'] =  $filtered['regular'].concat(response['regular']);

                            if($criterion == null && $criterion == 'idea' && $filtered['featured'] == []){
                                $newContent['featured'] = response['featured'];
                            }else{
                                $newContent['featured'] = [];
                            }

                            var $newStuff = $scope.sliceToRows($newContent['regular'], $newContent['featured'] );
                            $replacer[$i] = $newStuff;

                            console.log('$scope.filtered')
                            console.log($filtered)

                            console.log('$newStuff')
                            console.log($newStuff)

                            console.log('$i')
                            console.log($i)

                            $i++;

                            if($replacer.length === $scope.allContent.length){

                                //console.log('$replacer')
                                //console.log($replacer)

                                $scope.content = $replacer;

                                //$scope.allContent = $scope.allContent.concat($replacer)

                            }
                        });
                    //}
                }, this);


                function checkByCriterion(value){
                    return value.type == $criterion;
                }




            //$('.homepage-grid').fadeOut(function(){


            //});


                setTimeout(function(){
                    $('.main-content').fadeIn(1000);
                }, 1000);

            }, 500);

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

        pagaingApi.getContent = function(page, limit, only, offset) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page + '/' + limit + '/' + only + '/' + offset,
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
