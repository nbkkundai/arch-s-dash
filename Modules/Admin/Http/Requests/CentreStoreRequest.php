<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentreStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:centres,name,'.$this->centre?->id],
            'code' => ['unique:centres,code,'.$this->centre?->id],
            'address_line_1' => [],
            'address_line_2' => [],
            'city' => [],
            'province' => []
        ];
    }
}
