'use strict';

/**
 * @ngdoc function
 * @name psnApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the psnApp
 */
angular.module('psnApp')
    .controller('MainCtrl', function($scope, $timeout, $ocLazyLoad, $http, configService, $rootScope, $location, slider) {
        console.log(slider);
        //  slider.then(function (params) {
        //      $scope.slider = params;
        //      console.log( $scope.slider);
        //  })

        $scope.slider = slider;
      
        $timeout(function() {
            ImageFitCont();
        }, 100);



        $scope.$on('$viewContentLoaded', function() {

			
			
            setTimeout(function(){
                var swiper = new Swiper('.home-banner', {
                    pagination: '.home-banner .swiper-pagination',
                    paginationClickable: true,
                    spaceBetween: 30,
                    effect: 'fade',
					autoplay:3000
                });
          
		  	//alert('hi');
			//$('.scroll-top').trigger('click');
            $rootScope.footer_banners();
		  
			 },2000);




        });

   


      
      


        //   $rootScope.naviagte_memberships = function () {

        //           $rootScope.memberships = true;

        //           $location.path("/myprofile");
        //       }


       
    });