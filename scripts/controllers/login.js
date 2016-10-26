'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:LoginctrlCtrl
 * @description
 * # LoginctrlCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('LoginctrlCtrl', function($scope, $timeout, $http, $cookies, $rootScope, configService, $location, $httpParamSerializerJQLike, $mdDialog) {


    $rootScope.loggedin = sessionStorage.getItem("loggedin");
    console.log($rootScope.loggedin);


    $scope.user_creds = {};

    $scope.login = function(params) {

      localStorage.setItem("username", params.email);
      localStorage.setItem("password", params.password);
      localStorage.setItem("check", params.check);

      var data = $httpParamSerializerJQLike({
        email: params.email,
        password: params.password


      });

      var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.post(configService.getEnvConfig().apiURL + "signin", data, config)
        .success(
          function(data, status, headers, config) {
            console.log(data);



            if (data.status == 1) {

              $rootScope.loggedin = 1;
              sessionStorage.setItem("loggedin", $rootScope.loggedin);
              sessionStorage.setItem("landing_page", 1);
            
             
            if(data.access_token != '0'){
              localStorage.setItem("access_token", data.access_token);
              console.log(data.access_token);

              
              }
              localStorage.setItem("current_status", data.current_status);
              $('.LoginModal').modal('hide');
              setTimeout(function() {
                 $rootScope.a = false;
                 $rootScope.b = false;
                 $rootScope.c = false;
                 $rootScope.d = false;

                $location.path("/patient");
              }, 100);



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





    $scope.init = function(params) {


      if (localStorage.getItem("check") == "true") {


        $scope.user_creds.email = localStorage.getItem("username");
        $scope.user_creds.password = localStorage.getItem("password");
        $scope.user_creds.check = true;
      }

    }

  });