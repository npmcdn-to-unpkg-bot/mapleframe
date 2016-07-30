var ngIndexModule = angular.module('App', [])/*.config(function($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            template: '<div>template <a href="#/book/1">next</a></div>',
            controller: 'IndexController',
        })
        .when('/book/:bookId', {
            template: '<div><a href="#/">back</a> template book</div>',
            controller: 'BookController',
            resolve: {
                // I will cause a 1 second delay
                delay: function ($q, $timeout) {
                    console.warn('resolve.delay');
                    var delay = $q.defer();
                    $timeout(delay.resolve, 1000);
                    return delay.promise;
                }
            }
        }).otherwise('/');

    //$locationProvider.html5Mode(true);
})*/.controller('AppCore', function($scope) {
    $scope._logica = "qwerty";
    /*$rootScope.$on('$locationChangeStart', function() {
        console.log(performance.now(), '$locationChangeStart user function');
    });
    $rootScope.$on('$locationChangeSuccess', function() {
        console.log(performance.now(), '$locationChangeSuccess user function');
    });
    $rootScope.$on('$viewContentLoaded', function() {
        console.log(performance.now(), '$viewContentLoaded user function');
    });
    */
    /*$scope.isLoading = true;
    $scope.log = [];
    $scope._q = "qwerty";
    $scope.planets = [
        {
            id: 2,
            name: '2asdfg'
        },
        {
            id: 1,
            name: '1qwerty'
        },
        {
            id: 3,
            name: '3zxcvb'
        },
    ];
    */

});

/*
ngIndexModule.directive('ngPlanet', function() {
    return {
        restrict: 'EAC',
        template: '<div>planet</div>',
        compile: function(templateElement, templateAttrs) {
            console.log( templateAttrs.pid );
            return {
                pre: function($scope) {
                    $scope.log.push(templateAttrs.pid.concat(' preLink'));
                },
                post: function($scope) {
                    $scope.log.push(templateAttrs.pid.concat(' postLink'));
                }
            };
        }
    };
});
*/
/*
ngIndexModule.directive('ngSystem', function ($timeout) {
    return {
        restrict: 'EAC',
        terminal: false,
        priority: 100,
        scope: false,
        compile: function compile(templateElement, templateAttrs) {
            templateElement.append('<div ng-repeat="planet in planets | orderBy: \'id\' track by planet.id">{{planet.name}}</div>');
            return {
                pre: function ($scope, element, attrs, controller) {
                    $scope.log.push('parent preLink');
                },
                post: function ($scope, element, attrs, controller) {
                    $scope.log.push('parent preLink');
                    $timeout(function(){
                        $scope.isLoading = false;
                    }, 500);
                }
            }
        }
    }
});
*/
/*
ngIndexModule.directive('ngMaple', ngMapleFactory);

ngMapleFactory.$inject = [];
function ngMapleFactory() {
    return {
        restrict: 'ECA',
        terminal: false,
        priority: 100,
        scope: false,
        compile: function compile(temaplateElement, templateAttrs) {
            warn('ngMapleFactory.compile');
        },
        transclude: false,
        template: '<div class="ngMapleFactory"><h2>ngMapleFactory</h2></div>',
        controller: function ($element) {
            warn('ngMapleFactory.controller');
            this.$transclude = function () {
                log('ngMapleFactory.controller.$transclude');
            }
            this.$onInit = function () {
                log('ngMapleFactory.controller.$onInit');
            }
            this.$onChanges = function (text) {
                log('ngMapleFactory.controller.$onChanges', text);
            }
            this.$postLink = function () {
                log('ngMapleFactory.controller.$postLink');
            }
            this.$onDestroy = function () {
                log('ngMapleFactory.controller.$onDestroy');
            }

        },
        link: function (scope, $element, attr, ctrl, $transclude) {
            warn('ngMapleFactory.link');
        }
    }
}
*/