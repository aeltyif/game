app.controller('CharacterController', function($scope, $http, API_URL) {
    $scope.error = '';
    $scope.explored = 0;
    var activeModal = $('#newModal');
    var exploreWith = 0;
    var getCharacter = function() {
        $http.get(API_URL + "character")
        .success(function(response) {
            $scope.characters = response;
        });
    }

    //-- Get all character from the API
    getCharacter();

    //-- Show modal $scope.generatedform
    $scope.toggle = function(modalstate, id) {
        switch(modalstate) {
            case 'new':
                activeModal = $('#newModal');
                $scope.title = 'Add new character';
                break;
            case 'explore':
                activeModal = $('#exploreModal');
                $scope.title = 'Exploring The Game';
                exploreWith = id;
                $scope.explored = 0;
                $scope.fightResults = 0;
                $scope.generated = '';
                break;
            case 'fight':
                activeModal = $('#fightModal');
                $scope.title = 'Fighting Villain';
                break;
            default:
                break;
        }
        activeModal.modal('show');
    };

    //-- Add new character
    $scope.save = function() {
        $scope.error = '';
        $http({
            method: 'POST',
            url: API_URL + "character",
            data: $.param($scope.character),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){
            //-- Reload the characters data
            getCharacter();
        }).error(function(response){
            $scope.error = response.message;
        });
        activeModal.modal('hide');
    };

    //-- Delete Character
    $scope.deleteCharacter = function(id) {
        var confirm = window.confirm('Are you sure you want to delete this character ?');
        if(confirm) {
            $http({
                method: 'DELETE',
                url: API_URL + 'character/' + id
            }).success(function(response) {
                //-- Reload the characters data
                activeModal.modal('hide');
                getCharacter();
            }).error(function(response){
                console.log(response);
            });
        }
    };

    //-- Explore using a character
    $scope.explore = function() {
        $http.get(API_URL + "explore/" + exploreWith).success(function(response){
            $scope.explored+=1;
            if(response.code.length) {
                $scope.generated = response.code;
                $scope.villain = response.villain;
            }
        }).error(function(response) {
            console.log(response);
        });
    }

    //-- Fight the villain when found
    $scope.fight = function() {
        $http.get(API_URL + "fight/" + $scope.generated).success(function(response){
            $scope.fightResults = response;
        }).error(function(response) {
            $scope.error = response.message;
        });
        activeModal.modal('hide');
        getCharacter();
    }

    //-- Populate hero types
    $http.get(API_URL + "hero")
    .success(function(response) {
        $scope.heroes = response;
    });
});
