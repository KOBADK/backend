/**
 * @file
 * Data service to communicate with the search node.
 */

/**
 * Data service service.
 */
angular.module('KobaAdminApp').factory('dataService', ['$http', '$q', function($http, $q) {
  'use strict';

  /**
   * Fetch content from the backend service.
   *
   * @param method
   *   HTTP method to use.
   * @param uri
   *   The URI to call.
   *
   * @returns {d.promise|promise|n.ready.promise|Tc.g.promise}
   */
  function fetch(method, uri) {
    var deferred = $q.defer();

    $http({method: method, url: uri}).
      success(function(data) {
        if (data.code && (data.code < 200 || data.code >= 300)) {
          deferred.reject({
            'status': data.status,
            'message': data.message
          });
          return;
        }

        // Resolve promise an return data.
        deferred.resolve(data);
      }).
      error(function(data, status) {
        deferred.reject({
          'status': status,
          'message': data
        });
      }
    );

    return deferred.promise;
  }

  /**
   * Send data back to the server.
   *
   * @param method
   *   HTTP method to use.
   * @param uri
   *   The URI to call.
   * @param data
   *   The JSON data to send back.
   *
   * @returns {d.promise|promise|n.ready.promise|Tc.g.promise|qFactory.Deferred.promise}
   */
  function send(method, uri, data) {
    var deferred = $q.defer();

    $http({method: method, url: uri, data: data }).
      success(function(data) {
        if (data.code && (data.code < 200 || data.code >= 300)) {
          deferred.reject({
            'status': data.status,
            'message': data.message
          });
          return;
        }

        // Resolve promise.
        deferred.resolve(data);
      }).
      error(function(data, status) {
        deferred.reject({
          'status': status,
          'message': data
        });
      }
    );

    return deferred.promise;
  }

  /**
   * Public functions exposed by this factory.
   */
  return {
    'fetch': fetch,
    'send': send
  };
}]);
