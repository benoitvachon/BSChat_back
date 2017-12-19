studycom.controller('TopicController', function ($scope, $http, $location, UserService) {
    $scope.url = $location.absUrl();


    UserService.user().then(function(user){
        $scope.user = user;
    })

    $scope.getTopic = function () {
        var splitUrl = $scope.url.split('/');
        var idTopic = splitUrl[4];
        $http.get('/topic/'+idTopic+'/get').then(function(response) {
            $scope.topic = response.data[0];
            $scope.getMessages($scope.topic.id);

        });
    };
    $scope.topic = $scope.getTopic();
    

    $scope.getMessages = function (idTopic) {
        $http.get('/topic/'+idTopic+'/posts').
                then(function (response) {
                    $scope.messages = response.data;
                });
    };

    $scope.leaveTopic = function (idTopic) {
        $http.get('/topic/'+idTopic + '/leave').
            then(function(response) {
                $window.location('http://studycomlaravel.dev/home');
            });
    };

    $scope.renameTopic = function (idTopic) {
        $http.get('/topic/'+idTopic + '/rename').
        then(function(response) {
            $scope.topic = response.data;
        });
    };

    $scope.deleteContactFromTopic = function (idTopic) {
        $http.get('/topic/' + idTopic + '/user/2/delete').
        then(function(response) {

        });
    };

    $scope.postMessage = function () {
        
        var data = {'idAuthor': $scope.user.id,
                    'idTopic': $scope.topic.id,
                    'text': $scope.text
        };
        $http.post('/topic/sendMessage', data).
                then(function (response) {
                    $scope.messages.push(response.data);
                });
        $scope.text = '';
    }
});



