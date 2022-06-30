<?php

namespace App\Http\Requests\Fair;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'farm_1' => ['required', 'exists:farms,xcp_core_address'],
            'farm_2' => ['required', 'exists:farms,xcp_core_address'],
        ];
    }
}
