studycom.controller('SidenavController', function ($scope, $http) {

    $scope.topics = null;
    $scope.contacts = null;
    $scope.name = "test";
    $http.get('/topic/show').
            then(function (response) {
                $scope.topics = response.data;
            });
            
     $http.get('/contacts/show').
            then(function (response) {
                $scope.contacts = response.data;
            });

    $scope.createTopic = function () {
        var data = {
            'nom': 'projet'
        }
        $http.post('/topic/create', data).
                then(function (response) {
                    $scope.topics.push(response.data);
                });
    }

    $scope.addContact = function () {
        var data = {'nom': 'Contact',
                'idContact': 4
        };
        $http.post('/contact/add', data).
        then(function (response) {
            $scope.contacts.push(response.data);
        });
    }

    $scope.deleteContact = function (idContact) {
        $http.get('/contact/'+idContact + '/delete').
        then(function(response) {
            $window.location('http://studycomlaravel.dev/home');
        });
    };


});