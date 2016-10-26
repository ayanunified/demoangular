angular.module('psnApp')
    .controller('signupctrl', function($rootScope, $scope, $timeout, $ocLazyLoad, $http, configService, USAtest, $httpParamSerializerJQLike, $mdDialog) {
        $scope.regex = RegExp('^((https?|ftp)://)?([a-z]+[.])?[a-z0-9-]+([.][a-z]{1,4}){1,2}(/.*[?].*)?$', 'i');

        $scope.signup = {};
        $scope.nextstep = true;
        $scope.nextstep2 = false;
        $scope.offc_phn = "";
        $scope.phnformatter = function(val) {
            $scope.offc_phn = val;
            var a = $scope.offc_phn;
            // var code = $('#code').val();




            var numbers = $scope.offc_phn.replace(/\D/g, ''),
                char = {
                    0: '(',
                    3: ') ',
                    6: ' - '
                };
            console.log(JSON.stringify(numbers));
            $scope.offc_phn = '';
            a = "";
            for (var i = 0; i < numbers.length; i++) {
                a += (char[i] || '') + numbers[i];
            }






            return a;
        }


        $(document).on('hidden.bs.modal', function(event) {

            event.preventDefault();

            // $scope.loginfrm.$setPristine();



            $scope.signupfrm.$setPristine();
            // $scope.signupfrm.$setValidity(false);
            //    $scope.signupfrm.$setUntouched();

            //     $scope.ForModal.$setValidity();
            //    $scope.ForModal.$setUntouched();

            $scope.$apply();

        });



        $scope.showfirst = function() {

            $scope.nextstep = true;
            $scope.nextstep2 = false;


        }



        $scope.showsecond = function() {

            $scope.nextstep = false;
            $scope.nextstep2 = true;


        }



        $scope.registerfirstphase = function(fname) {
            console.log(fname);
            if (fname.$invalid || fname.$invalid === undefined) {

                return false;
            }

            var first_name = $scope.firstname;
            var last_name = $scope.Lastname;
            var Username = $scope.Username;
            var emailId = $scope.emailaddress;
            var password = $scope.pass;
            var confirm_pass = $scope.cpass;




            localStorage.setItem("first_name", first_name);
            localStorage.setItem("last_name", last_name);
            localStorage.setItem("username", Username);
            localStorage.setItem("password", password);
            localStorage.setItem("email", emailId);


            var data = $httpParamSerializerJQLike({
                emailId: Username,
                checktype: 'username'


            });

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }


            $http.post(configService.getEnvConfig().apiURL + "emailcheck", data, config)
                .success(
                    function(data, status, headers, config) {
                        console.log(data);



                        if (data.status == 1) {



                            data = $httpParamSerializerJQLike({
                                emailId: emailId,
                                checktype: 'email'


                            });


                            $http.post(configService.getEnvConfig().apiURL + "emailcheck", data, config)
                                .success(
                                    function(data, status, headers, config) {
                                        console.log(data);



                                        if (data.status == 1) {

                                            $scope.nextstep = false;
                                            $scope.nextstep2 = true;

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

                                        $rootScope.alertmsg = 'OOPS! Server error';
                                        $rootScope.class = false;
                                        setTimeout(function() {
                                            $('.alertmodal').modal('show');
                                        }, 500);

                                    });










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

                        $rootScope.alertmsg = 'OOPS! Server error';
                        $rootScope.class = false;
                        setTimeout(function() {
                            $('.alertmodal').modal('show');
                        }, 500);
                    });


        }


        $scope.init = function() {

            $scope.data = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "10+"];
            USAtest.getData().then(function(data) {
                $scope.usastate = data.data;
                //  console.log(data)        
            });

            $scope.businesstype();
        }

        //   getting business types

        $scope.businesstype = function() {
            var data = {


            };

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }


            $http.get(configService.getEnvConfig().apiURL + "businesstypes", config)
                .success(
                    function(data, status, headers, config) {
                        console.log(data.data);
                        $scope.business = data.data;


                    }).error(
                    function(data, status, header, config) {
                        console.log(data);
                    });


        }



        // register second phase



        $scope.registersecondphase = function(params) {
            console.log(params);
            // var business_name = $scope.businessname;
            // var business_type = $scope.Business_Types;
            // var address = $scope.address_info;
            // var suite = $scope.suite;
            // var state = $scope.state;
            // var country = "";
            // var email = localStorage.getItem("email");
            // var cell_phone = "";
            // var memberships_id = "";
            // var refer_id = "";
            // var city = $scope.city_info;
            // var zip = $scope.zip_info;
            // var website = $scope.web_info;
            // var off_phn = $scope.offc_phn;
            // var no_of_docs = $scope.docs;
            // var sales_person_ID = $scope.salespersonID;
            // var how_do_you_know_us = $scope.info;
            var firstname = localStorage.getItem("first_name");
            var lastname = localStorage.getItem("last_name");
            var username = localStorage.getItem("username");
            var password = localStorage.getItem("password");
            var email = localStorage.getItem("email");
            params['first_name'] = firstname;
            params['last_name'] = lastname;
            params['username'] = username;
            params['password'] = password;
            params['email'] = email;
            delete params['sign_check'];
            // var terms = $scope.sign_check;


            $http({
                    url: configService.getEnvConfig().apiURL + "signup",
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    data: $httpParamSerializerJQLike(params),

                })
                .then(function(response) {

                        console.log(response);
                        if (response.data.status == 1) {
                       
                            $scope.firstname = '';
                            $scope.Lastname = '';
                            $scope.Username = '';
                            $scope.emailaddress = '';
                            $scope.pass = '';
                            $scope.cpass = '';


                            setTimeout(function() {
                                     $scope.signup = {};
                                $scope.signupfrm2.$setPristine();
                                $scope.signupfrm2.$setUntouched();
                                  $scope.signupfrm.$setPristine();
                                $scope.signupfrm.$setUntouched();
                                

                            }, 1000);


                            // $rootScope.alertmsg = response.data.msg;

                            $rootScope.class = true;
                            setTimeout(function() {
                                $('.alertmodalsignup').modal('show');
                                $('.SignupModal').modal('hide');
                                $scope.showfirst();

                            }, 500);





                        } else {


                            $rootScope.alertmsg = response.data.msg;
                            $rootScope.class = false;
                            setTimeout(function() {
                                $('.alertmodal').modal('show');
                            }, 500);

                        }
                    },
                    function(response) { // optional

                        $rootScope.alertmsg = "OOPS! There was some problem try again.";
                        $rootScope.class = false;
                        setTimeout(function() {
                            $('.alertmodal').modal('show');
                        }, 500);

                    });


        }



        $rootScope.email_verification = function(){

              
             
        }




    });