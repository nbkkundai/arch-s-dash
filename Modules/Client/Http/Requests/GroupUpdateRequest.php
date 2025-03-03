<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string'],
            'zone_name' => ['sometimes', 'string'],
            'zone_code' => ['sometimes', 'string'],
            'post_office' => ['string'],
            'bank_account_name' => ['string'],
            'bank_account_number' => ['string', 'unique:groups,bank_account_name,'.$this->group->id],
            'meeting_day' => ['string'],
            'meeting_time' => ['string'],
            'centre_id' => ['integer', 'exists:centres,id'],
            'creator_id' => ['integer', 'exists:creators,id'],
            'status' => ['string'],
        ];
    }
}
