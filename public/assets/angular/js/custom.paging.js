angular.module('pagingApp.controllers', []).
    controller('pagingController', function($scope, pagaingApi) {
        $scope.content = [];

        pagaingApi.getContent().success(function (response) {
            $scope.content = response;
        });
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