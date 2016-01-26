angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );

        $scope.firstLoad = pagaingApi.getContent(1).success(function (response) {
            $scope.content[0] = $scope.sliceToRows(response['regular'], response['featured']);
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            $scope.nextLoad =  pagaingApi.getContent($scope.currentPage).success(function (response) {
                $scope.newStuff[0] = response;
                $scope.content = $scope.content.concat($scope.newStuff);
                console.log($scope.currentPage)
            });

        };

        $scope.sliceToRows = function($regular, $featured){
            var $return = [];
            $return['row-1'] = $regular.slice(0, 3);
            $return['row-2'] = $featured[0] ? [$featured[0]] : false;
            console.log($regular)

            $return['row-3'] = $regular.slice(3, 5);
            console.log($return['row-3'])

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

        pagaingApi.getContent = function(page) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + page,
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