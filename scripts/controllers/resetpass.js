angular.module('psnApp')
    .controller('forgotCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
// $scope.reset={};
        $scope.init = function(){
         setTimeout(function() {
            //    $scope.reset.email = localStorage.getItem('emailforgot');
         }, 500);
        

        }


        $scope.reset_pass = function(params,fname){

            var token = localStorage.getItem("reset_token");

             console.log(params);

            var data = $httpParamSerializerJQLike({

                email:params.email,
                password:params.password

            }
               



            );

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    'reset-token': token
                }
            }


            $http.post(configService.getEnvConfig().apiURL + "resetpassword", data, config)
                .success(
                    function(data, status, headers, config) {
                        console.log(data);



                        if (data.status == 1) {

                            //   $rootScope.loggedin = 1;
                            //   sessionStorage.setItem("loggedin", $rootScope.loggedin);
                            //   sessionStorage.setItem("landing_page", 1);


                            // if(data.access_token != '0'){
                            //   localStorage.setItem("access_token", data.access_token);
                            //   console.log(data.access_token);


                            //   }
                            //   localStorage.setItem("current_status", data.current_status);
                            //   $('.LoginModal').modal('hide');
                            //   setTimeout(function() {

                            //     $location.path("/patient");
                            //   }, 100);


                            $rootScope.alertmsg = data.msg;
                            $rootScope.class = true;
                            // $('.ForModal').modal('hide');
                            setTimeout(function() {
                                $('.alertmodalforgot').modal('show');
                            }, 500);



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