<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCreditCardsRequest extends Request {

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
            'card_number' => 'required', 
            'expire_month' => 'required', 
            'expire_year' => 'required', 
            'name' => 'required', 
            'creditcardtypes_id' => 'required', 
            
		];
	}
}
