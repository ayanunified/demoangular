'use strict';

/**
 * @ngdoc service
 * @name psnApp.USAtest
 * @description
 * # USAtest
 * Service in the psnApp.
 */
angular.module('psnApp')
  .service('USAtest', function ($http) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    this.getData = function () {
    return $http.get('WebJs/usastates.json');
}
  });
