'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:MembershipsCtrl
 * @description
 * # MembershipsCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('MembershipsCtrl', function($scope,$rootScope,$http,configService) {

    $scope.getMembershipdetails=function(){

    	var token = localStorage.getItem('access_token');

            var config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                'access-token': token
              }
            };

            $http.post(configService.getEnvConfig().apiURL + "getmembership", [], config)
              .success(
                function(data, status, headers, config) {
                  console.log(data);
                  $scope.current_membership_id = data.current_membership_id;
                  $scope.current_status = data.current_status;

                }).error(
                function(data, status, header, config) {

                });

    }

    $scope.getMembershipdetails();
    
  });
