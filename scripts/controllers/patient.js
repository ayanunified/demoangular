'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:PatientCtrl
 * @description
 * # PatientCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
	.controller('PatientCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
		$rootScope.user = {};
		
     
		$scope.show = true;
		var token = localStorage.getItem("access_token");
		$scope.number = '';
		if (localStorage.getItem('current_status') == 'Active') {

			localStorage.setItem("flagg", "true");
			$rootScope.status = true;

		} else {

			localStorage.setItem("flagg", "false");
			$rootScope.status = false;

		    if ($(window).width() < 768) {
		       setTimeout(function(){
			$('.resp-tabs-container h2:nth-child(3)').trigger('click');
		       },500);
		    }
		    else {
		      setTimeout(function() {

		      $('.resp-tabs-list > li:nth-child(2)').trigger('click');
		      // $('.resp-tabs-container h2:nth-child(5)').trigger('click');
		    }, 500);   
		    }


		}


		//  $scope.ssnformatter = function(val){
		// 	 	if(val == ''){
		// 			 $scope.number = '';
		// 			 return false;
		// 		 }
		// 		 var res = val; //grabs the value
		// 		 var len = res.length; //grabs the length
		// 		 $scope.number = $scope.number + res.substr(res.length - 1);
		// 		 if($scope.number.length >= 10){
		// 			 return false;
		// 		 }
		// 		 console.log($scope.number);
		// 		 len = $scope.number.length;
		// 		 var stars = len>0?len>1?len>2?len>3?len>4 ? 'XXX-XX-':'XXX-X':'XXX-':'XX':'X':''; //this provides the masking and formatting
		// 		 var result = stars+$scope.number.substring(5); //this is the result
		//          $rootScope.user.ssn = result;

		// 	 	    console.log(len);
		// 			console.log(val);
		// 	// $("#ssn1").val(result); //spits the value into the input

		//  }


	

		$scope.reset = function() {

			//location.reload();
			$scope.search_res = [];
			$scope.msg = '';
			$scope.total_due = '';
		    $scope.dobb = undefined;
			// $scope.clear_search = true;
			$scope.totalbehaviour = '';
			$scope.clinic_count = '';
			$rootScope.user = {};
			$rootScope.user.ssn1 = '';
			$rootScope.user.ssn2 = '';
			$rootScope.user.ssn3 = '';
			$scope.frm.$setPristine();
			$scope.frm.$setUntouched();




		}
		$scope.init = function() {


			$(document).on('click', '.resp-tabs-list > li:nth-child(1)', function() {

				$rootScope.user = {};
				$rootScope.user.ssn1 = '';
				$rootScope.user.ssn2 = '';
				$rootScope.user.ssn3 = '';
				$scope.search_res = [];
				$scope.msg = '';
				  $scope.dobb = undefined;
				$scope.total_due = '';
				$scope.totalbehaviour = '';
				$scope.clinic_count = '';

				$scope.frm.$setPristine();
				$scope.frm.$setUntouched();

				$rootScope.$on('childEmit', function(event, data) {
					// $rootScope.report = {};
					// $scope.frm.$setPristine();
					// $scope.frm.$setUntouched();
					// $rootScope.servdate2 = '';
					// $rootScope.serv = '';
					// $rootScope.report.example8model = [];
					// $rootScope.edit = false;
				});


				$scope.$digest();
			});


			$(document).on('click', '.resp-tabs-container h2:nth-child(1)', function() {

				setTimeout(function(){
			       $('.scroll-top').trigger('click');
			    },500);
				$rootScope.user = {};
				$rootScope.user.ssn1 = '';
				$rootScope.user.ssn2 = '';
				$rootScope.user.ssn3 = '';
				$scope.search_res = [];
				$scope.msg = '';
				$scope.dobb = '';
				$scope.total_due = '';
				$scope.totalbehaviour = '';
				$scope.clinic_count = '';

				$scope.frm.$setPristine();
				$scope.frm.$setUntouched();

				$rootScope.$on('childEmit', function(event, data) {
					// $rootScope.report = {};
					// $scope.frm.$setPristine();
					// $scope.frm.$setUntouched();
					// $rootScope.servdate2 = '';
					// $rootScope.serv = '';
					// $rootScope.report.example8model = [];
					// $rootScope.edit = false;
				});


				$scope.$digest();
			});


			USAtest.getData().then(function(data) {
				$scope.states = data.data;
				//  console.log(data)        
			});

			$scope.behaviour_list();
			$scope.dahsboard_banners();
		}

		$scope.dahsboard_banners = function() {

			var config = {
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				}
			}


			$http.get(configService.getEnvConfig().apiURL + "dashboardbanners", config)
				.success(
					function(data, status, headers, config) {
						console.log(data);



						if (data.status == 1) {
							$scope.dashboard_banners = data.data;
							$scope.dashboard_top = data.data[0].img_path;
							$scope.dashboard_lefttop = data.data[1].img_path;
							$scope.dashboard_leftbottom = data.data[2].img_path;

						} else {
							// $rootScope.alertmsg = data.msg;
							// $rootScope.class = false;
							// setTimeout(function() {
							//    $('.alertmodal').modal('show');
							// }, 500);



						}
					}).error(
					function(data, status, header, config) {
						console.log(data);

						// to prevent interaction outside of dialog

						//  $rootScope.alertmsg = "OOPS! Server Error";
						//  $rootScope.class = false;
						//   setTimeout(function() {
						//      $('.alertmodal').modal('show');
						//   }, 500);

					});






		}

		$scope.behaviour_list = function() {


			var config = {
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
				}
			}


			$http.get(configService.getEnvConfig().apiURL + "behaviorlists", config)
				.success(
					function(data, status, headers, config) {
						console.log(data.data);

						$scope.behaviour = data.data;


					}).error(
					function(data, status, header, config) {
						console.log(data);
					});


		}


		$scope.toggle = function(param) {

			if (param == 'ssn') {
				$scope.show = true;
				$scope.frm.$setPristine();
				$scope.frm.$setUntouched();

				$scope.search_res = false;
			

				$rootScope.user = {};

			} else {

				$scope.show = false;
				$scope.frm.$setPristine();
				$scope.frm.$setUntouched();
				$scope.search_res = false;
            
				$rootScope.user = {};

			}

		}


		// Child Tab
		$scope.$on('$viewContentLoaded', function() {
			//needed action   


			var date = new Date();
			var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
			$('#PatientReports').easyResponsiveTabs({
				type: 'vertical',
				width: 'auto',
				fit: true,
				tabidentify: 'ver_1'
			});


			$('#search_date').datetimepicker({
				format: 'MM/DD/YYYY',
				maxDate: today,
				useCurrent: false,
				ignoreReadonly : true
			}).on('dp.change', function(ev) {

				console.log(ev.date);
				$rootScope.user.dob = $filter('date')(ev.date._d, 'MM-dd-yyyy');
				console.log("date" + $rootScope.user.dob);
				$scope.dobb = $rootScope.user.dob;
				console.log($scope.dobb);




			});







			$('#ssn1').on('keydown keyup mousedown mouseup', function() {
				var res = this.value, //grabs the value
					len = res.length, //grabs the length
					max = 9, //sets a max chars
					stars = len > 0 ? len > 1 ? len > 2 ? len > 3 ? len > 4 ? '***-**-' : '***-*' : '***-' : '**' : '*' : '', //this provides the masking and formatting
					result = stars + res.substring(5); //this is the result
				$(this).attr('maxlength', max); //setting the max length
				$("#ssninput").val(result); //spits the value into the input
			});


		})







		$scope.searchpatients = function(params) {
			console.log(params);
			console.log($scope.dobb != undefined);
			if ($scope.dobb != undefined) {
				params['dob'] = $scope.dobb;
			}

			if (params.ssn1 && params.ssn2 && params.ssn3) {

				$scope.ssn = params.ssn1 + params.ssn2 + params.ssn3;
				params['ssn'] = $scope.ssn;
			}


			console.log(params);
			var data = $httpParamSerializerJQLike(params);

			var config = {

				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'access-token': token

				}
			}


			$http.post(configService.getEnvConfig().apiURL + "searchpatients", data, config)
				.success(
					function(data, status, headers, config) {
						console.log(data);
						console.log(data.data.length);

						if (data.access_token != '0') {

							localStorage.setItem("access_token", data.access_token);

							console.log(data.data);
						}


						$scope.length = data.data.length
						$scope.search_res = [];
						$scope.search_res = data.data;
						// $rootScope.ssn5 = data.data.ssn.substring(5,9);
						// $scope.search_res_length = parseInt($scope.search_res.length);
						$scope.clinic_count = data.reportCount;
						$scope.total_due = data.totalDue;
						$scope.totalbehaviour = data.totalBehaviorReport;
						$scope.msg = data.msg;




					}).error(
					function(data, status, header, config) {
						console.log(data);

						// to prevent interaction outside of dialog



					});



		}





	})
