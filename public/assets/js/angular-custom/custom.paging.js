angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.content = [];
        $scope.newStuff = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );

        pagaingApi.getContent(1).success(function (response) {
            $scope.content[0] = response;
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            pagaingApi.getContent(currentPage).success(function (response) {
                $scope.newStuff[0] = response;
                $scope.content = $scope.content.concat($scope.newStuff);
                console.log($scope.content)
            });

        };
    });

angular.module('pagingApp', [
    'pagingApp.controllers',
    'pagingApp.services'
]);

angular.module('pagingApp.services', []).
    factory('pagaingApi', function($http) {

        var pagaingApi = {};

        pagaingApi.getContent = function(offset) {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content/' + offset,
            });
        }

        return pagaingApi;
    });