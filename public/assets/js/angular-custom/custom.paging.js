angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.allContent = [];
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );

        $scope.firstLoad = pagaingApi.getContent(1).success(function (response) {
            $scope.allContent[0] = response;
            $scope.content[0] = $scope.sliceToRows(response['regular'], response['featured']);
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            $scope.allContent[$scope.currentPage] = [];

            $scope.nextLoad =  pagaingApi.getContent($scope.currentPage).success(function (response) {
                $scope.newStuff[0] = $scope.sliceToRows(response['regular'], response['featured']);
                $scope.content = $scope.content.concat($scope.newStuff);

                $scope.allContent[$scope.currentPage]['regular']  = response['regular'];
                $scope.allContent[$scope.currentPage]['featured'] = response['featured'];
            });

        };


        $scope.filterContent = function($criterion){
            //$scope.filtered = [];
            $scope.filterBy = $criterion;
            console.log(0)
            console.log( $scope.allContent)

            var $replacer = [];
            var $i = 0;
            $scope.allContent.forEach(function(batch) {
                $scope.filtered = [];
                //$scope.filtered['regular'] = [];
                //console.log(1)
                //console.log(batch)

                $scope.filtered['regular'] =  batch['regular'].filter(checkByCriterion);

                if($criterion != null && $criterion != 'idea'){
                    //console.log($criterion)
                    $scope.filtered['featured'] = [];
                }else{
                    //console.log(3)
                    $scope.filtered['featured'] = batch['featured']; // we don't filter
                }

                if($scope.filtered['regular'].length < 9){
                    var $diff = 9 - $scope.filtered['regular'].length;

                    pagaingApi.getContent($scope.currentPage, $diff, $criterion, $scope.filtered ).success(function (response) {
                        //console.log('response')
                        //console.log(response['regular'])
                        $scope.filtered['regular'] =  $scope.filtered['regular'].concat(response['regular']);
                        //console.log(8)
                        //console.log($scope.filtered['regular'])

                        $replacer[$i] = $scope.sliceToRows($scope.filtered['regular'], $scope.filtered['featured']);

                        $i++;

                    });
                }
            }, this);

            function checkByCriterion(value){
                console.log($criterion)
                return value.type == $criterion;
            }

            //console.log(4)
            //console.log($replacer)

            $scope.content = $replacer;
            $scope.allContent = $scope.allContent.concat($replacer);


            //
            //console.log(5)
            //console.log($scope.content)
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



    });

angular.module('pagingApp', [
    'pagingApp.controllers',
    'pagingApp.services',
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