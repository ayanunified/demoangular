'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('storyCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, USAtest) {
  

  $scope.getstory = function(){

          var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.get(configService.getEnvConfig().apiURL + "stories", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
           


            if (data.status == 1) {
          
                          
             $scope.content = data.data[0].story_content;



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