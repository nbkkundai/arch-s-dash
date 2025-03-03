<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupStoreRequest extends FormRequest
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
            'name' => [
                'required', 
                // 'string', 
                // Rule::unique('groups')
                // ->where(
                //     fn ($query) => $query->where('centre_id', request()->centre_id)
                // )
            ],
            'zone_name' => ['required', 'string'],
            'area_code' => ['required'],
            'area_officer' => ['required'],
            'post_office' => ['string'],
            'zone_code' => ['required', 'string'],
            'bank_account_name' => ['string'],
            'bank_account_number' => ['string', 'unique:groups'],
            'meeting_day' => ['string'],
            'meeting_time' => ['string'],
            'loan_application_file'=>[],
            'centre_id' => ['integer', 'exists:centres,id'],
            'creator_id' => ['integer', 'exists:creators,id'],
            'status_id'=>['required'],
            'loan_status_id'=>['required'],
            'loan_cycle' => ['required', 'string'],
            'loan_term' => ['required', 'string'],
            'loan_amount' => ['required', 'numeric'],
        ];
    }
}
