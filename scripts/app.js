'use strict';

/**
 * @ngdoc overview
 * @name psnApp
 * @description
 * # psnApp
 *
 * Main module of the application.
 */


 function myInterceptor() {
  return {
    request: function(config) {
      return config;
    },

    requestError: function(config) {
      return config;
    },

    response: function(res) {
      if(res.data.msg == "Invalid Token.")
      {
        sessionStorage.clear();
        setTimeout(function(){

          window.location.href = "http://uiplonline.com/psn/master/#/";
        },500);
      

      }
      else if(typeof res.data.current_status !='undefined' )
      {
        
        localStorage.setItem('current_status','');
        localStorage.setItem('current_status',res.data.current_status);
      }
      return res;
    },

    responseError: function(res) {
      return res;
    }
  }
}

var app = angular
  .module('psnApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'oc.lazyLoad',
    'ngOdometer',
    'ngMessages',
    'validation.match',
    'angular-loading-bar',
    'app.config',
    'config.service',
    'ngMaterial',
    'angularjs-dropdown-multiselect',
    'hljs',
    'ui.bootstrap',
    'angularPayments',
    'ngIdle',
    'tableSort'

  ])



.factory('myInterceptor', myInterceptor)
.config(function($routeProvider, $locationProvider, IdleProvider, KeepaliveProvider, $httpProvider) {
$httpProvider.interceptors.push('myInterceptor');
  $routeProvider
    .when('/', {
      templateUrl: 'views/main.html',
      controller: 'MainCtrl',
      resolve: {
        factory2: emailVerify,
        factory: function($q, $rootScope, $location, $http, $httpParamSerializerJQLike, configService) {
          if (isLogin() == true) {
            var token = localStorage.getItem('access_token');

            var config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                'access-token': token
              }
            };

            $http.post(configService.getEnvConfig().apiURL + "getmembership", [], config)
              .success(
                function(data, status, headers, config) {
                  console.log(data.current_membership_id);
                  localStorage.setItem("current_membership_id", "");
                  localStorage.setItem("current_membership_id", data.current_membership_id);
                  localStorage.setItem("current_status", "");
                  localStorage.setItem("current_status", data.current_status);
                  $rootScope.current_membership_id = data.current_membership_id;
                  $rootScope.current_status = data.current_status;


                }).error(
                function(data, status, header, config) {

                });
          }


        },
        slider: function($http, $q, configService, $rootScope) {
          var deffered = $q.defer();
          var data = {


          };

          var config = {
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
          }


          $http.get(configService.getEnvConfig().apiURL + "sliders", config)
            .success(
              function(data, status, headers, config) {
                console.log(data);
                // $scope.slider = data.data;
                $rootScope.totcust = data.totalCustomer;
                $rootScope.totpatients = data.totalPatients;

                deffered.resolve(data.data);

              }).error(
              function(data, status, header, config) {
                console.log(data);
              });
          return deffered.promise;

        }
      }

    })

  .when('/myprofile', {
      templateUrl: 'views/myprofile.html',
      controller: 'MyprofileCtrl',
      resolve: {
        factory: checkRouting
      }

    })
    .when('/packagelist', {
      templateUrl: 'views/packagelist.html',
      controller: 'PackageListCtrl',
      resolve: {
        factory: checkRouting
      }
    })
    .when('/patient', {
      templateUrl: 'views/patient.html',
      controller: 'PatientCtrl',
      resolve: {
        factory: checkRouting,
        factory3: function($q, $rootScope, $location, $http, $httpParamSerializerJQLike, configService){
          
          if(localStorage.getItem("current_status") == "Inactive"){


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

        },
        factory2: function($q, $rootScope, $location, $http, $httpParamSerializerJQLike, configService) {

          if (localStorage.getItem("selected_membership_id")) {

            $rootScope.login_count=1;
            if(!localStorage.getItem("login_count_storage")){ 
              localStorage.setItem("login_count_storage",$rootScope.login_count); 
            }

            var token = localStorage.getItem('access_token');

            var config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                'access-token': token
              }
            };

            $http.post(configService.getEnvConfig().apiURL + "getmembership", [], config)
              .success(
                function(data, status, headers, config) {
                  console.log(data.current_membership_id);
                  localStorage.setItem("current_membership_id", "");
                  localStorage.setItem("current_membership_id", data.current_membership_id);
                  localStorage.setItem("current_status", "");
                  localStorage.setItem("current_status", data.current_status);
                  $rootScope.current_membership_id = data.current_membership_id;
                  $rootScope.current_status = data.current_status;
                  var selected_membership_id = localStorage.getItem("selected_membership_id");
                  
                  if(localStorage.getItem("login_count_storage")==1){

                    if (selected_membership_id == 1) {

                    if (selected_membership_id < data.current_membership_id) {
                     $rootScope.login_count2 = $rootScope.login_count+1;
                      localStorage.setItem("login_count_storage","");
                      localStorage.setItem("login_count_storage",$rootScope.login_count2);
                      $('.alertmodalmembershipnot').modal('show');
                    } else {
                      $location.path('/patient');
                    }

                  } else if (selected_membership_id > 1 && $rootScope.cancelflag==false) {

                    if (selected_membership_id < data.current_membership_id) {
                      $rootScope.login_count2 = $rootScope.login_count+1;
                      localStorage.setItem("login_count_storage","");
                      localStorage.setItem("login_count_storage",$rootScope.login_count2);
                      $('.alertmodalmembershipnot').modal('show');
                    } else {
                      $location.path('/payment');
                    }

                  } else if (selected_membership_id == data.current_membership_id) {
                    $rootScope.login_count2 = $rootScope.login_count+1;
                    localStorage.setItem("login_count_storage","");
                    localStorage.setItem("login_count_storage",$rootScope.login_count2);
                    $location.path('/payment');
                  } else if (selected_membership_id > data.current_membership_id) {
                    $rootScope.login_count2 = $rootScope.login_count+1;
                    localStorage.setItem("login_count_storage","");
                    localStorage.setItem("login_count_storage",$rootScope.login_count2);
                    $location.path('/payment');
                  } else if (selected_membership_id < data.current_membership_id) {
                    $rootScope.login_count2 = $rootScope.login_count+1;
                    localStorage.setItem("login_count_storage","");
                    localStorage.setItem("login_count_storage",$rootScope.login_count2);
                    $('.alertmodalmembershipnot').modal('show');
                  } 


              }

                  


                }).error(
                function(data, status, header, config) {

                });


          }


        }
      }

    })


  .when('/about', {
    templateUrl: 'views/about.html',
    controller: 'aboutCtrl',


  })

  .when('/service', {
    templateUrl: 'views/service.html',
    controller: 'serviceCtrl',

  })

  .when('/story', {
    templateUrl: 'views/story.html',
    controller: 'storyCtrl',

  })

  .when('/testimonial', {
    templateUrl: 'views/testimonial.html',
    controller: 'testimonialCtrl',


  })

  .when('/forgotpassword', {
    templateUrl: 'views/forgotpass.html',
    controller: 'forgotCtrl',
    resolve: {
      factory: checkForgot
    }


  })


  .when('/faq', {
    templateUrl: 'views/faq.html',
    controller: 'faqCtrl',


  }).when('/payment', {
    templateUrl: 'views/payment.html',
    controller: 'PaymentCtrl',
    resolve: {
      factory: checkRouting
    }

  })



  .when('/memberships', {
      templateUrl: 'views/memberships.html',
      controller: 'MembershipsCtrl',
      resolve: {
        factory: checkRouting
      }


    })
    .otherwise({
      redirectTo: '/'
    });
  // $locationProvider.html5Mode(true);


  $(document).on('hidden.bs.modal', function(event) {
    if ($('.modal:visible').length) {
      $('body').addClass('modal-open');

    }
  });



  $(".alertmodalsignup").on("hidden.bs.modal", function() {
    // put your default event here
    localStorage.setItem("signup", true);
    setTimeout(function() {
      $('.LoginModal').modal('show');

    }, 500);

  });


  $(".alertmodalforgot").on("hidden.bs.modal", function() {
    // put your default event here
    //  $location.path("/");
    setTimeout(function() {

      //  $location.path('/');
      window.location.href = "http://uiplonline.com/psn/master/#/";
      location.reload();
    }, 1000);
  });


  $(".alertmodalprofile").on("hidden.bs.modal", function() {
    // put your default event here
    location.reload();
  });


  $(".alertmodalmembership").on("hidden.bs.modal", function() {

    setTimeout(function() {
      $('.LoginModal').modal('show');

    }, 500);

  });

  $(".alertmodalpayment").on("hidden.bs.modal", function() {

    setTimeout(function() {
      window.location.href = "http://uiplonline.com/psn/master/#/";
    }, 500);

  });






  $(".alertmodalemailverify").on("hidden.bs.modal", function() {
    // put your default event here
    // location.reload();

    window.location.href = "http://uiplonline.com/psn/master/#/";

    setTimeout(function() {
      $('.LoginModal').modal('show');

    }, 500);
  });

  IdleProvider.timeout(30 * 60);
  IdleProvider.idle(10);
  KeepaliveProvider.interval(5);


});

var checkRouting = function($q, $rootScope, $location, $http, $httpParamSerializerJQLike, configService) {
  if (isLogin()) {
    var token = localStorage.getItem('access_token');

            var config = {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                'access-token': token
              }
            };

            $http.post(configService.getEnvConfig().apiURL + "getmembership", [], config)
              .success(
                function(data, status, headers, config) {
                  console.log(data.current_membership_id);
                  localStorage.setItem("current_membership_id", "");
                  localStorage.setItem("current_membership_id", data.current_membership_id);
                  localStorage.setItem("current_status", "");
                  localStorage.setItem("current_status", data.current_status);
                  $rootScope.current_membership_id = data.current_membership_id;
                  $rootScope.current_status = data.current_status;


                }).error(
                function(data, status, header, config) {

                });
    return true;
  } else {

      sessionStorage.clear();
      localStorage.setItem("selected_membership_id","");
     localStorage.setItem("current_membership_id","");
     localStorage.setItem("login_count_storage","");
     $rootScope.loggedin = 0;
                  

    setTimeout(function(){$location.path("/");},200);
    

    return false;
  }
};

var isLogin = function() {

  var uname = sessionStorage.getItem('loggedin');

  if (uname && typeof uname != 'undefined') {
    return true;
  } else {
    return false;
  }
};

var emailVerify = function($q, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {

  var abc = $location.absUrl().split('?');
  if (typeof abc[1] == 'undefined') {
    abc = '';
  } else {
    abc = abc[1];
  }

  var right = abc.split('&')[0].split('=');

  if (typeof right[1] == 'undefined') {
    right = '';
  } else {
    right = right[1];
  }


  if (right.trim() == 'verified') {

    $rootScope.class = true;
    $rootScope.alertmsg = "Your email verification is successful.You can login now."
    setTimeout(function() {
      $('.alertmodalemailverify').modal('show');
    }, 500);


  }


}


var checkForgot = function($q, $rootScope, $location, $filter, $http, $httpParamSerializerJQLike, configService, $mdDialog, USAtest) {
  $rootScope.reset={};
  var abc = $location.absUrl().split('?')[1];
  var right = abc.split('&')[0].split('=');

  if (right[0].trim() == 'token') {

    localStorage.setItem("reset_token", right[1]);

    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
        'reset-token': right[1]
      }
    }


    $http.get(configService.getEnvConfig().apiURL + "tokenvalidation", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);



          if (data.status == 1) {
            console.log(data.emailId);
             $rootScope.reset.email = data.emailId;
           setTimeout(function() {
              
              localStorage.setItem("emailforgot", "");

            localStorage.setItem("emailforgot", data.emailId);
           }, 1000);
              

            return true;




          } else {
            $rootScope.alertmsg = data.msg;
            $rootScope.class = false;
            setTimeout(function() {
              $('.alertmodal').modal('show');

            }, 500);


            setTimeout(function() {

              //  $location.path('/');
              window.location.href = "http://uiplonline.com/psn/master/#/";
              location.reload();
            }, 1000);

            return false;

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

          setTimeout(function() {

            window.location.href = "http://uiplonline.com/psn/master/#/";
            location.reload();
          }, 1000);
          return false;

        });


  }

}

app.run(['$rootScope', 'loader', '$location', function($rootScope, loader, $location) {

$rootScope.history = [];

  $(".alertmodalsession").on("hidden.bs.modal", function() {
    // put your default event here

    $rootScope.logout();
  });


  $rootScope.$on('IdleTimeout', function() {
    // end their session and redirect to login
    $rootScope.class = false;
    $rootScope.alertmsgg = "Your session is timedout";
    setTimeout(function() {

      $('.alertmodalsession').modal('show');
    }, 500);



  });


  //  $rootScope.$on('Keepalive', function() {
  //       // do something to keep the user's session alive
  //       console.log("hey there pagl;a");
  //   });

  $rootScope.stateIsLoading = false;

  $rootScope.$on('$routeChangeStart', function() {
    $rootScope.stateIsLoading = true;
    // loader.show();
  });
  $rootScope.$on('$routeChangeSuccess', function() {



    $rootScope.stateIsLoading = false;
    if ($location.path() == "/" || $location.path() == "/patient" || $location.path() == "/myprofile" || $location.path() == "/payment" || $location.path() == "/memberships") {

      $rootScope.a = false;
      $rootScope.b = false;
      $rootScope.c = false;
      $rootScope.d = false;

      // $rootScope.user={};
      //   $rootScope.report={};
    }
    // loader.hide();
 
    if($location.path() == "/memberships"){
  
    
    
      setTimeout(function(){
        $rootScope.history.push($location.$$path);

      },1000);
     
    }

    else if($location.path() != "/memberships"){
      //  localStorage.setItem("comingBack","");
      // localStorage.setItem("comingBack",false);

       $rootScope.comingBack = false;
        
    }

    setTimeout(function() {
      //alert('hi');
      $('.scroll-top').trigger('click');
      $('.navbar-collapse').collapse('hide');
    }, 1000);

    console.log($location.path());
    $rootScope.chooseselect($location.path());


  });
  $rootScope.$on('$routeChangeError', function() {
    //catch error
  });


  $(".alertmodalupdate").on("hidden.bs.modal", function() {
    // put your default event here
    $rootScope.edit = false;

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

    



  });

    $(".alertmodalreport").on("hidden.bs.modal", function() {
    // put your default event here
    //location.reload();


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

  });



}]);

// 

// app.directive('popOver', function ($compile) {
//         var itemsTemplate = "<div class='text-center'><p ng-repeat='b in reports.behavior'>{{b.label}}</p></div>";
//         var getTemplate = function (contentType) {
//             var template = '';

//             switch (contentType) {
//                 case 'items':
//                     template = itemsTemplate;
//                     break;
//             }
//             return template;
//         }
//         return {
//             restrict: "A",
//             transclude: true,
//             template: "<span ng-transclude></span>",
//             link: function (scope, element, attrs) {
//                 var popOverContent;
//                 if (scope.items) {
//                     var html = getTemplate("items");
//                     // console.log(html);
//                     popOverContent = $compile(html)(scope);                    
//                 }
//                 var options = {
//                     content: popOverContent,
//                     placement: "bottom",
//                     html: true,
//                     trigger:'hover',
//                     container:'body'
//                 };
//                 $(element).popover(options);
//             },
//             scope: {
//                 items: '=',
//                 title: '@'
//             }
//         };
//     });



app.filter('hasSomeValue', [function() {
  return function(input, param) {
    var ret = [];
    if (!angular.isDefined(param)) param = true;
    angular.forEach(input, function(v) {
      if (angular.isDefined(v.note) &&
        v.note) {
        v.note = v.note.replace(/^\s*/g, '');

        ret.push(v);
      } else {

        v.note = "empty"
        ret.push(v);

      }
    });
    return ret;
  };
}])
app.directive('popover', function($compile, $timeout) {
  return {
    restrict: 'A',
    link: function(scope, el, attrs) {
      var content = attrs.content;
      var elm = angular.element('<div />').appendTo('body');
      var options = {

        container: 'body'
      };
      elm.append(attrs.content);
      $compile(elm)(scope);
      $timeout(function() {
        el.removeAttr('popover').attr('data-content', elm.remove().html());
        el.popover(options);
      });
    }
  }
});


app.filter('myDate', function($filter) {    
    var angularDateFilter = $filter('date');
    return function(theDate) {
       return angularDateFilter(theDate, 'MM-dd-yyyy');
    }
});
app.directive('autoNext', function() {
  return {
    restrict: 'A',
    link: function(scope, element, attr, form) {
      var tabindex = parseInt(attr.tabindex);
      var maxLength = parseInt(attr.ngMaxlength);
      element.on('keyup', function(e) {
        if (element.val().length > maxLength - 1) {
          var next = angular.element(document.body).find('[tabindex=' + (tabindex + 1) + ']');
          if (next.length > 0) {
            next.focus();
            return next.triggerHandler('keyup', {
              which: e.which
            });
          } else {
            return false;
          }
        }
        return true;
      });

    }
  }
});

app.controller('indexcontroller', function(Idle,loader, $compile, $interval, $rootScope, $location, $http, configService, $mdDialog, $scope, $filter, $timeout) {
  $rootScope.is_angular_loaded=0;
  var date = new Date();
  $scope.changeStr='My Reports';
  $scope.flaggg = false;
  $rootScope.report = {};
  var minutes = 50;
  date.setTime(date.getTime() + (minutes * 60 * 1000));
  $rootScope.exp = date;
  var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

  if (isLogin()) {
    Idle.watch();

  }

  $rootScope.toMyReport=function(){
    $scope.changeStr='My Reports';
  }

  $rootScope.updateReport=function(){
   $scope.changeStr='Update Report'; 
  }


  // if(localStorage.getItem("flag")){

  //  setTimeout(function() {

  //     $('.resp-tabs-list > li:nth-child(2)').trigger('click');
  //  }, 500);



  // }

  $rootScope.cancelPayment=function(){
        
      var prevUrl =   $rootScope.history[0];
      console.log($rootScope.history);
      if(prevUrl == "/memberships"){
        
           $location.path('/memberships');
       
        }else{
        setTimeout(function(){
        $rootScope.cancelflag=true;
        $rootScope.$digest();
        $location.path('/patient');
        },1000);
        }
      

      
    
       // $rootScope.comingBack = localStorage.getItem("comingBack");
       
         
      
     
      
    }

  $rootScope.getpackages = function() {

    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }


    $http.get(configService.getEnvConfig().apiURL + "getpackages", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);



          if (data.status == 1) {
            console.log(data.data);
            $scope.subsrciptions = data.data;
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

  $rootScope.goPayment = function(id, duration, price, type_name) {

    localStorage.setItem("selected_membership_id", id);
    localStorage.setItem("selected_membership_duration", duration);
    localStorage.setItem("selected_membership_price", price);
    localStorage.setItem("selected_membership_type_name", type_name);
    var uname = sessionStorage.getItem('loggedin');
    if (uname && typeof uname != 'undefined') {
      $location.path('/payment');
    } else {
      $('.alertmodalmembership').modal('show');

    }
  }

  $scope.testi = function() {
    $rootScope.a = true;
    $rootScope.b = false;
    $rootScope.c = false;
    $rootScope.d = false;
    $rootScope.e = false;
    $location.path('/testimonial');

  }

  $scope.about = function() {

    $rootScope.a = false;
    $rootScope.b = true;
    $rootScope.c = false;
    $rootScope.d = false;
    $rootScope.e = false;
    $location.path('/about');

  }

  $scope.story = function() {

    $rootScope.a = false;
    $rootScope.b = false;
    $rootScope.c = false;
    $rootScope.d = false;
    $rootScope.e = true;
    $location.path('/story');

  }

  $scope.faq = function() {

    $rootScope.a = false;
    $rootScope.b = false;
    $rootScope.c = true;
    $rootScope.d = false;
    $rootScope.e = false;
    $location.path('/faq');

  }

  $scope.service = function() {

    $rootScope.a = false;
    $rootScope.b = false;
    $rootScope.c = false;
    $rootScope.d = true;
    $rootScope.e = false;
    $location.path('/service');

  }



  $scope.show_forgot = function() {

    $('.LoginModal').modal('show');
    $location.path('/forgot');

  }

  $scope.move_to_psn = function() {
    var uname = sessionStorage.getItem('loggedin');
    if (uname && typeof uname != 'undefined') {


    } else {

      $location.path('/');
    }

  }


  $scope.init = function() {

    $scope.getpdflink();
    $scope.getfooter_data();


  }

  $scope.getpdflink = function() {

    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }


    $http.get(configService.getEnvConfig().apiURL + "pdflink", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);



          if (data.status == 1) {
            $scope.pdflink = data.data;
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


  $rootScope.footer_banners = function() {

    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }


    $http.get(configService.getEnvConfig().apiURL + "packagebanners", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);



          if (data.status == 1) {
            $rootScope.package_banners = data.data;
            $rootScope.package_top = data.data[0].img_path;


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
  $rootScope.show_table=1;




  $scope.getfooter_data = function() {

    var config = {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }


    $http.get(configService.getEnvConfig().apiURL + "allsettings", config)
      .success(
        function(data, status, headers, config) {
          console.log(data);



          if (data.status == 1) {

            $scope.contact_mail = data.data.contact_mail;
            $scope.contact_address = data.data.contact_address;
            $scope.contact_no = data.data.contact_no;
            $scope.footer_disclaimer = data.data.footer_disclaimer;
            $scope.email_subscribe_text = data.data.email_subscribe_text;
            $scope.get_in_touch_text = data.data.get_in_touch_text;

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


  $(document).on('click', '.resp-tab-item', function() {

    $('#ssn2').on('keydown keyup mousedown mouseup', function() {
      var res = this.value, //grabs the value
        len = res.length, //grabs the length
        max = 9, //sets a max chars
        stars = len > 0 ? len > 1 ? len > 2 ? len > 3 ? len > 4 ? '***-**-' : '***-*' : '***-' : '**' : '*' : '', //this provides the masking and formatting
        result = stars + res.substring(5); //this is the result
      $(this).attr('maxlength', max); //setting the max length
      $("#ssninput2").val(result); //spits the value into the input
    });

    $('#bday').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.serv = $filter('date')(ev.date._d, 'MM-dd-yyyy');



      $rootScope.$digest();


      console.log($rootScope.serv);




    });



    $('#ServiceDate').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate2 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate2);




    });



    $('#bdayupdate').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate3 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate3);




    });


    $('#ServiceDate2').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate4 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate4);




    });


  });

  $(document).on('click', '.resp-accordion', function() {

    $('#ssn2').on('keydown keyup mousedown mouseup', function() {
      var res = this.value, //grabs the value
        len = res.length, //grabs the length
        max = 9, //sets a max chars
        stars = len > 0 ? len > 1 ? len > 2 ? len > 3 ? len > 4 ? '***-**-' : '***-*' : '***-' : '**' : '*' : '', //this provides the masking and formatting
        result = stars + res.substring(5); //this is the result
      $(this).attr('maxlength', max); //setting the max length
      $("#ssninput2").val(result); //spits the value into the input
    });

    $('#bday').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.serv = $filter('date')(ev.date._d, 'MM-dd-yyyy');



      $rootScope.$digest();


      console.log($rootScope.serv);




    });



    $('#ServiceDate').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate2 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate2);




    });



    $('#bdayupdate').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate3 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate3);




    });


    $('#ServiceDate2').datetimepicker({
      format: 'MM/DD/YYYY',
      maxDate: today,
      useCurrent: false,
      ignoreReadonly : true
    }).on('dp.change', function(ev) {

      console.log(ev.date);
      $rootScope.servdate4 = $filter('date')(ev.date._d, 'MM-dd-yyyy');


      $rootScope.$digest();


      console.log($rootScope.servdate4);




    });


  });
  
  
  
  $(document).on('click', '.resp-tabs-list > li:nth-child(1)', function() {


    $rootScope.report = {};

    $rootScope.servdate2 = '';
    $rootScope.servdate3 = '';

    $rootScope.serv = '';
    $rootScope.report.example8model = [];

    $rootScope.edit = false;
  });

  $(document).on('click', '.resp-tabs-container h2:nth-child(1)', function() {

    setTimeout(function(){
       $('.scroll-top').trigger('click');
    },500);
    
    $rootScope.report = {};

    $rootScope.servdate2 = '';
    $rootScope.servdate3 = '';

    $rootScope.serv = '';
    $rootScope.report.example8model = [];

    $rootScope.edit = false;
  });

  $(document).on('click', '.resp-tabs-list > li:nth-child(3)', function() {

    $rootScope.report = {};
      
    //$rootScope.user={};
    //  setTimeout(function() {
    //    $scope.frm.$setPristine();
    //  }, 100);
    $rootScope.servdate2 = '';
    $rootScope.serv = '';
    $rootScope.report.example8model = [];
    // $rootScope.edit = false;
    $scope.project = [];




    // $scope.$watch('project', function(newValue, oldValue) {
    //   console.log(newValue);
    //   console.log(oldValue);
    // }, true);


    var token = localStorage.getItem("access_token");

    var config = {

      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'access-token': token
      },

    }

    $http.get(configService.getEnvConfig().apiURL + "ownreports", config)
      .success(
        function(data, status, headers, config) {

          console.log(data.data);
           //me.update();
          $scope.project = [];
   
          if(data.data.length <= 0){

            $scope.flaggg = 1;
            $timeout(function() {

            $scope.project = data.data;
           
            $scope.report_behaviour = data.data.behavior;
            $scope.msgg = data.msg;
            $scope.$digest();
           
            // $rootScope.binddata = $compile("<div class='text-center'><p ng-repeat='b in reports.behavior'>{{b.label}}</p></div>");

          }, 100);
          }
          else
          {
            $scope.flaggg = 0;
             $timeout(function() {

            $scope.project = data.data;
           
            $scope.report_behaviour = data.data.behavior;
            //$scope.msgg = data.msg;
            $scope.$digest();
           
            // $rootScope.binddata = $compile("<div class='text-center'><p ng-repeat='b in reports.behavior'>{{b.label}}</p></div>");

          }, 100);
          }

         


          $timeout(function() {

            $('.example-popover').popover({
              container: 'body'
            })

          }, 100);




          /*if (data.status == 1) {




					} else {

					  $mdDialog.show(
					    $mdDialog.alert()
					    .parent(angular.element(document.querySelector('#loggin')))
					    .clickOutsideToClose(false)
					    .title('PSN')
					    .textContent(data.msg)
					    .ariaLabel('Alert Dialog Demo')
					    .ok('cancel!')

					  );


					}*/

        }).error(
        function(data, status, header, config) {
          //console.log(data);

          // to prevent interaction outside of dialog

          // $mdDialog.show(
          //   $mdDialog.alert()
          //   .parent(angular.element(document.querySelector('#loggin')))
          //   .clickOutsideToClose(false)
          //   .title('PSN')
          //   .textContent('OOPS. Server error.')
          //   .ariaLabel('Alert Dialog Demo')
          //   .ok('cancel!')

          // );

        });


  });



  $(document).on('click', '.resp-tabs-container h2:nth-child(5)', function() {

    setTimeout(function(){
       $('.scroll-top').trigger('click');
    },500);
    $rootScope.report = {};

    //$rootScope.user={};
    //  setTimeout(function() {
    //    $scope.frm.$setPristine();
    //  }, 100);
    $rootScope.servdate2 = '';
    $rootScope.serv = '';
    $rootScope.report.example8model = [];
    $rootScope.edit = false;
    $scope.project = [];




    // $scope.$watch('project', function(newValue, oldValue) {
    //   console.log(newValue);
    //   console.log(oldValue);
    // }, true);


    var token = localStorage.getItem("access_token");

    var config = {

      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'access-token': token
      },

    }

    $http.get(configService.getEnvConfig().apiURL + "ownreports", config)
      .success(
        function(data, status, headers, config) {

          console.log(data.data);

          $scope.project = [];

          $timeout(function() {

            $scope.project = data.data;

            $scope.report_behaviour = data.data.behavior;
            $scope.msg = data.msg;
            // $rootScope.binddata = $compile("<div class='text-center'><p ng-repeat='b in reports.behavior'>{{b.label}}</p></div>");

          }, 100);


          $timeout(function() {

            $('.example-popover').popover({
              container: 'body'
            })

          }, 100);




          /*if (data.status == 1) {




					} else {

					  $mdDialog.show(
					    $mdDialog.alert()
					    .parent(angular.element(document.querySelector('#loggin')))
					    .clickOutsideToClose(false)
					    .title('PSN')
					    .textContent(data.msg)
					    .ariaLabel('Alert Dialog Demo')
					    .ok('cancel!')

					  );


					}*/

        }).error(
        function(data, status, header, config) {
          //console.log(data);

          // to prevent interaction outside of dialog

          // $mdDialog.show(
          //   $mdDialog.alert()
          //   .parent(angular.element(document.querySelector('#loggin')))
          //   .clickOutsideToClose(false)
          //   .title('PSN')
          //   .textContent('OOPS. Server error.')
          //   .ariaLabel('Alert Dialog Demo')
          //   .ok('cancel!')

          // );

        });


  });

  $rootScope.got_to_home = function() {

    window.location.href = "http://uiplonline.com/psn/master/#/";
    setTimeout(function() {
      location.reload();

    }, 100);

  }

  $rootScope.showupdate = function() {

    // $scope.project = [];
    // $rootScope.edit = false;
    $rootScope.edit = false;
    if ($(window).width() < 768) {
    setTimeout(function() {


      $('.resp-tabs-container h2:nth-child(5)').trigger('click');
    }, 500);

    } else {
      setTimeout(function() {

      $('.resp-tabs-list > li:nth-child(3)').trigger('click');

    }, 500);
   

    }
   

  }


$rootScope.togle = function(val){

if(val == 1){

$scope.hh = true;
}
else{

$scope.hh = false;
}


}

  $rootScope.logout = function() {

    var token = localStorage.getItem("access_token");
    //  sessionStorage.clear();
    //  location.reload();
    // token = localStorage.getItem("access_token");

    setTimeout(function() {

        var config = {
          headers: {
            'access-token': token
          }
        }


        $http.get(configService.getEnvConfig().apiURL + "logout", config)
          .success(
            function(data, status, headers, config) {
              console.log(data);
              if (data.status == 1) {
                setTimeout(function() {
                  // if($location.path == '/'){

                  //   location.reload();
                  // }
                  sessionStorage.clear();
                  localStorage.setItem("selected_membership_id","");
                   localStorage.setItem("current_membership_id","");
                   localStorage.setItem("login_count_storage","")
                  

                  $location.path("/");

                }, 200);




                setTimeout(function() {
                  // $location.path("/");
                  location.reload();
                }, 500);



              }
            }).error(
            function(data, status, header, config) {
              console.log(data);


              // $mdDialog.show(
              //   $mdDialog.alert()
              //   .parent(angular.element(document.querySelector('#page')))
              //   .clickOutsideToClose(false)
              //   .title('PSN')
              //   .textContent('OOPS. Server error.')
              //   .ariaLabel('Alert Dialog Demo')
              //   .ok('cancel!')

              // );

            });






      }

      , 100);



  }

  $rootScope.menu_array = [{
      name: 'My Account',

      url: '#/patient',

      selected: false,

      id: 0

    }, {
      name: 'My profile',

      url: '#/myprofile',

      selected: false,

      id: 1

    }, {
      name: 'Memberships',

      url: '#/memberships',

      selected: false,

      id: 2

    }, {
      name: 'Payment',

      url: '#/packagelist',

      selected: false,

      id: 3

      // }, {
      //   name: 'Testimonial',

      //   url: '#/testimonial',

      //   selected: false,

      //   id: 3

      // },

      // // {
      // //   name: 'About',

      // //   url: '#/about',

      // //   selected: false,

      // //   id: 3

      // // },

      // {
      //   name: 'FAQ',

      //   url: '#/faq',

      //   selected: false,

      //   id: 3

      // },

    }




  ];

  $rootScope.chooseselect = function(index) {
    if (index == '/') {
      return false;
    }
    if (typeof index == 'string') {
      for (var i = 0; i < $rootScope.menu_array.length; i++) {
        if ($rootScope.menu_array[i].url.indexOf(index) >= 0) {
          $rootScope.menu_array[i].selected = true;
        } else {
          $rootScope.menu_array[i].selected = false;
        }
      }
    } else {
      for (var i = 0; i < $rootScope.menu_array.length; i++) {
        $rootScope.menu_array[i].selected = false;
      }
      $rootScope.menu_array[index].selected = true;
    }

  };
  $rootScope.chooseselect($location.path());
  $rootScope.getselected = function() {
    var selected = false;
    var path = $location.path();
    if (path == '/') {

      path = 'home';


    } else {

      path = path;
      angular.forEach($rootScope.menu_array, function(item) {

        if (item.selected) {

          selected = item.name;

        }

      });

    }




    if (selected == false) {
      selected = path.replace('/', '');
      console.log("PATH: " + selected);
    }
    return selected;

  };

  $rootScope.getpackages();
   $rootScope.is_angular_loaded=1;

});