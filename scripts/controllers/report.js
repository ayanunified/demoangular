'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:PatientCtrl
 * @description
 * # PatientCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
	.controller('reportCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
		$rootScope.behaviourflag = false;
			$rootScope.behaviourflagg = false;
		$scope.reportfrm;

		$rootScope.serv = undefined;
		$rootScope.servdate2 = undefined;
		$rootScope.servdate3 = undefined;
		$rootScope.servdate4 = undefined;

		$scope.reg = "/^[0-9]$/";
		$rootScope.report.example8model = [];


		$(document).on('click', '.resp-tabs-list > li:nth-child(2)', function() {


			$rootScope.report = {};

			$rootScope.servdate2 = undefined;
			//	     $scope.servdate3 = '';

			$rootScope.serv = undefined;
			$scope.report.dob = '';
			$scope.report.servicedate = '';
			$scope.report.ssn1 = '';
			$scope.report.ssn2 = '';
			$scope.report.ssn3 = '';
			$rootScope.report.example8model = [];

			$rootScope.edit = false;
			$scope.reportfrm.$setPristine();
			$scope.reportfrm.$setUntouched();


		});


			$(document).on('click', '.resp-tabs-container h2:nth-child(3)', function() {

			setTimeout(function(){
	       	$('.scroll-top').trigger('click');
	    	},500);
	    	
			$rootScope.report = {};

			$rootScope.servdate2 = undefined;
			//	     $scope.servdate3 = '';

			$rootScope.serv = undefined;
			$scope.report.dob = '';
			$scope.report.servicedate = '';
			$scope.report.ssn1 = '';
			$scope.report.ssn2 = '';
			$scope.report.ssn3 = '';
			$rootScope.report.example8model = [];

			$rootScope.edit = false;
			$scope.reportfrm.$setPristine();
			$scope.reportfrm.$setUntouched();


		});

		$scope.phnformatter = function(val) {

			$rootScope.report.home = val;
			var a = $rootScope.report.home;
			// var code = $('#code').val();




			var numbers = $rootScope.report.home.replace(/\D/g, ''),
				char = {
					0: '(',
					3: ') ',
					6: ' - '
				};
			console.log(JSON.stringify(numbers));
			$rootScope.report.home = '';
			a = "";
			for (var i = 0; i < numbers.length; i++) {
				a += (char[i] || '') + numbers[i];
			}






			return a;
		}


		//  $scope.$on('myreports', function(event, data) {
		// 		console.log(data); // 'Some data'
		// 		console.log(event);
		// 	});

		$scope.init = function() {

			$rootScope.$emit('childEmit', $scope.reportfrm);

			USAtest.getData().then(function(data) {
				$scope.states = data.data;
				//  console.log(data)        
			});

			$scope.behaviour_list();

		}

		$scope.priceformatter = function(val) {
			$rootScope.report.balance_amount = val;
			var a = $rootScope.report.balance_amount;
			// var code = $('#code').val();




			var numbers = $rootScope.report.balance_amount.replace(/\D/g, ''),
				char = {
					0: '$'
				};
			console.log(JSON.stringify(numbers));
			$rootScope.report.balance_amount = '';
			a = "";
			for (var i = 0; i < numbers.length; i++) {
				a += (char[i] || '') + numbers[i];
			}






			return a;
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
						console.log("list" + data);

						$scope.behaviour = data.data;
						$scope.example8data = $scope.behaviour;




					}).error(
					function(data, status, header, config) {
						console.log(data);
					});


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



			// $('#bday').datetimepicker({
			// 	format: 'MM/DD/YYYY',
			// 	maxDate: today,
			// 	useCurrent: false
			// }).on('dp.change', function(ev) {

			// 	console.log(ev.date);
			// 	$rootScope.serv = $filter('date')(ev.date._d, 'MM-dd-yyyy');



			// 	$rootScope.$digest();


			// 	console.log($rootScope.serv);




			// });



			// $('#ServiceDate').datetimepicker({
			// 	format: 'MM/DD/YYYY',
			// 	maxDate: today,
			// 	useCurrent: false
			// }).on('dp.change', function(ev) {

			// 	console.log(ev.date);
			// 	$rootScope.servdate2 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


			// 	$rootScope.$digest();


			// 	console.log($rootScope.servdate2);




			// });





			$("[data-toggle=popover]").popover({
				container: 'body'
			});


		});







		$rootScope.report_patients = function(params, form) {
			console.log(form);

			if (form.$invalid) {
				return false;
			}

			if ((params.balance_amount === undefined || params.balance_amount == '') && params.example8model.length <= 0) {

				$rootScope.behaviourflag = true;
				return false;
			}
			$rootScope.behaviourflag = false;
			var token = localStorage.getItem("access_token");
			console.log(params);
			if ($rootScope.serv != undefined) {
				params['dob'] = $rootScope.serv;
			}

			if ($rootScope.servdate2 != undefined) {
				params['service_date'] = $rootScope.servdate2;
			}

			if (params.ssn1 && params.ssn2 && params.ssn3) {

				$scope.ssn = params.ssn1 + params.ssn2 + params.ssn3;
				params['ssn'] = $scope.ssn;
			}


			var data = $httpParamSerializerJQLike(params);

			var config = {

				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'access-token': token

				}
			}


			$http.post(configService.getEnvConfig().apiURL + "storereport", data, config)
				.success(
					function(data, status, headers, config) {
						if (data.access_token != '0') {
							localStorage.setItem("access_token", "");
							localStorage.setItem("access_token", data.access_token);

							console.log(data);

						}
						if (data.status == 1) {

							$scope.search_res = data.data;
							$scope.clinic_count = data.reportCount;
							$scope.total_due = data.totalDue;
							$scope.totalbehaviour = data.totalBehaviorReport;

							$rootScope.alertmsg = data.msg;
							$rootScope.class = true;
							setTimeout(function() {
								$('.alertmodalreport').modal('show');

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

						$rootScope.alertmsg = 'OOPS. Server error.';
						$rootScope.class = false;
						setTimeout(function() {
							$('.alertmodal').modal('show');
						}, 500);

					});




		}




		$rootScope.upate_report = function(params, form) {
			console.log(form);
			console.log(params.balance_amount);
			console.log(params.example8model.length);


			if (form.$invalid) {
				return false;
			}

			if ((params.balance_amount === undefined || params.balance_amount == '') && params.example8model.length <= 0) {

				$rootScope.behaviourflagg = true;
				return false;
			}
            $rootScope.behaviourflagg = false;
			var token = localStorage.getItem("access_token");
			console.log(params);
			var id = localStorage.getItem("id");
			params['report_id'] = id;
			if ($rootScope.serv != undefined) {
				params['dob'] = $rootScope.servdate3;
			}

			if ($rootScope.servdate2 != undefined) {
				params['service_date'] = $rootScope.servdate4;
			}
			if (params.ssn1 && params.ssn2 && params.ssn3) {

				$scope.ssn = params.ssn1 + params.ssn2 + params.ssn3;
				params['ssn'] = $scope.ssn;
			}


			var data = $httpParamSerializerJQLike(params);

			var config = {

				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'access-token': token

				}
			}


			$http.post(configService.getEnvConfig().apiURL + "updatereport", data, config)
				.success(
					function(data, status, headers, config) {
						if (data.access_token != '0') {
							localStorage.setItem("access_token", "");
							localStorage.setItem("access_token", data.access_token);

							console.log(data);

						}
						if (data.status == 1) {

							// $scope.search_res = data.data;
							// $scope.clinic_count = data.reportCount;
							// $scope.total_due = data.totalDue;
							// $scope.totalbehaviour = data.totalBehaviorReport;

							$rootScope.alertmsg = data.msg;
							$rootScope.class = true;
							setTimeout(function() {
								$('.alertmodalupdate').modal('show');

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

						$rootScope.alertmsg = 'OOPS. Server error.';
						$rootScope.class = false;
						setTimeout(function() {
							$('.alertmodal').modal('show');
						}, 500);

					});




		}






	});