'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:MembershipsCtrl
 * @description
 * # MembershipsCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('PackageListCtrl', function($scope,$rootScope,$http,$location,configService) {
    $scope.goMembership=function(){
    	$location.path('/memberships');
    }

    $scope.transactionlist=function(){

    	    var token = localStorage.getItem('access_token');
            var config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                'access-token': token
              }
            };

       $http.get(configService.getEnvConfig().apiURL + "transactions", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);
          $scope.transactions=data.data;
          $scope.recordMsg=data.msg;
          
        }).error(
        function(data, status, header, config) {
          console.log(data);

        });

    }

	$scope.transactionlist();    
    
  });
