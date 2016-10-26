'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:MyprofileCtrl
 * @description
 * # MyprofileCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
  .controller('MyprofileCtrl', function($rootScope, $scope, $http, configService, $location, USAtest, $httpParamSerializerJQLike, $mdDialog) {

    $scope.regex = RegExp('^((https?|ftp)://)?([a-z]+[.])?[a-z0-9-]+([.][a-z]{1,4}){1,2}(/.*[?].*)?$', 'i');
    $scope.profileDataArr = [];
    $scope.profile = [];


    $scope.phnformatter = function(val) {
      $scope.profile.office_phone = val;
      var a = $scope.profile.office_phone;
      // var code = $('#code').val();




      var numbers = $scope.profile.office_phone.replace(/\D/g, ''),
        char = {
          0: '(',
          3: ') ',
          6: ' - '
        };
      console.log(JSON.stringify(numbers));
      $scope.profile.office_phone = '';
      a = "";
      for (var i = 0; i < numbers.length; i++) {
        a += (char[i] || '') + numbers[i];
      }






      return a;
    }
    $scope.init = function() {
      var token = localStorage.getItem("access_token");

      $scope.data = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "10+"];
      USAtest.getData().then(function(data) {
        $scope.usastate = data.data;
        //  console.log(data)        
      });

      $scope.businesstype();

      var data = $httpParamSerializerJQLike({


      });




      var config = {

        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'access-token': token
        },

      }

      $http.get(configService.getEnvConfig().apiURL + "profiledata", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
            if (data.status == 1) {
              $scope.profileDataArr = data.data;

              localStorage.setItem("refer_id", $scope.profileDataArr.refer_id);
              localStorage.setItem("memberships_id", $scope.profileDataArr.memberships_id);

              $scope.profile.first_name = $scope.profileDataArr.first_name;
              $scope.profile.last_name = $scope.profileDataArr.last_name;
              $scope.profile.username = $scope.profileDataArr.username;
              $scope.profile.email = $scope.profileDataArr.email;

              $scope.profile.businessName = $scope.profileDataArr.businessName;
              $scope.profile.address = $scope.profileDataArr.address;
              $scope.profile.suite = $scope.profileDataArr.suite;
              $scope.profile.city = $scope.profileDataArr.city;

              $scope.profile.state = $scope.profileDataArr.state;
              $scope.profile.noOfDoc = $scope.profileDataArr.noOfDoc;
              $scope.profile.businesses_id = $scope.profileDataArr.businesses_id;
              $scope.profile.refer_chanel = $scope.profileDataArr.refer_chanel;


              console.log($scope.profileDataArr.zip);
              $scope.profile.zip = $scope.profileDataArr.zip;
              $scope.profile.website = $scope.profileDataArr.website;
              $scope.profile.office_phone = $scope.profileDataArr.office_phone;
              $scope.profile.sales_person_id = ($scope.profileDataArr.sales_person_id == null) ? '' : $scope.profileDataArr.sales_person_id;







            } else {

              $rootScope.alertmsg = data.msg;
              $rootScope.class = false;
              setTimeout(function() {
                $('.alertmodal').modal('show');
              }, 500);


            }

          }).error(
          function(data, status, header, config) {
            //console.log(data);

            // to prevent interaction outside of dialog
           $rootScope.alertmsg = 'OOPS! Server error';
             $rootScope.class = false;
            setTimeout(function() {
              $('.alertmodal').modal('show');
            }, 500);

          });



    }

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


    $scope.updateProfiledata = function(profile) {
      var token = localStorage.getItem("access_token");
      console.log(profile.zip);
      var data = $httpParamSerializerJQLike({
        businessName: profile.businessName,
        businesses_id: profile.businesses_id,
        address: profile.address,
        suite: profile.suite,
        city: profile.city,
        state: profile.state,
        office_phone: profile.office_phone,
        email: profile.email,
        website: profile.website,
        noOfDoc: profile.noOfDoc,
        first_name: profile.first_name,
        last_name: profile.last_name,
        username: profile.username,
        password: profile.password,
        new_password: profile.new_password,
        sales_person_id: profile.sales_person_id,
        refer_chanel: profile.refer_chanel,
        zip: profile.zip
      });

      var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'access-token': token
        }
      }


      $http.post(configService.getEnvConfig().apiURL + "updateprofile", data, config)
        .success(
          function(data, status, headers, config) {
            console.log(data);

            if (data.access_token != '0') {

              localStorage.setItem("access_token", "");
              localStorage.setItem("access_token", data.access_token);
            }
            if (data.status == 1) {
             
            $rootScope.alertmsg = data.msg;
             $rootScope.class = true;
            setTimeout(function() {
               $('.alertmodalprofile').modal('show');
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

           $rootScope.alertmsg = 'OOPS! Server error';
           $rootScope.class = false;
            setTimeout(function() {
               $('.alertmodal').modal('show');
            }, 500);

          });


    }




  });