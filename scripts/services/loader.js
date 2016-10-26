angular.module('psnApp')
	.provider('loader', function Loader() {
		angular.element('body').append('<div class="backdrop hide" id="backdrop"> </div><div id="loading-bar" class="loading hide"> <div class="loading-bar"></div><div class="loading-bar"></div><div class="loading-bar"></div><div class="loading-bar"></div></div>');
		// this.initiate = function() {
		// 	angular.element('body').append('<div class="backdrop hide" id="backdrop"> </div><div id="loading-bar" class="loading hide"> <div class="loading-bar"></div><div class="loading-bar"></div><div class="loading-bar"></div><div class="loading-bar"></div></div>');
		// }
		this.$get = [function() {
			var loader = {};
			loader.show = function() {
				// console.log("Showing Loader");
				angular.element(document.getElementById('backdrop')).addClass('activate-backdrop').removeClass('hide');
				angular.element(document.getElementById('loading-bar')).removeClass('hide');
			};
			loader.hide = function() {
				// console.log("Hiding Loader");
				angular.element(document.getElementById('backdrop')).addClass('hide').removeClass('activate-backdrop');
				angular.element(document.getElementById('loading-bar')).addClass('hide');
			};

			return loader;
		}];
	});