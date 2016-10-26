'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:PatientCtrl
 * @description
 * # PatientCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
	.directive
  ( 'creditCardType'
  , function(){
      var directive =
        { require: 'ngModel'
        , link: function(scope, elm, attrs, ctrl){
            ctrl.$parsers.unshift(function(value){
              scope.ccinfo.type =
                (/^5[1-5]/.test(value)) ? "mastercard"
                : (/^4/.test(value)) ? "visa"
                : (/^3[47]/.test(value)) ? 'amex'
                : (/^3[5]/.test(value)) ? 'jcb'
                : (/^6011|65|64[4-9]|622(1(2[6-9]|[3-9]\d)|[2-8]\d{2}|9([01]\d|2[0-5]))/.test(value)) ? 'discover'
                : undefined
              ctrl.$setValidity('invalid',!!scope.ccinfo.type)
              return value
            })
          }
        }
      return directive
      }
    )

  .directive
  ( 'cardExpiration'
  , function(){
      var directive =
        { require: 'ngModel'
        , link: function(scope, elm, attrs, ctrl){
            scope.$watch('[ccinfo.month,ccinfo.year]',function(value){
              ctrl.$setValidity('invalid',true)
              if ( scope.ccinfo.year == scope.currentYear
                   && scope.ccinfo.month <= scope.currentMonth
                 ) {
                ctrl.$setValidity('invalid',false)
              }
              return value
            },true)
          }
        }
      return directive
      }
    )

  .filter
  ( 'range'
  , function() {
      var filter = 
        function(arr, lower, upper) {
          for (var i = lower; i <= upper; i++) arr.push(i)
          return arr
        }
      return filter
    }
  )


	.controller('PaymentCtrl', function($scope, loader, $rootScope, $location, $locale, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
    
    var token = localStorage.getItem("access_token");
	    $scope.currentYear = new Date().getFullYear()
      $scope.currentMonth = new Date().getMonth() + 1
      $scope.months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      $scope.ccinfo = {type:undefined}
      $scope.ccinfo.membership_id = localStorage.getItem("selected_membership_id");
      $scope.selected_membership_duration=localStorage.getItem("selected_membership_duration");
      $scope.selected_membership_price=localStorage.getItem("selected_membership_price");
      $scope.selected_membership_type_name=localStorage.getItem("selected_membership_type_name");
      $rootScope.cancelflag=false;
      $scope.showinput=false;
      $scope.showDrop=false;
      
      /*$scope.ccinfo.card_no2='add_new';
      $scope.changeDrop=function(){
        $scope.ccinfo.card_no2=$scope.ccinfo.card_no2;        
      }*/


		$scope.spaceFormat=function(){
			if(($scope.ccinfo.number.length+1)%5==0){
				$scope.ccinfo.number+=" ";
			}
		}

		$scope.save = function(data){
        var fdata=angular.copy(data);
        if ($scope.paymentForm.$valid){
        $scope.mnth='';
        $scope.mnth=(fdata.expiry_month<10)?"0"+fdata.expiry_month:fdata.expiry_month;
        //var card_no_chk=(data.card_no2=='add_new')?data['card_no']=data.card_no:data['card_no']=data.card_no2;
        
        if(fdata.card_no2=='add_new' || fdata.card_no2===undefined){
          fdata['card_no']=data.card_no;
        }else{
          fdata['card_no']=data.card_no2;
        }
        
        fdata['expiry_month']=$scope.mnth;
        console.log(fdata);

        var data2 = $httpParamSerializerJQLike(fdata);
        var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
          'access-token': token
        }
      }

      $http.post(configService.getEnvConfig().apiURL + "makepayment", data2, config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
            if(data.status==1){
              $rootScope.alertMsg=data.msg;
              $('.alertmodalpayment').modal('show');
            }else{
              $rootScope.alertMsg=data.msg;
              $('.alertmodalpaymenterror').modal('show');
            }

          }).error(
          function(data, status, header, config) {
            console.log(data);
          });


        }


      }

		/*$scope.cancelPayment=function(){
       alert(localStorage.getItem("comingBack"));
        $rootScope.comingBack = localStorage.getItem("comingBack");
       
         
        if($rootScope.comingBack==true){
        
        $location.path('/memberships');
       
        }else{
        setTimeout(function(){
        $rootScope.cancelflag=true;
        $rootScope.$digest();
        $location.path('/patient');
        },1000);
        }
      
			
		}*/

    $scope.cardList=function(){

      var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
          'access-token': token
        }
      }

      $http.get(configService.getEnvConfig().apiURL + "cardlist", config)
        .success(
          function(data, status, headers, config) {
            console.log(data.data);
            if(data.status==1){
              $scope.cardlistings=data.data;
            }else{
              
            }

          }).error(
          function(data, status, header, config) {
            console.log(data);
          });      

    }

    

    $scope.cardList();    


	})