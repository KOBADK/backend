/**
 * @file
 * Defines the Angular JS application the run the administration frontend.
 */

// Define the angular application.
angular.module('KobaAdminApp', ['ngRoute', 'ngOverlay', 'appMessage']);

/**
 * Add authentication header to all AJAX requests.
 */
angular.module('KobaAdminApp').factory('authInterceptor', ['$rootScope', '$q', '$window', '$location',
  function ($rootScope, $q, $window, $location) {
    'use strict';

    return {
      request: function (config) {
        config.headers = config.headers || {};
        if ($window.sessionStorage.token) {
          config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
        }
        return config;
      },
      responseError: function (response) {
        if (response.status === 401) {
          // Handle auth error by redirect to front page.
          $location.path('');
        }
        return response || $q.when(response);
      }
    };
  }
]);

/**
 * Configure routes and add auth interceptor.
 */
angular.module('KobaAdminApp').config(['$routeProvider', '$locationProvider', '$httpProvider',
  function ($routeProvider, $locationProvider, $httpProvider) {
    'use strict';

    $routeProvider
      .when('/apikeys', {
        templateUrl: 'app/pages/apiKey/apikeys.html',
        controller: 'ApiKeyController'
      })
      .when('/resources', {
        templateUrl: 'app/pages/resources/resources.html',
        controller: 'ResourceController'
      })
      .when('/jobs', {
        templateUrl: 'app/pages/jobs/jobs.html'
      })
      .otherwise({
        redirectTo: '/apikeys'
      });

    $locationProvider.hashPrefix('');

    $httpProvider.interceptors.push('authInterceptor');
  }
]);
