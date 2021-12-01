<?php

namespace App\Models\Transaction\Request;

use App\Http\Requests\ParentRequest;

class TransactionRequest extends ParentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            'order_id' => 'required|integer|exists:orders,id',
            'total' => 'required|numeric'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator_errors)
    {
        return $this->send_errors($validator_errors);
    }
}
