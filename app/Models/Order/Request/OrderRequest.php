<?php

namespace App\Models\Order\Request;

use App\Http\Requests\ParentRequest;

class OrderRequest extends ParentRequest
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
            'client_id' => 'required|integer|exists:clients,id',
            'order_date' => 'required|date'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator_errors)
    {
        return $this->send_errors($validator_errors);
    }
}
