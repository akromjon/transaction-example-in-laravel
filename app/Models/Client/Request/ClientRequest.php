<?php

namespace App\Models\Client\Request;

use App\Http\Requests\ParentRequest;

class ClientRequest extends ParentRequest
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
            'name' => 'required|string|max:255|min:3',
            'surname' => 'required|string|max:255|min:3'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator_errors)
    {
        return $this->send_errors($validator_errors);
    }
}
