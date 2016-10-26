angular.module('psnApp')
  .controller('faqCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, USAtest) {
  
     $scope.getfaq = function () {
         
       
      var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.get(configService.getEnvConfig().apiURL + "faqs", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);



            if (data.status == 1) {

            $scope.content = data.data;
            
            $scope.heading = data.heading_text;
            console.log( $scope.content );



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