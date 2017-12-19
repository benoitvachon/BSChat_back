studycom.controller('ContactController', function ($scope, $http, $location, UserService) {
    $scope.url = $location.absUrl();


    UserService.user().then(function(user){
        $scope.user = user;
    })

    $scope.getContact = function () {
        var splitUrl = $scope.url.split('/');
        var idContact = splitUrl[4];
        $http.get('/contact/'+idContact+'/get').then(function(response) {
            $scope.contact = response.data[0];
        });
    };
    $scope.contact = $scope.getContact();

    $scope.getTopic = function () {

        var splitUrl = $scope.url.split('/');
        var idContact = splitUrl[4];

        $http.get('/contact/topic/' + idContact +'/get').then(function(response) {
            $scope.topic = response.data[0];
            console.log(response.data);
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



