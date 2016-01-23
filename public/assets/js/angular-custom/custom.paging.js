angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.content = [];
        $scope.currentPage = 1;
        $scope.contentBlock = angular.element( document.querySelector('.main-content') );

        pagaingApi.getContent().success(function (response) {
            $scope.content = response;
        });

        $scope.loadMore = function() {
            $scope.currentPage++;
            pagaingApi.getContent().success(function (response) {
                //$scope.content['row-1'] = $scope.content.concat(response['row-1']);
                angular.merge({}, $scope.content, response);
            });

            console.log($scope.content)
        };
    });

angular.module('pagingApp', [
    'pagingApp.controllers',
    'pagingApp.services'
]);

angular.module('pagingApp.services', []).
    factory('pagaingApi', function($http) {

        var pagaingApi = {};

        pagaingApi.getContent = function() {
            return $http({
                method: 'GET',
                url: '/api/paging/get-content'
            });
        }

        return pagaingApi;
    });