angular.module('psnApp')
  .controller('serviceCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, USAtest) {
 $scope.arrpics = []; 
$scope.getservice = function(){

  var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.get(configService.getEnvConfig().apiURL + "services", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
           


            if (data.status == 1) {
            $scope.arrpics = ["01","02"];
            $scope.content = data.data;
            $scope.cont  = data.data;
            for(var h = 0;h < $scope.content.length;h++){

                $scope.content[h]['img'] = $scope.arrpics[h];

            }
          
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