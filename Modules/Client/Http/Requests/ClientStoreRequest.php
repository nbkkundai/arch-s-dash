<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\Rules\ValidateId;

class ClientStoreRequest extends FormRequest
{
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
            'first_name' => [''],
            'initials' => ['required', ],
            'last_name' => ['required', ],
            'id_number' => ['required', 'numeric', 'unique:clients,id_number','digits_between:9,13'], //,'digits_between:13,13',new ValidateID()
            'id_type' => [''],
            'date_of_birth' => ['date'],
            'sex' => [''],
            'citizenship' => [''],
            'marital_status' => [''],
            'phone' => [''],
            'email' => ['email'],
            'address_line_1' => [],
            'id_file' => [],
            'address_line_2' => [],
            'address_code' => [],
            'years_in_business'=>['integer'],
            'business_type'=>[],
            'employment_type'=>[],
            'city' => [],
            'province' => [],
            'postal_line_1' => [],
            'postal_line_2' => [],
            'postal_city' => [],
            'postal_code' => [],
            'postal_province' => [],
            'country_id' => [],
            'centre_id' => ['integer', 'exists:centres,id'],
            'marketing_channel' => [''],
            'agreed_to_privacy_policy' => [''],
            'group_id'=>['required'],
            'loan_fraction' => ['required', 'numeric'],
        ];
    }
}
