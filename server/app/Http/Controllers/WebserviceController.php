<?php

namespace App\Http\Controllers;

require 'vendor/authorize/vendor/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Authorizenet;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use DB;
use Mail;
use Illuminate\Routing\UrlGenerator;
use url;
use Cookie;
use Intervention\Image\Facades\Image;
use Validator;
use App\Role;
use App\User;
use App\Customers;
use App\AccessTokens;
use App\BankBrafts;
use App\BehaviorLists;
use App\Businesses;
use App\Contactuspage;
use App\CreditCards;
use App\CreditCardTypes;
use App\FaqManagement;
use App\LoginLogs;
use App\Memberships;
use App\PatientReports;
use App\Patients;
use App\PatientsLooks;
use App\PaymentTypes;
use App\SiteSettings;
use App\SliderImages;
use App\Stories;
use App\AboutUs;
use App\ResetRequest;
use App\ReportBehaviour;
use App\PaymentReport;
use App\Testimonials;
use App\Reportpatients;
use App\Packageimages;
use App\Dashboardimages;
use App\Emailverificationtokens;

class WebserviceController extends Controller{
	
	public function index(Request $request )
	{
		echo $input = $request->get('role_id');
		$input = $request->all();
		print_r($input);
		die;
		//$input['role_id'] = 2 ;
		//$input['password'] = '123456789';
		$input['password'] = Hash::make($input['password']);
		//$input['first_name'] = 'jit'; 
		//$input['last_name'] = 'dhar';
        $input['name']=$input['first_name'].' '.$input['last_name'];
        //$input['email'] = 'jit123@gmail.com';
        //$input['status'] = 1;
       // $user = User::create($input);
	}

	public function convertDate($date)
	{
		$dateArray = explode('-',$date);
		$finalDate = $dateArray[2].'-'.$dateArray[0].'-'.$dateArray[1];
		return $finalDate;
	}
	public function postMakepayment(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		

		 $senddata = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id);	
			$memberships = Memberships::where('id',$input['membership_id'])->get()->toArray();
			

			$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();


			////////////////////     ---->SANDBOX

			//$merchantAuthentication->setName("8NjZ3Na9y9");
			//$merchantAuthentication->setTransactionKey("28W7kzLf657MmS2Q");

			////////////////////     ---->LIVE

			$merchantAuthentication->setName("85dZf6PCPx");
			$merchantAuthentication->setTransactionKey("5xFdg4c39FY225pu");

			// Create the payment data for a credit card
			$creditCard = new AnetAPI\CreditCardType();
			$creditCard->setCardNumber($input['card_no']);
			$creditCard->setExpirationDate($input['expiry_month'].$input['expiry_year']);
			$creditCard->setCardCode($input['card_code']);
			$paymentOne = new AnetAPI\PaymentType();
			$paymentOne->setCreditCard($creditCard);

			// Create a transaction
			$transactionRequestType = new AnetAPI\TransactionRequestType();
			$transactionRequestType->setTransactionType("authCaptureTransaction"); 
			$transactionRequestType->setAmount($memberships[0]['price']);
			$transactionRequestType->setPayment($paymentOne);

			$request = new AnetAPI\CreateTransactionRequest();
			$request->setMerchantAuthentication($merchantAuthentication);
			$request->setTransactionRequest( $transactionRequestType);
			$controller = new AnetController\CreateTransactionController($request);
			$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		

			if ($response != NULL)
			{
			    $tresponse = $response->getTransactionResponse();
			    
			    	
			    
			    if (($tresponse != NULL) && ($tresponse->getResponseCode()== 1) && ($tresponse->getTransId()!='') )   
			    {
			    	$cardData = array('card_number'=>$input['card_no'],
			    				  'expire_month'=>$input['expiry_month'],
			    				  'expire_year'=>$input['expiry_year'],
			    				  'customers_id'=>$customer_id);
			    	$creditCardDetails = CreditCards::where('card_number',$input['card_no'])->where('customers_id',$customer_id)->get()->toArray();
			    	if(count($creditCardDetails)==0)
				    {
				    	CreditCards::create($cardData);
				    }
				    else
				    {
				    	$creditCardDetail = CreditCards::find($creditCardDetails[0]['id']);
				    	$creditCardDetail->update($cardData);
				    }
			    	$present_expiry_date=$customer['expiry_date']; /////// present pacakge expiry date

			    	$today_s_date=date('Y-m-d');

			    	if($present_expiry_date<$today_s_date)
			    	{
						$new_expiry_date=date('Y-m-d', strtotime($today_s_date." + ".$memberships[0]['duration']." months"));
			    	}
			    	else 
			    	{
			    		$new_expiry_date=date('Y-m-d', strtotime($present_expiry_date." + ".$memberships[0]['duration']." months"));
			    	}

			    	

			        $paymentData = array('customers_id'=>$customer_id,
			        					 'transaction_id'=>$tresponse->getTransId(),
			        					 'amount_paid'=>$memberships[0]['price'],
			        					 'pack_taken'=>$input['membership_id'],
			        					 'valid_till'=>$new_expiry_date
			        					 );
			        PaymentReport::create($paymentData);

			        $storedata['status'] = 'Active';
					$storedata['memberships_id'] = $input['membership_id'];
					$storedata['expiry_date'] = $new_expiry_date;
					$customer->update($storedata);
					$data['status'] = 1;
					$data['msg'] = 'Payment Successfull. Thank You For Subscription.';
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
			        //echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
			       // echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
			    }
			    else
			    {
			        $data['status'] = 0;
					$data['msg'] = 'Wrong CreditCard Information Or Insufficient Balance.';
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
					//$data['resp_code']=$tresponse->getResponseCode();
			        //echo  "Charge Credit Card ERROR :  Invalid response\n";
			    }
			}
			else
			{
			    $data['status'] = 0;
				$data['msg'] = 'Wrong CreditCard Information.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			    //echo  "Charge Credit card Null response returned";
			}
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);	
	}
	
	public function getCardlist(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$customer_id = $tokenStatus['customer_id'];
		$customer = Customers::find($customer_id)->toArray();

		$credit_cards= CreditCards::where('customers_id',$customer_id)->orderBy('created_at','desc')->get()->toArray();

		if(count($credit_cards)>0)
		{
			$data['status'] = 1;
			$data['msg'] = 'You have used total '.count($credit_cards)." credit cards";
			$data['data'] = $credit_cards;
			$data['access_token'] = $tokenStatus['access_token'];
			$data['current_status'] = $tokenStatus['current_status'];
		}
		else
		{
			$payment_reports=array();
			$data['status'] = 1;
			$data['msg'] = 'You have not added any credit cards yet.';
			$data['data'] = $credit_cards;
			$data['access_token'] = $tokenStatus['access_token'];
			$data['current_status'] = $tokenStatus['current_status'];
		}
		echo json_encode($data);	
	}


	public function getTransactions(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$finalsendData = array();
		$senddata = array();
		$data=array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id)->toArray();
			$payment_reports=PaymentReport::where('customers_id',$customer_id)->with('memberships')->orderBy('created_at','desc')->get()->toArray();
			
			if(count($payment_reports)>0)
			{
				$data['status'] = 1;
				$data['msg'] = 'You have made total '.count($payment_reports)." transactions";
				$data['data'] = $payment_reports;
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
			else
			{
				$payment_reports=array();
				$data['status'] = 1;
				$data['msg'] = 'You have not made any transactions yet.';
				$data['data'] = $payment_reports;
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
			$data['data'] = array();
		}
		echo json_encode($data);	
	}





	public function postEmailcheck(Request $request )
	{
		$input = $request->get('emailId');
		$checktype = $request->get('checktype');
		$emailCount = Customers::where($checktype,$input)->count();
		
		
		if($emailCount==0)
		{
			$data['status'] = 1;
			$data['msg'] = ucfirst($checktype).' Can Be Used.';
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = ucfirst($checktype).' is already in use';
		}
		echo json_encode($data);
	}

	public function postSignup(Request $request)
	{

		$membership_details=Memberships::where('id',1)->get()->toArray();  ////// default membership id = 1 

		$months=$membership_details[0]['duration']; ////// memebership valid for months

		$days=$months*30;  ////// memebership valid for days assuming 1 month = 30 days


		$input = $request->all();
		$input['emailValidateToken'] = rand(00,99).time();
		$input['password'] = Hash::make($input['password']);
		$input['status'] = 'Block';

		$input['memberships_id'] = 1; ////// default membership id = 1



		$input['expiry_date'] = date('Y-m-d', strtotime("+".$days." days")); //// calculating expiry date as per membership id


		$input['legalName'] = $input['first_name'].' '.$input['last_name'];
		


		$customer = Customers::insertGetId($input);
		$emailverificationtoken=Emailverificationtokens::insertGetId(array('token'=>$input['emailValidateToken'],'status'=>0));
		$cmd = "wget -bq --spider ".url('/')."/webservice/sendmail/".urlencode($input['email']).'/'.urlencode($input['legalName']).'/'.urlencode($input['emailValidateToken']);
		//$cmd = "wget -bq --spider ".url('/')."/webservice/sendmail/aa/aa/aa";
       // echo url('/');exit; 
        shell_exec(escapeshellcmd($cmd));
		
        if($customer!="")
		{
			$data['status'] = 1;
			$data['msg'] = 'Your PSN account has be created! You can login now.';
			
		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = 'Registration Failed.';
		}
		echo json_encode($data);
	}	

	//////////////////////////////////////////////////////////////////////////////////////////////////

	/////// author : Ayan Sil
	//////  Dated : 2016 - 08 - 09
	/////   Purpose : get current membership for a customer 
	////    Function Type : Service

   ////////////////////////////////////////////////////////////////////////////////////////////////////


	public function postGetmembership(Request $request)
	{
		$headers = $request->header();

		$estat=0;

		if(!isset($headers['access-token']))
		{
				$data['status'] = 0;
				$data['msg'] = 'No Access Token Sent';
				$estat=1;
				
		}
		if($estat==0)
		{
			$access_token = $headers['access-token'][0];
			$tokenStatus = $this->checktoken($access_token);
			$status = $tokenStatus['status'];
			$input = $request->all();
			if($status == 1)
			{

				$customer_id = $tokenStatus['customer_id'];
				
				try
				{
					$customer = Customers::find($customer_id);
					$customerDetail = $customer->toArray();
				}
				catch(exception $e)
				{
					$data['status'] = 0;
					$data['msg'] = $e->getMessage();
					$estat=1;
					
				}
				
				if($estat==0)
				{
					$current_membership_details = Memberships::where('id',$customerDetail['memberships_id'])->get()->toArray();

					$duration_of_current_membership = $current_membership_details[0]['duration']; 

					$data['status'] = 1;
					$data['msg'] = 'Memebership successfully fetched';

					$data['current_membership_id']=$customerDetail['memberships_id'];
					$data['current_status'] = $customerDetail['status'];	
				}
				
				

				
			}
			else if($status == 0)
			{
				$data['status'] = 0;
				$data['msg'] = 'Invalid Token.';
			}
		}
		
		echo json_encode($data);
		
	}



	public function getSendmail(Request $request,$email,$name,$validateToken)
	{
		$email=urldecode($email);
		$name=urldecode($name);
		$validateToken=urldecode($validateToken);

		// $f=fopen('./a.txt','a+');
		// fwrite($f,"ggwp\n");

		$usermail = array('email'=>$email,'name'=>$name,'validateToken'=>$validateToken);
		Mail::send('emails.register', $usermail, function ($m) use ($usermail) {
        $m->from('ayan@unifiedinfotech.net', 'PSN');

        $m->to($usermail['email'], $usermail['name'])->subject('Registration Successfull.');
        });
	}
//////////////////////////////////////////////////////////////////////////////////////////////////

	/////// author : Satyajit and Ayan 
	//////  Dated : 2016 - 08 - 17
	/////   Purpose : send mail purpose 
	////    Function Type : Service

	public function getCheckexpiry(Request $request){

		$todays_date=date('Y-m-d');
		$new_expiry_date_plus_seven=date('Y-m-d', strtotime($today_s_date." + 7"));
		$new_expiry_date_plus_three=date('Y-m-d', strtotime($today_s_date." + 3"));
		
		$data = array($todays_date,$new_expiry_date_plus_three,$new_expiry_date_plus_seven);

		$customers = Customers::whereIn('expiry_date', $data)->toArray();

		foreach($customers as $cust_key){
			if($cust_key->expiry_date == $todays_date){
				/*todays mail*/
				$subject = "your subscription expires today.";
			} else if($cust_key->expiry_date ==$new_expiry_date_plus_three ) {
				/*after 3 days*/
				$subject = "your subscription expires in 3 days.";
			} else {
				/*after 7 days*/
				$subject = "your subscription expires in 7 days.";
			}
			/*send email function*/

			$usermail = array('email'=>$cust_key->email,'name'=>$cust_key->name);
			Mail::send('emails.subscription', $usermail, function ($m) use ($usermail) {
	        	$m->from('ayan@unifiedinfotech.net', 'PSN');
	        	$m->to($usermail['email'], $usermail['name'])->subject($subject);
        	});
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////


	public function getValidateemail(Request $request,$validate_token)
	{
		
			$validatedata = Customers::where('emailValidateToken',$validate_token)->get()->toArray();
			if(count($validatedata)==1)
			{
				$cnt=Emailverificationtokens::where('token',$validate_token)->where('status','0')->count();
				if($cnt)
				{
					$userId = $validatedata[0]['id'];
					$userdata = Customers::findOrFail($userId);
					$updateArray = array('status'=>'Active');
					$userdata->update($updateArray);
					$data['status'] = 1; 
					echo $data['msg'] = 'Email Verification Done.';
					Emailverificationtokens::where('token',$validate_token)->update(['status' => 1]);
					return redirect('http://uiplonline.com/psn/master/#/?email=verified');
				}
				else
				{
					$data['status'] = 0;
					echo $data['msg'] = 'Email verification already used';
				}
			}
			else
			{
				$data['status'] = 0;
				echo $data['msg'] = 'Token Missmatch.';
			}
		
			
		

	}
	public function postSignin(Request $request)
	{
		$input = $request->all();
		$email = $input['email'];
		$passwordMatch = 0;
		$access_token = "";
		$customerDetails = Customers::orWhere('email',$email)->orWhere('username',$email)->get();
		$customerDetail = $customerDetails->toArray();
		if(count($customerDetail)==1)
		{	
			$password = $customerDetail[0]['password'];
			if(Hash::check($input['password'],$password))
			{
				$passwordMatch = 1;
			}	
			if(count($customerDetail) == 1 && $passwordMatch == 1 ) 
			{
				if($customerDetail[0]['status']!='Block')
				{
					$customer_id = $customerDetail[0]['id'];
					$access_token = rand(1000,9999).time();
					$insertdata = array('customers_id'=>$customer_id,
								'generate_time'=>date('Y-m-d H:i:s'),
								'access_token'=>$access_token);
					$tokenid = AccessTokens::insertGetId($insertdata);
					if($tokenid!="")
					{
						LoginLogs::create(array('login_time'=>date('Y-m-d H:i:s'),'customers_id'=>$customer_id));
						$data['status'] = 1;
						$data['msg'] = 'Login Successfull.';
						$data['access_token'] = $access_token;
						$data['current_status'] = $customerDetail[0]['status'];		
					}
				}
				else
				{
					
						$data['status'] = 0;
						$data['msg'] = 'Please verify your email id';
						$data['access_token'] = $access_token;
						$data['current_status'] = '';
				}
				
			}
			else
			{
				$data['status'] = 0;
				$data['msg'] = 'Incorrect User ID or Password';
				$data['access_token'] = $access_token;
				$data['current_status'] = '';
			}
		}
		else{
			$data['status'] = 0;
			$data['msg'] = 'Incorrect User ID or Password';
			$data['access_token'] = $access_token;
			$data['current_status'] = '';
		}		
		echo json_encode($data);
		//$headers = $request->header();
		//$access_token = $headers['access-token'][0];
		//$tokenStatus = $this->checktoken($access_token);
		//echo $tokenStatus['status'];
	}
	public function getLogout(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		if($status == 1)
		{
			$patient_ids = 0;
			$customer_id = $tokenStatus['customer_id'];
			$logs = LoginLogs::where('customers_id',$customer_id)->orderBy('created_at','desc')->get()->toArray();
			$loginlogs = LoginLogs::find($logs[0]['id']);
			
			$loginlogs->update(array('logout_time'=>date('Y-m-d H:i:s')));
			$gettoken = AccessTokens::where('access_token',$access_token)->get()->toArray();
			$deletetoken = AccessTokens::find($gettoken[0]['id']);
			$deletetoken->delete();
			$data['status'] = 1;
			$data['msg'] = 'Logout Successfully.';
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);
	}
	public function checktoken($access_token)
	{
		$gettoken = AccessTokens::where('access_token',$access_token)->get()->toArray();
		$status = "";
		if(count($gettoken)==1)
		{
			$customers = Customers::find($gettoken[0]['customers_id']);
			$customersArray = $customers->toArray();
			if($customersArray['expiry_date']<date('Y-m-d') && $customersArray['status']!='Block')
			{
				$storedata['status'] = 'Inactive';
				$customers->update($storedata);
				$status = 'Inactive';
			}
			else
			{
				$status = $customersArray['status'];
			}	
			if($status != 'Block')
			{
				$gettokentime = $gettoken[0]['generate_time'];
				$access_token = 0;
				$expiretime = date('Y-m-d H:i:s', strtotime("+90000000 minutes",strtotime($gettokentime)));
				if(date('Y-m-d H:i:s')>$expiretime)
				{
					$access_token = rand(1000,9999).time();
					$accesstoken = AccessTokens::findOrFail($gettoken[0]['id']);
					$insertdata = array('generate_time'=>date('Y-m-d H:i:s'),
								  		'access_token'=>$access_token);
					$accesstoken->update($insertdata);
				}
				$data['status'] = 1;
				$data['customer_id'] = $gettoken[0]['customers_id'];
				$data['access_token'] = $access_token;
				$data['current_status'] = $status;
			}
			else{
				$data['status'] = 0;
			}	
		}
		else{
			$data['status'] = 0;
		}
		return $data;
	}

	public function getBusinesstypes()
	{
		$senddata= array();
		$finalsenddata= array();
		$businesstypes = Businesses::get()->toArray();
		foreach($businesstypes as $key=>$businesstype)
		{
			$senddata['id'] = $businesstype['id'];
			$senddata['name'] = $businesstype['name'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getBehaviorlists()
	{
		$senddata= array();
		$finalsenddata= array();
		$rawbehaviorlists = BehaviorLists::get()->toArray();
		foreach($rawbehaviorlists as $key=>$rawbehaviorlist)
		{
			$senddata['id'] = $rawbehaviorlist['id'];
			$senddata['label'] = $rawbehaviorlist['type_name'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		
		echo json_encode($data);
	}

	public function getSliders()
	{
		$senddata= array();
		$sliders = SliderImages::get()->toArray();
		$finalsendData = array();
		foreach($sliders as $key=>$slider)
		{
			$senddata['id'] = $slider['id'];
			$senddata['img_title'] = $slider['img_title'];
			$senddata['img_desc'] = $slider['img_desc'];
			$senddata['img_path'] = asset('uploads').'/'.$slider['img_path'];
			array_push($finalsendData,$senddata);
		}
		$customers = Customers::where('status','Active')->get()->toArray();
		$patients = PatientReports::get()->toArray();
		$data['totalCustomer'] = count($customers);
		$data['totalPatients'] = count($patients);
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsendData;
		echo json_encode($data);
	}
	public function getGetpackages()
	{
		$senddata= array();
		$finalsenddata= array();
		$memberships = Memberships::orderBy('price','asc')->get()->toArray();
		foreach($memberships as $key=>$membership)
		{
			$senddata['id'] 			= $membership['id'];
			$senddata['type_name'] 	= $membership['type_name'];
			$senddata['duration'] 	= $membership['duration'];
			$senddata['price'] 		= $membership['price'];
			$senddata['subheading'] 	= $membership['subheading'];
			$senddata['description'] 		= $membership['description'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	} 

	public function getAbout()
	{
		$senddata= array();
		$finalsenddata= array();
		$aboutuses = AboutUs::get()->toArray();
		foreach($aboutuses as $key=>$aboutus)
		{
			$senddata['id'] 				= $aboutus['id'];
			$senddata['about_content'] 		= $aboutus['about_content'];
			$senddata['trust_content'] 		= $aboutus['trust_content'];
			$senddata['respect_content'] 	= $aboutus['respect_content'];
			$senddata['passion_content'] 	= $aboutus['passion_content'];

			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getStories()
	{
		$senddata= array();
		$finalsenddata= array();
		$stories = Stories::get()->toArray();
		foreach($stories as $key=>$story)
		{
			$senddata['id'] 				= $story['id'];
			$senddata['story_content'] 	= $story['story_content'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getAllsettings()
	{
		$siteSettings = SiteSettings::find(1)->toArray();
		$senddata['contact_mail'] = $siteSettings['contact_mail'];
		$senddata['contact_address'] = $siteSettings['contact_address'];
		$senddata['contact_no'] = $siteSettings['contact_no'];
		$senddata['footer_disclaimer'] = $siteSettings['footer_disclaimer'];
		$senddata['email_subscribe_text'] = $siteSettings['email_subscribe'];
		$senddata['get_in_touch_text'] = $siteSettings['get_in_touch'];
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $senddata;
		echo json_encode($data);
	}

	public function getFaqs()
	{
		$senddata= array();
		$finalsenddata= array();
		$faqs = FaqManagement::get()->toArray();
		foreach($faqs as $key=>$faq)
		{
			$senddata['id'] 			= $faq['id'];
			$senddata['question'] 		= $faq['question'];
			$senddata['answer'] 		= $faq['answer'];
			array_push($finalsenddata,$senddata);
		}
		$siteSettings = SiteSettings::find(1)->toArray();
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['heading_text'] = $siteSettings['faq_header'];
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getDashboardbanners()
	{
		$senddata= array();
		$finalsenddata= array();
		$dashboardBanners = Dashboardimages::get()->toArray();
		foreach($dashboardBanners as $key=>$dashboardBanner)
		{
			$senddata['id'] 			= $dashboardBanner['id'];
			$senddata['position'] 		= $dashboardBanner['position'];
			$senddata['img_path'] 		= asset('uploads').'/'.$dashboardBanner['img_path'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getPackagebanners()
	{
		$senddata= array();
		$finalsenddata= array();
		$packageBanners = Packageimages::get()->toArray();
		foreach($packageBanners as $key=>$packageBanner)
		{
			$senddata['id'] 			= $packageBanner['id'];
			$senddata['position'] 		= $packageBanner['position'];
			$senddata['img_path'] 		= asset('uploads').'/'.$packageBanner['image_path'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function getReportbanners()
	{
		$senddata= array();
		$finalsenddata= array();
		$reportBanners = Reportpatients::get()->toArray();
		foreach($reportBanners as $key=>$reportBanner)
		{
			$senddata['id'] 			= $reportBanner['id'];
			$senddata['position'] 		= $reportBanner['position'];
			$senddata['img_path'] 		= asset('uploads').'/'.$reportBanner['image_path'];
			array_push($finalsenddata,$senddata);
		}
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	//Service Provide By The Company
	public function getServices()
	{
		$senddata= array();
		$finalsenddata= array();
		$services = Contactuspage::get()->toArray();
		foreach($services as $key=>$service)
		{
			$senddata['id'] 			= $service['id'];
			$senddata['title'] 			= $service['title'];
			$senddata['content'] 		= $service['content'];
			array_push($finalsenddata,$senddata);
		}
		$siteSettings = SiteSettings::find(1)->toArray();
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['heading_text'] = $siteSettings['service_header'];
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}
	public function getTestimonial()
	{
		$senddata= array();
		$finalsenddata= array();
		$testimonials = Testimonials::get()->toArray();
		foreach($testimonials as $key=>$testimonial)
		{
			$senddata['id'] 			= $testimonial['id'];
			$senddata['user_img'] 		= asset('uploads').'/'.$testimonial['user_img'];
			$senddata['title'] 			= $testimonial['title'];
			$senddata['content'] 		= $testimonial['description'];
			array_push($finalsenddata,$senddata);
		}
		$siteSettings = SiteSettings::find(1)->toArray();
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['heading_text'] = $siteSettings['testimonial_header'];
		$data['data'] = $finalsenddata;
		echo json_encode($data);
	}

	public function postForgetpass(Request $request)
	{
		$email = $request->get('email');
		$validMail = Customers::where('email',$email)->orWhere('username',$email)->get()->toArray();
		
		if(count($validMail)==1)
		{
			$email = $validMail[0]['email'];
			$url=url('/')."/webservice/fpass/".urlencode($email);
			$cmd = "wget -bq --spider ".$url;


				
			shell_exec(escapeshellcmd($cmd));
			$data['status'] = 1;
			$data['msg'] = 'Password Reset Mail Send To Your Email.';
			$data['url']=$url;


		}
		else
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Email.';
		}
		echo json_encode($data);
	}
	public function getFpass(Request $requet,$email)
	{
		$validMail = Customers::where('email',$email)->orWhere('username',$email)->get()->toArray();
		$resetToken = rand(0,99).time();
			$insertdata = array('email'=>$email,
								'token'=>$resetToken);
			$resetdata = ResetRequest::where('email',$email)->get();
			if(count($resetdata)>0)
			{
				$resetid = $resetdata[0]['id'];
				$resetRequest = ResetRequest::find($resetid);
				$resetRequest->delete();
			}	
			$validMail['resetToken']=$resetToken;
			ResetRequest::create($insertdata);
			Mail::send('emails.password', $validMail, function ($m) use ($validMail,$resetToken) {
	        $m->from('ayan@unifiedinfotech.net', 'PSN');

	        $m->to($validMail[0]['email'], $validMail[0]['legalName'])->subject('Forgot Password.');
	        });
	}
	public function getTokenvalidation(Request $request)
	{
		$headers = $request->header();
		$reset_req_token = $headers['reset-token'][0];
		$resetdata = ResetRequest::where('token',$reset_req_token)->get()->toArray();
		if(count($resetdata)==1)
		{
			$data['status'] = 1;
			$data['msg'] = 'Valid Token.';
			$data['emailId'] = $resetdata[0]['email'];
		}
		else{
			$data['status'] = 0;
			$data['msg'] = 'Token Missmatch.';
		}	
		echo json_encode($data);

	}
	public function postResetpassword(Request $request)
	{
		$headers = $request->header();
		$reset_req_token = $headers['reset-token'][0];
		$email = $request->get('email');
		$password = $request->get('password');
		$validMail = Customers::where('email',$email)->get()->toArray();
		$resetdata = ResetRequest::where('token',$reset_req_token)->where('email',$email)->get();
		if(count($resetdata)==1)
		{
			if(count($validMail)==1)
			{
				$resetid = $resetdata[0]['id'];
				$resetRequest = ResetRequest::find($resetid);
				$resetRequest->delete();
				$insertdata = array('password'=>$password);
				$customer = Customers::findOrFail($validMail[0]['id']);
				$customer->update($insertdata);
				$data['status'] = 1;
				$data['msg'] = 'Password Reset Done.';
			}
			else
			{
				$data['status'] = 0;
				$data['msg'] = 'Invalid Email Id.';
			}
		}
		else{
			$data['status'] = 0;
			$data['msg'] = 'Token Missmatch.';
		}	
		echo json_encode($data);
	}

	public function getProfiledata(Request $request)
	{
		$headers = $request->header();
		//print_r($headers);die;
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id);
			$customerDetail = $customer->toArray();
			$data['status'] = 1;
			$data['msg'] = 'Profile Data Found.';	
			$data['access_token'] = $tokenStatus['access_token'];
			$data['current_status'] = $tokenStatus['current_status'];
			$data['data'] = $customerDetail;
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);
		
	}	

	public function postUpdateprofile(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::findOrFail($customer_id);
			$customerDetail = $customer->toArray();
			$password =isset($input['password'])?$input['password']:'';
			$new_password =isset($input['new_password'])?$input['new_password']:'';
			if($password!="" && $new_password!="")
			{
				if(Hash::check($input['password'],$customerDetail['password']))
				{
					$legalname = isset($input['first_name'])?$input['first_name']:''.' '.isset($input['last_name'])?$input['last_name']:'';
					$insertdata['legalName'] = trim($legalname);
					$insertdata['businessName'] = isset($input['businessName'])?$input['businessName']:'';
					$insertdata['businesses_id'] = isset($input['businesses_id'])?$input['businesses_id']:'';
					$insertdata['address'] = isset($input['address'])?$input['address']:'';
					$insertdata['suite'] = isset($input['suite'])?$input['suite']:'';
					$insertdata['city'] = isset($input['city'])?$input['city']:'';
					$insertdata['state'] = isset($input['state'])?$input['state']:'';
					$insertdata['zip'] = isset($input['zip'])?$input['zip']:'';
					$insertdata['country'] = isset($input['country'])?$input['country']:'';
					$insertdata['office_phone'] = isset($input['office_phone'])?$input['office_phone']:'';
					$insertdata['website'] = isset($input['website'])?$input['website']:'';
					$insertdata['noOfDoc'] = isset($input['noOfDoc'])?$input['noOfDoc']:'';
					$insertdata['first_name'] = isset($input['first_name'])?$input['first_name']:'';
					$insertdata['last_name'] = isset($input['last_name'])?$input['last_name']:'';
					$insertdata['cell_phone'] = isset($input['cell_phone'])?$input['cell_phone']:'';
					$insertdata['password'] = $new_password;
					$insertdata['sales_person_id'] = isset($input['sales_person_id'])?$input['sales_person_id']:'';
					$insertdata['refer_chanel'] = isset($input['refer_chanel'])?$input['refer_chanel']:'';
					$customer->update($insertdata);
					$data['status'] = 1;
					$data['msg'] = 'Profile Updated Successfully.';
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
				}
				else{
					$data['status'] = 0;
					$data['msg'] = 'Wrong Old Password.';
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
				}	
			}
			else
			{
				$legalname = isset($input['first_name'])?$input['first_name']:''.' '.isset($input['last_name'])?$input['last_name']:'';
				$insertdata['legalName'] = trim($legalname);
				$insertdata['businessName'] = isset($input['businessName'])?$input['businessName']:'';
				$insertdata['businesses_id'] = isset($input['businesses_id'])?$input['businesses_id']:'';
				$insertdata['address'] = isset($input['address'])?$input['address']:'';
				$insertdata['suite'] = isset($input['suite'])?$input['suite']:'';
				$insertdata['city'] = isset($input['city'])?$input['city']:'';
				$insertdata['state'] = isset($input['state'])?$input['state']:'';
				$insertdata['zip'] = isset($input['zip'])?$input['zip']:'';
				$insertdata['country'] = isset($input['country'])?$input['country']:'';
				$insertdata['office_phone'] = isset($input['office_phone'])?$input['office_phone']:'';
				$insertdata['website'] = isset($input['website'])?$input['website']:'';
				$insertdata['noOfDoc'] = isset($input['noOfDoc'])?$input['noOfDoc']:'';
				$insertdata['first_name'] = isset($input['first_name'])?$input['first_name']:'';
				$insertdata['last_name'] = isset($input['last_name'])?$input['last_name']:'';
				$insertdata['cell_phone'] = isset($input['cell_phone'])?$input['cell_phone']:'';
				$insertdata['sales_person_id'] = isset($input['sales_person_id'])?$input['sales_person_id']:'';
				$insertdata['refer_chanel'] = isset($input['refer_chanel'])?$input['refer_chanel']:'';

				$customer->update($insertdata);
				$data['status'] = 1;
				$data['msg'] = 'Profile Updated Successfully.';	
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);
		
	}
	public function postSearchpatients(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		 
		$senddata = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id)->toArray();
			$ssn = isset($input['ssn'])?$input['ssn']:'';
			$first_name = isset($input['first_name'])?$input['first_name']:'';
			$last_name = isset($input['last_name'])?$input['last_name']:'';
			$dob   = isset($input['dob'])?$this->convertDate($input['dob']):'0000-00-00';
			$gender = isset($input['gender'])?$input['gender']:'';
			$searchReportId = 0;
			$finalsendData = array();
			$ids = 0;
			$id = 0;
			$customerStatus = $customer['status'];
			if(isset($ssn) && $ssn !="")
			{
				$patients = Patients::where('ssn', $ssn)->get()->toArray();
	        }
	        else if($first_name!="" && $last_name!=""){
	        	/*$patients = Patients::where('ssn', $ssn)
	                    		->orWhere('first_name','LIKE', "%".$first_name."%")
	                    		->orWhere('last_name', 'LIKE', "%".$last_name."%")
	                    		->orWhere('dob',  $dob)
	                    		->orWhere('gender', $gender)
	                    		->get()->toArray();*/
	            $patients = Patients::where('first_name',$first_name)
	                    		->where('last_name',$last_name)
	                    		->where('dob',  $dob)
	                    		->where('gender', $gender)
	                    		->get()->toArray();        		
	           
	        }    
	        else if($first_name!="" && $last_name=="")
	        {
	        	$patients = Patients::where('first_name',$first_name)
	                    		->where('dob',  $dob)
	                    		->where('gender', $gender)
	                    		->get()->toArray();    
	        }   
	        else if($last_name!="" && $first_name=="")
	        {
	        	$patients = Patients::where('last_name',$last_name)
	                    		->where('dob',  $dob)
	                    		->where('gender', $gender)
	                    		->get()->toArray();   
	        }  
            if(count($patients)!=0)
	        {            
	        	foreach($patients as $patient)
	            {
	            	$id .= ','.$patient['id'];
	            }
	            $ids = $id;		
	            if($customerStatus == 'Active')
	            {	
	            	$reports = PatientReports::whereIn('patients_id',explode(',',$ids))->with('patients')->with('customers')->get()->toArray();
	            }
	            else if($customerStatus == 'Inactive')
	            {
	            	$reports = PatientReports::whereIn('patients_id',explode(',',$ids))->where('customers_id',$customer['id'])->with('patients')->with('customers')->get()->toArray();	
	            }	
	            $totalAmount = 0;
	            $reportedBy = array();
	            $behaviorReport = 0;
	           
	            foreach($reports as $key=>$patientReport)
				{
					$behaviorShown =array();
					$totalAmount = $totalAmount + $patientReport['balance_amount'];
					
					if(!in_array($patientReport['customers_id'],$reportedBy))
					{
						array_push($reportedBy,$patientReport['customers_id']);
					}
					$senddata['id'] = $patientReport['id'];
					$senddata['my_report'] = $customer_id==$patientReport['customers_id']?'1':'0';
					$senddata['name'] = $patientReport['patients']['first_name'].' '.$patientReport['patients']['last_name'];
					$senddata['ssn'] = $patientReport['patients']['ssn'];
					$senddata['balance_amount'] = $patientReport['balance_amount'];
					$senddata['note'] = $patientReport['note'];
					$senddata['report_reason'] = $patientReport['report_reason'];
					$senddata['service_date'] = date('m-d-Y',strtotime($patientReport['service_date']));
					$behaviors = ReportBehaviour::where('report_id',$patientReport['id'])->with('behaviorlists')->get()->toArray();
					$behaviorShownArray=array();
					foreach($behaviors as $newkey=>$behavior)
					{
						$behaviorShown['id']= $behavior['behaviorlists']['id'];
						$behaviorShown['label']= $behavior['behaviorlists']['type_name'];
						array_push($behaviorShownArray,$behaviorShown);
					}
					if(count($behaviorShownArray)>0)
					{
						++$behaviorReport;
					}
					$senddata['behavior'] = $behaviorShownArray;
					array_push($finalsendData,$senddata);
					$searchReportId .= ','.$patientReport['id'];
				}
				$logs = LoginLogs::where('customers_id',$customer_id)->orderBy('created_at','desc')->get()->toArray();
				$search_ids = $logs[0]['patients_search_id'].ltrim($searchReportId,'0,');
				$loginlogs = LoginLogs::find($logs[0]['id']);
				$loginlogs->update(array('patients_search_id'=>$search_ids));
				if(count($finalsendData)>0)
				{
					$data['totalDue'] = $totalAmount;
					$data['totalBehaviorReport'] = $behaviorReport;
					$data['reportCount'] = count($reportedBy);
					$data['status'] = 1;
					$data['msg'] = 'Search Successfull.';
					$data['data'] = $finalsendData;
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
				}
				else{
					$msgtxt = SiteSettings::find(1)->toArray();
					$data['status'] = 1;
					$data['msg'] = $msgtxt['search_null_msg'];
					$data['data'] =  $finalsendData;
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];			
				}
			}
			else{
				$msgtxt = SiteSettings::find(1)->toArray();
				$data['status'] = 1;
				$data['msg'] = $msgtxt['search_null_msg'];
				$data['data'] =  $finalsendData;
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
			$ssn = isset($input['ssn'])?$input['ssn']:'';
			$first_name = isset($input['first_name'])?$input['first_name']:'';
			$last_name = isset($input['last_name'])?$input['last_name']:'';
			$dob	   = isset($input['dob'])?$this->convertDate($input['dob']):'0000-00-00';
			$gender = isset($input['gender'])?$input['gender']:'';
			$storeArray = array('first_name'=>$first_name,
								'last_name'=>$last_name,
								'ssn'=>$ssn,
								'dob'=>$dob,
								'gender'=>$gender,
								'customers_id'=>$customer_id,
								'found_match'=>$searchReportId);
			PatientsLooks::create($storeArray);	
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
			$data['data'] = '';
		}
		//header("Access-Control-Allow-Origin: *");
		echo json_encode($data);	
	}

	public function postCheckpatients(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		$finalsendData = array();
		$senddata = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id)->toArray();
			$ssn = $input['ssn'];
			$ids = 0;
			$customerStatus = $customer['status'];
			$patients = Patients::where('ssn', $ssn)->get()->toArray();
            foreach($patients as $key=>$patient)
            {
            	$senddata['id']= $patient['id'];
            	$senddata['first_name']= $patient['first_name'];
            	$senddata['middle_name']= $patient['middle_name'];
            	$senddata['last_name']= $patient['last_name'];
            	$senddata['dob']= date('m-d-Y',strtotime($patient['dob']));
            	$senddata['gender']= $patient['gender'];
            	$senddata['ssn']= $patient['ssn'];
            	$senddata['address']= $patient['address'];
            	$senddata['apt']= $patient['apt'];
            	$senddata['city']= $patient['city'];
            	$senddata['state']= $patient['state'];
            	$senddata['zipcode']= $patient['zipcode'];
            	$senddata['home_phone']= $patient['home_phone'];
            	array_push($finalsendData,$senddata);
            }
            $data['status'] = 1;
			$data['msg'] = 'Successfull.';
			$data['data'] = $finalsendData;
			$data['access_token'] = $tokenStatus['access_token'];
			$data['current_status'] = $tokenStatus['current_status'];
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
			$data['data'] = '';
		}
		echo json_encode($data);
	}		

	public function postStorereport(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();

		$id_arr=array();
		if(isset($input['example8model']))
		{
			foreach ($input['example8model'] as $key => $value) 
			{
				$id_arr[]=$value['id'];
			}
		}
		$storedata = array();
		if($status == 1)
		{
			if(isset($input['report_id']) && $input['report_id']!="")
			{
				$customer_id = $tokenStatus['customer_id'];
				$customer = Customers::find($customer_id)->toArray();
				$patientReport = PatientReports::find($input['report_id']);
	        	if(count($patientReport)==1)
	        	{
					
		        	$storedata['first_name']	= isset($input['first_name'])?$input['first_name']:'';
		        	$storedata['middle_name']	= isset($input['middle_name'])?$input['middle_name']:'';
		        	$storedata['last_name']		= isset($input['last_name'])?$input['last_name']:'';
		        	$storedata['dob']			= isset($input['dob'])?$this->convertDate($input['dob']):'';
		        	$storedata['gender']		= isset($input['gender'])?$input['gender']:'';
		        	$storedata['ssn']			= isset($input['ssn'])?$input['ssn']:'';
		        	$storedata['address']		= isset($input['address'])?$input['address']:'';
		        	$storedata['apt']			= isset($input['apt'])?$input['apt']:'';
		        	$storedata['city']			= isset($input['city'])?$input['city']:'';
		        	$storedata['state']			= isset($input['state'])?$input['state']:'';
		        	$storedata['zipcode']		= isset($input['zipcode'])?$input['zipcode']:'';
		        	$storedata['home_phone']	= isset($input['home_phone'])?$input['home_phone']:'';

		        	$patient = Patients::where('first_name',trim($input['first_name']))->where('last_name',trim($input['last_name']))->where('ssn',trim($input['ssn']))->get()->toArray();
		        	if(count($patient)==0)
		        	{
		        		$storedata['customers_id'] = $customer_id;
		        		$storedata['created_at'] = date('Y-m-d H:i:s');
		        		$patient_id = Patients::insertGetId($storedata);
		        	}
		        	else if(count($patient)==1)
		        	{
		        		$patient_id = $patient[0]['id'];
		        		$patientDetails = Patients::findOrFail($patient_id);
		        		$patientDetails->update($storedata);
		        	}
		        	$insertData['patients_id'] = $patient_id;
		        	$insertData['customers_id'] = $customer_id;
		        	//$insertData['report_reason'] = isset($input['report_reason'])?$input['report_reason']:'';
		        	$insertData['balance_amount'] = isset($input['balance_amount'])?$input['balance_amount']:'';
		        	$insertData['service_date'] = isset($input['service_date'])?$this->convertDate($input['service_date']):'';
		        	$insertData['note'] = isset($input['note'])?$input['note']:'';
	        	
		        	$patientReport->update($insertData);
		        	$reportbehaviors = ReportBehaviour::where('report_id',$input['report_id'])->get()->toArray();
		        	foreach($reportbehaviors as $reportbehavior)
		        	{
		        		$deleteBehavior = ReportBehaviour::find($reportbehavior['id']);
		        		$deleteBehavior->delete();
		        	}
		        	foreach($id_arr as $behaviourList)
		        	{
		        		$behaviourData['report_id'] =$input['report_id'];
		        		$behaviourData['behaviorlists_id'] = $behaviourList;
		        		ReportBehaviour::insertGetId($behaviourData);
		        	}
		        	$data['status'] = 1;
					$data['msg'] = 'Record Updated Successfully.';
					$data['access_token'] = $tokenStatus['access_token'];
					$data['current_status'] = $tokenStatus['current_status'];
				}	
			}	
			else
			{	
				$customer_id = $tokenStatus['customer_id'];
				$customer = Customers::find($customer_id)->toArray();
				$storedata['first_name']	= isset($input['first_name'])?$input['first_name']:'';
	        	$storedata['middle_name']	= isset($input['middle_name'])?$input['middle_name']:'';
	        	$storedata['last_name']		= isset($input['last_name'])?$input['last_name']:'';
	        	$storedata['dob']			= isset($input['dob'])?$this->convertDate($input['dob']):'';
	        	$storedata['gender']		= isset($input['gender'])?$input['gender']:'';
	        	$storedata['ssn']			= isset($input['ssn'])?$input['ssn']:'';
	        	$storedata['address']		= isset($input['address'])?$input['address']:'';
	        	$storedata['apt']			= isset($input['apt'])?$input['apt']:'';
	        	$storedata['city']			= isset($input['city'])?$input['city']:'';
	        	$storedata['state']			= isset($input['state'])?$input['state']:'';
	        	$storedata['zipcode']		= isset($input['zipcode'])?$input['zipcode']:'';
	        	$storedata['home_phone']	= isset($input['home_phone'])?$input['home_phone']:'';

	        	$patient = Patients::where('first_name',trim($input['first_name']))->where('last_name',trim($input['last_name']))->where('ssn',trim($input['ssn']))->get()->toArray();
	        	if(count($patient)==0)
	        	{
	        		$storedata['customers_id'] = $customer_id;
	        		$storedata['created_at'] = date('Y-m-d H:i:s');
	        		$patient_id = Patients::insertGetId($storedata);
	        	}
	        	else if(count($patient)==1)
	        	{
	        		$patient_id = $patient[0]['id'];
	        		$patientDetails = Patients::findOrFail($patient_id);
	        		$patientDetails->update($storedata);
	        	}
	        	$insertData['patients_id'] = $patient_id;
	        	$insertData['customers_id'] = $customer_id;
	        	//$insertData['report_reason'] = isset($input['report_reason'])?$input['report_reason']:'';
	        	$insertData['balance_amount'] = isset($input['balance_amount'])?$input['balance_amount']:'';
	        	$insertData['service_date'] = isset($input['service_date'])?$this->convertDate($input['service_date']):'';
	        	$insertData['note'] = isset($input['note'])?$input['note']:'';
	        	$insertData['report_date'] = date('Y-m-d');
	        	$insertData['created_at'] = date('Y-m-d H:i:s');
	        	$report_id = PatientReports::insertGetId($insertData);
	        	foreach($id_arr as $behaviourList)
	        	{
	        		$behaviourData['report_id'] = $report_id;
	        		$behaviourData['behaviorlists_id'] = $behaviourList;
	        		ReportBehaviour::insertGetId($behaviourData);
	        	}
	        	$logs = LoginLogs::where('customers_id',$customer_id)->orderBy('created_at','desc')->get()->toArray();
				$added_id = $logs[0]['patients_ids'].','.$report_id;
				$added_ids = ltrim($added_id,',');
				$loginlogs = LoginLogs::find($logs[0]['id']);
				$loginlogs->update(array('patients_ids'=>$added_ids));
	        	$data['status'] = 1;
				$data['msg'] = 'Report Inserted Successfully.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}	
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);	
	}

	public function getOwnreports(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$finalsendData = array();
		$senddata = array();
		$behaviorShownArray=array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id)->toArray();
			$patientReports =  PatientReports::where('customers_id',$customer_id)->with('patients')->get()->toArray();
			foreach($patientReports as $key=>$patientReport)
			{
				$behaviorShown =array();
				$senddata['id'] = $patientReport['id'];
				$senddata['name'] = $patientReport['patients']['first_name'].' '.$patientReport['patients']['last_name'];
				$senddata['ssn'] = $patientReport['patients']['ssn'];
				$senddata['balance_amount'] = $patientReport['balance_amount'];
				$senddata['note'] = $patientReport['note'];
				$senddata['report_reason'] = $patientReport['report_reason'];
				$senddata['service_date'] = date('m-d-Y',strtotime($patientReport['service_date']));
				$behaviors = ReportBehaviour::where('report_id',$patientReport['id'])->with('behaviorlists')->get()->toArray();
				$behaviorShownArray=array();
				foreach($behaviors as $newkey=>$behavior)
				{
					$behaviorShown['id']= $behavior['behaviorlists']['id'];
					$behaviorShown['label']= $behavior['behaviorlists']['type_name'];
					array_push($behaviorShownArray,$behaviorShown);
					//$behaviorShown[$newkey]= $behavior['behaviorlists']['type_name'];
				}

				$senddata['behavior'] = $behaviorShownArray;
				array_push($finalsendData,$senddata);
			}	 
			if(count($finalsendData)>0)
			{
				$data['status'] = 1;
				$data['msg'] = 'Record Search Successfull.';
				$data['data'] = $finalsendData;
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
			else
			{
				$data['status'] = 1;
				$data['msg'] = 'You have not reported any patient yet.';
				$data['data'] = $finalsendData;
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
			$data['data'] = '';
		}
		echo json_encode($data);	
	}

	public function postEditdata(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		$senddata = array();
		$behaviorShown = array();
		if($status == 1)
		{
			$reports = PatientReports::where('id',$input['id'])->with('patients')->get()->toArray();
			if(count($reports)==1)
			{
				$behaviors = ReportBehaviour::where('report_id',$input['id'])->with('behaviorlists')->get()->toArray();
				$behaviorShownArray=array();
				foreach($behaviors as $newkey=>$behavior)
				{
					$behaviorShown['id']= $behavior['behaviorlists']['id'];
					$behaviorShown['label']= $behavior['behaviorlists']['type_name'];
					array_push($behaviorShownArray,$behaviorShown);
					//$behaviorShown[$newkey]= $behavior['behaviorlists']['type_name'];
				}
				$reports[0]['patients']['dob'] = date('m-d-Y',strtotime($reports[0]['patients']['dob']));
				$reports[0]['service_date'] = date('m-d-Y',strtotime($reports[0]['service_date']));
				$reports[0]['behaviours'] = $behaviorShownArray;
				$data['status'] = 1;
				$data['msg'] = 'Record Found Successfully.';
				$data['data'] = $reports[0];
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}
			else{
				$data['status'] = 0;
				$data['msg'] = 'Invalid Report Id.';
				$data['data'] = '';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}	
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
			$data['data'] = '';
		}
		echo json_encode($data);
	}

	public function postUpdatereport(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		$senddata = array();
		$id_arr=array();
		if(isset($input['example8model']))
		{
			foreach ($input['example8model'] as $key => $value) 
			{
				$id_arr[]=$value['id'];
			}
		}
		$behaviorShown = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id)->toArray();
			$patientReport = PatientReports::find($input['report_id']);
        	if(count($patientReport)==1)
        	{
				
	        	$storedata['first_name']	= isset($input['first_name'])?$input['first_name']:'';
	        	$storedata['middle_name']	= isset($input['middle_name'])?$input['middle_name']:'';
	        	$storedata['last_name']		= isset($input['last_name'])?$input['last_name']:'';
	        	$storedata['dob']			= isset($input['dob'])?$this->convertDate($input['dob']):'';
	        	$storedata['gender']		= isset($input['gender'])?$input['gender']:'';
	        	$storedata['ssn']			= isset($input['ssn'])?$input['ssn']:'';
	        	$storedata['address']		= isset($input['address'])?$input['address']:'';
	        	$storedata['apt']			= isset($input['apt'])?$input['apt']:'';
	        	$storedata['city']			= isset($input['city'])?$input['city']:'';
	        	$storedata['state']			= isset($input['state'])?$input['state']:'';
	        	$storedata['zipcode']		= isset($input['zipcode'])?$input['zipcode']:'';
	        	$storedata['home_phone']	= isset($input['home_phone'])?$input['home_phone']:'';

	        	$patient = Patients::where('first_name',trim($input['first_name']))->where('last_name',trim($input['last_name']))->where('ssn',trim($input['ssn']))->get()->toArray();
	        	if(count($patient)==0)
	        	{
	        		$storedata['customers_id'] = $customer_id;
	        		$storedata['created_at'] = date('Y-m-d H:i:s');
	        		$patient_id = Patients::insertGetId($storedata);
	        	}
	        	else if(count($patient)==1)
	        	{
	        		$patient_id = $patient[0]['id'];
	        		$patientDetails = Patients::findOrFail($patient_id);
	        		$patientDetails->update($storedata);
	        	}
	        	$insertData['patients_id'] = $patient_id;
	        	$insertData['customers_id'] = $customer_id;
	        	//$insertData['report_reason'] = isset($input['report_reason'])?$input['report_reason']:'';
	        	$insertData['balance_amount'] = isset($input['balance_amount'])?$input['balance_amount']:'';
	        	$insertData['service_date'] = isset($input['service_date'])?$this->convertDate($input['service_date']):'';
	        	$insertData['note'] = isset($input['note'])?$input['note']:'';
        	
	        	$patientReport->update($insertData);
	        	$reportbehaviors = ReportBehaviour::where('report_id',$input['report_id'])->get()->toArray();
	        	foreach($reportbehaviors as $reportbehavior)
	        	{
	        		$deleteBehavior = ReportBehaviour::find($reportbehavior['id']);
	        		$deleteBehavior->delete();
	        	}
	        	foreach($id_arr as $behaviourList)
	        	{
	        		$behaviourData['report_id'] =$input['report_id'];
	        		$behaviourData['behaviorlists_id'] = $behaviourList;
	        		ReportBehaviour::insertGetId($behaviourData);
	        	}
	        	$data['status'] = 1;
				$data['msg'] = 'Record Updated Successfully.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
	        }
	        else	
        	{
        		$data['status'] = 0;
				$data['msg'] = 'Invalid Report Id.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
			}	
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);
	}
	/*public function postSubcribepackage(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		$senddata = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$customer = Customers::find($customer_id);	
			$memberships = Memberships::where('id',$input['membership_id'])->get()->toArray();
			$storedata['status'] = 'Active';
			$storedata['memberships_id'] = $input['membership_id'];
			$storedata['expiry_date'] = date('Y-m-d',strtotime("+".$memberships[0]['duration']."months"));
			$customer->update($storedata);
			$data['status'] = 1;
			$data['msg'] = 'Subscription Done.';
			$data['access_token'] = $tokenStatus['access_token'];
			$data['current_status'] = $tokenStatus['current_status'];
		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);
	}*/


	public function postSavecard(Request $request)
	{
		$headers = $request->header();
		$access_token = $headers['access-token'][0];
		$tokenStatus = $this->checktoken($access_token);
		$status = $tokenStatus['status'];
		$input = $request->all();
		$senddata = array();
		if($status == 1)
		{
			$customer_id = $tokenStatus['customer_id'];
			$cardData = array('card_number'=>$input['card_no'],
		    				  'expire_month'=>$input['expiry_month'],
		    				  'expire_year'=>$input['expiry_year'],
		    				  'customers_id'=>$customer_id);
		    $creditCardDetails = CreditCards::where('card_number',$input['card_no'])->where('customers_id',$customer_id)->get()->toArray();
		    if(count($creditCardDetails)==0)
		    {
		    	CreditCards::create($cardData);
		    	$data['status'] = 1;
				$data['msg'] = 'New Card Saved.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
		    }
		    else
		    {
		    	$data['status'] = 0;
				$data['msg'] = 'Card Already Exists.';
				$data['access_token'] = $tokenStatus['access_token'];
				$data['current_status'] = $tokenStatus['current_status'];
		    }

		}
		else if($status == 0)
		{
			$data['status'] = 0;
			$data['msg'] = 'Invalid Token.';
		}
		echo json_encode($data);    	
	}

	public function getPdflink()
	{
		$senddata= array();
		$finalsenddata= array();
		$siteSetting= SiteSettings::find(1)->toArray();
		$data['status'] = 1;
		$data['msg'] = 'Successfull.';
		$data['data'] = asset('public/uploads/membership').'/'.$siteSetting['membership_pdf_link'];
		echo json_encode($data);
	}



}	
?>