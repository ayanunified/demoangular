angular.module('psnApp')
	.controller('myreportsCtrl', function($scope, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
         $rootScope.myreport = {};
			$rootScope.myreport.example8model = []; 
     
	 	
			$scope.$on('$viewContentLoaded', function() {

			
			
            setTimeout(function(){
                //me.update();		  
			 },2000);




        });

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
						$scope.myreport.example8data = $scope.behaviour;




					}).error(
					function(data, status, header, config) {
						console.log(data);
					});


		}

		$rootScope.edit_report = function(params,flag) {
			// $(document).on('click', '.edit-icon', function() {
			
             

			var token = localStorage.getItem("access_token");
			localStorage.setItem("id", params);

			var data = $httpParamSerializerJQLike({


				id: params
			})

			var config = {

				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'access-token': token
				},

			}

			$http.post(configService.getEnvConfig().apiURL + "editdata", data, config)
				.success(
					function(data, status, headers, config) {
						console.log(data);
						if (data.status == 1) {
							var patients = data.data.patients;
							var data = data.data;

							// localStorage.setItem("refer_id", $scope.profileDataArr.refer_id);
							// localStorage.setItem("memberships_id", $scope.profileDataArr.memberships_id);

							$rootScope.myreport.first_name = patients.first_name;
							
							$rootScope.myreport.ssn1 = patients.ssn.substring(0, 3);
							$rootScope.myreport.ssn2 = patients.ssn.substring(3, 5);
							$rootScope.myreport.ssn3 = patients.ssn.substring(5, 9);


							$rootScope.myreport.last_name = patients.last_name;;
							// $rootScope.report.dob = patients.dob;
							$rootScope.servdate3 = patients.dob;
							$rootScope.myreport.dob = patients.dob;
                                       
							$rootScope.myreport.gender = patients.gender;
							$rootScope.myreport_address = patients.address;
							$rootScope.myreport_apno = patients.apt;
							$rootScope.myreport.city = patients.city;
							$rootScope.myreport.state = patients.state;
							$rootScope.myreport.zipcode = patients.zipcode;
							$rootScope.myreport.home_phone = patients.home_phone;
							$rootScope.myreport.report_reason = data.report_reason;
							$rootScope.myreport.balance_amount = data.balance_amount;
							$rootScope.myreport.example8model = data.behaviours;
							console.log($rootScope.myreport.example8model);
							$rootScope.myreport.servicedate = data.service_date;
							$rootScope.servdate4 = data.service_date;
							$rootScope.myreport.servicedate = data.service_date;

							$rootScope.myreport.balance_amount = data.balance_amount;
							$rootScope.myreport.note = data.note;
                                                        if(flag == true){
                                                          $rootScope.edit = true;
							
								setTimeout(function() {
										
							    if ($(window).width() < 768) {
							       setTimeout(function(){
								$('.resp-tabs-container h2:nth-child(5)').trigger('click');
							       },500);
							    }
							    else {
							      setTimeout(function() {

							      $('.resp-tabs-list > li:nth-child(3)').trigger('click');
							      // $('.resp-tabs-container h2:nth-child(5)').trigger('click');
							    }, 500);   
							    }

								}, 1000);
							}
							else{

								 $rootScope.edit = true;
							}
                             	 
							//   localStorage.setItem("values",JSON.stringify(data));
						
							// $scope.$broadcast('myreports', {'broadval':data}); // going down!


							// setTimeout(function() {

							
							// 	//  location.reload();


							// }, 500);





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






$scope.behaviour_list();


	});
