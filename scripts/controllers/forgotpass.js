angular.module('psnApp')
    .controller('forgot_pass', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {



   $scope.forgot = function(params){

              
             console.log(params);

            var data = $httpParamSerializerJQLike({
                email: params.email,



            });

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }


            $http.post(configService.getEnvConfig().apiURL + "forgetpass", data, config)
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
                             $('.ForModal').modal('hide');
                            setTimeout(function() {
                                $('.alertmodal').modal('show');
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