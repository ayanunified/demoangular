<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCustomersRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'businessName' => 'required', 
            'businesses_id' => 'required', 
            'address' => 'required', 
            'city' => 'required', 
            'state' => 'required', 
            'zip' =>  'required|max:6',
            'office_phone' => 'required|max:16', 
            'email' => 'required', 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'cell_phone'=> 'max:16',
            'username' => 'required', 
            'status' => 'required', 
            'expiry_date' => 'required', 
            'memberships_id' => 'required', 
            
		];
	}
}
