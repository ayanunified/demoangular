<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSiteSettingsRequest extends Request {

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
            'logo' => 'required', 
            'contact_mail' => 'required', 
            'admin_email' => 'required', 
            'contact_address' => 'required', 
            
		];
	}
}
