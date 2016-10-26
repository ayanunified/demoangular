angular.module('psnApp')
  .controller('testimonialCtrl', function($scope,$timeout, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, USAtest) {

  $timeout(function() {
		ImageFitCont();
		
		var $grid = $('.testimonial-blocks .grid').masonry({
			itemSelector: '.testimonial-blocks .grid .grid-item',
			percentPosition: true,
		  });

		}, 500);
  

	
   $scope.gettesti = function(){

 var config = {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }


      $http.get(configService.getEnvConfig().apiURL + "testimonial", config)
        .success(
          function(data, status, headers, config) {
            console.log(data);
           


            if (data.status == 1) {
         
             $scope.testi = data.data;
             $scope.heading = data.heading_text;



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