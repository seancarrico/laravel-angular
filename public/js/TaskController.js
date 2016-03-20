app.controller('TaskController',  function($state,$http,$rootScope, $scope,$auth) {

    $scope.tasks=[];
    $scope.newTask={};

    $scope.init = function (){

        $http.get('/api/task').success(function(data){
            $scope.tasks=data;
        })
    };

    $scope.save = function(){
        $http.post('/api/task',$scope.newTask).success(function (data) {
            $scope.tasks.push(data);
            $scope.newTask={};
        });
    };

    $scope.update = function(index){
        $http.put('/api/task/'+ $scope.tasks[index].id,$scope.tasks[index]);
    };

    $scope.delete = function(index){
        $http.delete('/api/task/'+ $scope.tasks[index].id).success(function(){
            $scope.tasks.splice(index,1);
        });
    };

    $scope.logout = function() {
        $auth.logout().then(function() {
            localStorage.removeItem('user');
            $rootScope.authenticated = false;
            $rootScope.currentUser = null;
            $state.go('login');
        });
    };

    $scope.init();

});