var studycom = angular.module('studycom', []);

studycom.factory('UserService', function($http) {
    return {
        user : function () {
            return $http.get('/user/auth').then(function (response) {
                return response.data;
            });
        }
    }

});