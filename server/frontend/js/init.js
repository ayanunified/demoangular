// page init
jQuery(function(){
	ImageFitCont();

});

// Image Fit Container
function ImageFitCont() {
	$('.imageFit').imgLiquid({
		fill: true,
        horizontalAlign: 'center',
        verticalAlign: 'center'
	});
}


$(window).load(function() {
  $('#carousel').flexslider({
	  
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 135,
    itemMargin: 0,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
});
$(document).on('click','#forgot-password',function(){
   $('#modalLogin').modal('hide');
   $('#modal-forgot-password').modal('show');
  });
$(document).on('click','#login',function(){
   $('#login_redirect').val('');
   $('#modalRegister').modal('hide');
   $('#modal-forgot-password').modal('hide');
   $('#modalLogin').modal('show');
  });
$(document).on('click','#sign_up',function(){
	//alert(1);
	$('#login_redirect').val('');
   $('#modalLogin').modal('hide');
   $('#modalRegister').modal('show');
  });
$(document).on('click','#login_party',function(){
   //$('#login_redirect').val('');
   $('#modalRegister').modal('hide');
   $('#modal-forgot-password').modal('hide');
   $('#modalLogin').modal('show');
  });
$(document).on('click','#sign_up_party',function(){
	//alert(1);
	//$('#login_redirect').val('');
   $('#modalLogin').modal('hide');
   $('#modalRegister').modal('show');
  });
$('#modalRegister').on('shown.bs.modal', function () {
    //alert(); 
    if($('body').hasClass('modal-open')){}
	else
		$('body').addClass('modal-open');
  });
$('#modalLogin').on('shown.bs.modal', function () {
    //alert(); 
    if($('body').hasClass('modal-open')){}
	else
		$('body').addClass('modal-open');
  });
$('#modal-forgot-password').on('shown.bs.modal', function () {
    //alert(); 
    if($('body').hasClass('modal-open')){}
	else
		$('body').addClass('modal-open');
  });
$('#modal-success-register').on('hidden.bs.modal', function () {
	if ($('#login_redirect').val()) {
		location.href=$('#login_redirect').val();
	}else{
		location.href="dashboard";
	}
})
$('#redirect_button').on('click', function () {
	if ($('#login_redirect').val()) {
		location.href=$('#login_redirect').val();
	}else{
		location.href="dashboard";
	}
})
$(document).on('click','#set_a_party',function(){
	$('#login_redirect').val('set-party');
   $('#modalRegister').modal('hide');
   $('#modal-forgot-password').modal('hide');
   $('#modalLogin').modal('show');
  });
$(document).on('click','#search',function(){
	$('#login_redirect').val('search');
   $('#modalRegister').modal('hide');
   $('#modal-forgot-password').modal('hide');
   $('#modalLogin').modal('show');
  });
$("#login-form").validate({
   rules: {
	email: {
	required: true,
	email: true
	},
	password: "required",
   
   },
   submitHandler: function(form) {
      $("#loader_login").show();
	  $("#login_error_msg").html('');
      $.ajax({ 
               url: URL+"/site/login",
               cache: false,
               type: "POST",
               data: $("#login-form").serialize(),   
               success: function(success){
				if (success==1) {
				$('#modalLogin').hide();	
                 if ($('#login_redirect').val()) {
					location.href=$('#login_redirect').val();
				}else{
					location.href="dashboard";
				}
//				 form.submit();
                }else{
					$("#login_error_msg").html('<div class="display-error" >Invalid username or password</div>');
				}
                  $("#loader_login").hide();
               }
            });
   }
   }); 


$("#registration-form").validate({
   errorElement: "div",
   rules: {
   first_name: "required",
   last_name: "required",   
   email: {
   required: true,
   email: true
   },
   password1: {
      required: true,
      minlength: 6
   },
   con_password: {
      required: true,
      equalTo: "#password1",
      minlength: 6
   },
   terms_conditions:{
      required: true,
   }
   },
   submitHandler: function(form) {
      $("#loader_register").show();
	  $("#registration_error_msg").html('');
      $.ajax({ 
               url: URL+"/site/register",
               cache: false,
               type: "POST",
               data: $("#registration-form").serialize(),   
               success: function(success){
				if (success==1) {
                   //$("#registration_success_msg").html('<div class="success-notification">Welcome to Prazam.You have successfully register with us.</div>');
					form.reset();
					$('#modalRegister').modal('hide');
					$('#modal-success-register').modal('show');
				}else if (success==2) {
                    $("#registration_error_msg").html('<div class="display-error" >Email id already exists.</div>');
                }else{
					$("#registration_error_msg").html('<div class="display-error" >Some error occured.</div>');
				}
				//console.log(success);
                  //var obj = JSON.parse(success);
                  //if (obj.status==1) {
                  //   $("#registration_success_msg").html('<p class="success-notification">An account activation link has been sent to your registered email address. In the mean time you can proceed with the review</p>');
                  //    $('#myModal').modal('hide');
                  //    $('#myModal2').modal('hide');
                  //    $('#myModal3').modal('show');
                  //    $("#registration_error_msg").html('');
                  //    $("input#user_id").val(obj.user_id);
                  //}else{
                  //   $("#registration_error_msg").html('<div class="display-error" >'+obj.msg+'</div>');
                  //   $("#registration_success_msg").html('');
                  //}
                  $("#loader_register").hide();
               }
            });
   }
   });
$("#forgot-form").validate({
   rules: {
   f_email: {
   required: true,
   email: true
   },
   },
   submitHandler: function(form) {
      $("#loader_forgot").show();
	  $("#forgot_error_msg").html('');
      $.ajax({ 
               url: URL+"/site/forgotpassword",
               cache: false,
               type: "POST",
               data: $("#forgot-form").serialize(),   
               success: function(success){
				//console.log(success);
				if (success==1) {
                 $("#forgot_error_msg").html('<div class="success-notification">A password reset link has been sent to your registered email address.</div>');
                 form.reset();
				}else{
					$("#forgot_error_msg").html('<div class="display-error" >Please enter a valid email address.</div>');
				}
                  $("#loader_forgot").hide();
               }
            });
   }
   });
  $("#resetpassword-form").validate({
   rules: {
    update_password: {
      required: true,
      minlength: 6
   },
   update_con_password: {
      required: true,
      equalTo: "#update_password",
      minlength: 6
   },
   }
});
  
//=search form submit=========//
$("#search-form").validate({
   rules: {
	unique_code: {
	required: true,
	//email: true
	}
   },
   submitHandler: function(form) {
	  //location.href="party/"+$('#unique_code').val();
	  $("#loader_uniquecode").show();
	  $("#unicode_error_msg").html('')
	  $.ajax({ 
               url: URL+"/check-unique-code",
               cache: false,
               type: "POST",
               data: $("#search-form").serialize(),   
               success: function(success){
				//console.log(success);
				if (success==1) {
					location.href="party/"+$('#unique_code').val();
                
				}else{
					 $("#unicode_error_msg").html('<div class="display-error" >Invalid unique code.</div>');
				}
                  $("#loader_uniquecode").hide();
               }
            });
   }
   });

//=======validate step 1 form set a party=======//
//=search form submit=========//
$("#party-setup-form1").validate({
   rules: {
	birthday_first_name: {
		required: true,
	},
	birthday_last_name: {
		required: true,
	},
	party_date: {
		required: true,
	},
	post_code: {
		required: true,
	},
	contribution_amount: {
		 require_from_group: [1, '.amount'],
		 number: true
	},
	contribution_amount_manual: {
		 require_from_group: [1, '.amount'],
		 number: true
	},
	},
//	groups: {
//            amounts: 'contribution_amount contribution_amount_manual'
//        },
   submitHandler: function(form) {
	stepSecond();
   }
   });
$("#party-setup-form2").validate({
	errorElement: "div",
   rules: {
	account_name: {
		required: true,
	},
	bsb: {
		required: true,
	},
	account_number: {
		required: true,
	},
	agree: {
		required: true,
	}
	},
   submitHandler: function(form) {
	//alert(IDGenerate());
	var unique_code=IDGenerate();
	$("#unique_code_url").val($("#party_url").val()+'/'+unique_code);
	$("#unique_code").val(unique_code);
	$("#party_date_template").val($("#party_date").val());
	stepThird();
	//alert($('#template li.active').html());
	var unique_code_url=$("#unique_code_url").val();
	$(".link_template").html("<a href='javascript:void(0)'>"+unique_code_url+"</a>");
	$(".link_download").html("<a href='"+unique_code_url+"'>"+unique_code_url+"</a>");
	$(".unicode").html(unique_code);
	var party_date_split= $("#party_date_template").val().split("-");;
	//alert(party_date_template);
	var party_date_template = $.datepicker.formatDate("M d, yy", new Date(party_date_split[2]+'-'+party_date_split[1]+'-'+party_date_split[0]));
	$('.party_date_template_preview').html(party_date_template);
	if ($('#rsvp_date').val()) {
	var rsvp_date_split= $('#rsvp_date').val().split("-");;
	//alert(party_date_template);
	var rsvp_date_template = $.datepicker.formatDate("M d, yy", new Date(rsvp_date_split[2]+'-'+rsvp_date_split[1]+'-'+rsvp_date_split[0]));
		$('.rsvp_date_template_preview').html(rsvp_date_template);
	}else{
		$('.rsvp_date_template_preview').html('');	
	}
     $('#template_id').val($('#template li.active a').attr('template_id'));
	 $('#template li.active a').trigger('click');
   }
   });
$("#party-setup-form3").validate({
   rules: {
	invite_headline: {
		required: true,
	},
	description: {
		required: true,
	},
	party_time: {
		required: true,
	},
	party_location: {
		required: true,
	},
	additional_party_info: {
		required: true,
	},
	rsvp_date: {
		required: true,
	}
	},
   submitHandler: function(form) {
	 $("#loader_party_create").show();
	  $("#party_create_error_msg").html('');
	   //$('#next-fourth').attr('disabled','disabled');
	   var fd = new FormData($("form")[0]);
		//var file_data = object.get(0).files[i];
		var other_data = $("#party-setup-form2,#party-setup-form3").serializeArray() //page_id=&category_id=15&method=upload&required%5Bcategory_id%5D=Category+ID

		//var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
        fd.append(input.name,input.value);
		});
	  $.ajax({ 
               url: URL+"/store-party",
               cache: false,
               type: "POST",
               //data:  new FormData($('#party-setup-form1')[0]),
			   
					data:fd,
			 headers: {
			 'X-CSRF-Token': $('form#party-setup-form1 [name="_token"]').val()
				},
			   processData: false,
			    contentType: false,
               success: function(success){
                $obj=JSON.parse(success);
				//console.log(success);
				if ($obj.success==1) {
                    $('#party_id').val($obj.party_id);
					$("#print_button").show();
					$('#party-setup-form1')[0].reset();
					$('#party-setup-form2')[0].reset();
					$('#party-setup-form3')[0].reset();
					stepFourth();
                
				}else{
					//$('#next-fourth').removeAttr('disabled');
					 $("#party_create_error_msg").html('<div class="display-error" >Some error occurred.</div>');
				}
                  $("#loader_party_create").hide();
               }
        });
	
   }
   });
$("#next-first").click(function(){
    $("#party-setup-form1").submit();
 });
$("#next-second").click(function(){
   $("#party-setup-form2").submit();
     
 });
$("#next-third").click(function(){
	var fd1 = new FormData($("form#party-setup-form1")[0]);
	var other_data1 = $("#party-setup-form2").serializeArray() //page_id=&category_id=15&method=upload&required%5Bcategory_id%5D=Category+ID

		//var other_data = $('form').serializeArray();
		$.each(other_data1,function(key,input){
			fd1.append(input.name,input.value);
		});
	$.ajax({ 
               url: URL+"/store-party",
               cache: false,
               type: "POST",
               data:  fd1,
			   processData: false,
			    contentType: false,
               success: function(success){
                $obj=JSON.parse(success);
				//console.log($obj);
				if ($obj.success==1) {
					$("#print_button").hide();
					$('#party-setup-form1')[0].reset();
					$('#party-setup-form2')[0].reset();
					$('#party-setup-form3')[0].reset();
					stepFourth();
				            
				}else{
					//$('#next-fourth').removeAttr('disabled');
					 $("#party_create_error_msg").html('<div class="display-error" >Some error occurred.</div>');
				}
                  $("#loader_party_create").hide();
               }
        });
 });
$("#next-fourth").click(function(){
    $("#party-setup-form3").submit();
     
 });


 function IDGenerate() {
        var text = "";
        var hdntxt = "";
        var captchatext = "";
        var possible = "ABCDEFGHIkLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 7; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));         
        }
        return text;
    }
$(document).ready(function(){
  $('#rsvp_date').on('change', function () {
	if ($('#rsvp_date').val()) {
	var rsvp_date_split= $('#rsvp_date').val().split("-");;
	//alert(party_date_template);
	var rsvp_date_template = $.datepicker.formatDate("M d, yy", new Date(rsvp_date_split[2]+'-'+rsvp_date_split[1]+'-'+rsvp_date_split[0]));
	$('.rsvp_date_template_preview').html(rsvp_date_template);
	}
	}) 
});	
var party_setup = angular.module('party_setup', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
(function($){
	$.fn.textareaCounter = function(options) {
		// setting the defaults
		// $("textarea").textareaCounter({ limit: 100 });
		//alert(options);
		var defaults = {
			limit: options
		};	
		var options = $.extend(defaults, options);
 
		// and the plugin begins
		var i=0;
		return this.each(function() {
			var obj, text, wordcount, limited;
			
			obj = $(this);
			//alert();
			obj.after('<p id="counter-text'+obj.attr("id")+'">Maximum word limit. '+options.limit+'</p>');

			obj.keyup(function() {
			    text = obj.val();
			    if(text === "") {
			    	wordcount = 0;
			    } else {
				    wordcount = $.trim(text).split(/[ ,?!.]+/).length;
				}
			    if(wordcount > options.limit) {
			        $("#counter-text").html('0 words left');
					limited = $.trim(text).split(" ", options.limit);
					limited = limited.join(" ");
					$(this).val(limited);
			    } else {
			        $("#counter-text"+obj.attr("id")).html((options.limit - wordcount)+' words left');
			    } 
			});
			i++
		});
	};
})(jQuery);
//=search form submit=========//
$("#search-form-by-name").validate({
   rules: {
	birthday_first_name: {
		 require_from_group: [1, '.searchresult'],
		// number: true
	},
	birthday_last_name: {
		 require_from_group: [1, '.searchresult'],
		// number: true
	},
	post_code: {
		 require_from_group: [1, '.searchresult'],
		 //number: true
	},
	party_date: {
		 require_from_group: [1, '.searchresult'],
		 //number: true
	},
	},
//	groups: {
//            searchresults: 'birthday_first_name birthday_last_name postal_code party_date'
//        },
   submitHandler: function(form) {
	form.submit();
	  //location.href="party/"+$('#unique_code').val();
	  //$("#loader_dashboard_search").show();
	  //$("#unicode_error_msg").html('')
//	  $.ajax({ 
//               url: "search-result",
//               cache: false,
//               type: "POST",
//               data: $("#search-form").serialize(),   
//               success: function(success){
//				//console.log(success);
//				if (success==1) {
//					location.href="party/"+$('#unique_code').val();
//                
//				}else{
//					 $("#unicode_error_msg").html('<div class="display-error" >Invalid unique code.</div>');
//				}
//                  $("#loader_dashboard_search").hide();
//               }
//            });
   }
   });
