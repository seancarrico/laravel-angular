var app = angular.module('taskApp', ['ui.router', 'satellizer'])
    .config(function($stateProvider, $urlRouterProvider, $authProvider,$provide) {

        $authProvider.loginUrl = '/api/authenticate';

        $urlRouterProvider.otherwise('/login');

        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: '/js/templates/login.html',
                controller: 'AuthController'
            })
            .state('task', {
                url: '/task',
                templateUrl: '/js/templates/task.html',
                controller: 'TaskController'
            });

        function redirectWhenLoggedOut($q, $injector) {
            console.log('hello');
            return {
                responseError: function (rejection) {
                    var $state = $injector.get('$state');
                    var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

                    angular.forEach(rejectionReasons, function (value, key) {
                        if (rejection.data.error === value) {
                            localStorage.removeItem('user');
                            $state.go('login');
                        }
                    });

                    return $q.reject(rejection);
                }
            }
        }

        $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);

    });