<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePaymentReportRequest extends Request {

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
            'customers_id' => 'required', 
            'transaction_id' => 'required', 
            'amount_paid' => 'numeric|required', 
            
		];
	}
}
