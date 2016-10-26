'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('aboutCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, USAtest) {
  

  $scope.getabout = function(){

          var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.get(configService.getEnvConfig().apiURL + "about", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
           


            if (data.status == 1) {
          
            $scope.content = data.data[0].about_content;
            $scope.t_content = data.data[0].trust_content;
            $scope.r_content = data.data[0].respect_content;
            $scope.p_content = data.data[0].passion_content;

                          
          



            } else {
            $rootScope.alertmsg = data.msg;
            $rootScope.class = false;
            setTimeout(function() {
               $('.alertmodal').modal('show');
            }, 500);
           


            }
          }).error(
          function(data, status, header, config) {
            console.log(data);

            // to prevent interaction outside of dialog

           $rootScope.alertmsg = "OOPS! Server Error";
           $rootScope.class = false;
            setTimeout(function() {
               $('.alertmodal').modal('show');
            }, 500);

          });


  }
      

  });