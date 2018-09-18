<?php

namespace App\Http\Requests\Cards;

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
            'burn' => 'required|unique:tokens,xcp_core_burn_tx_hash|exists:transactions,tx_hash',
            'name' => 'required|unique:tokens|exists:assets,asset_name',
            'image' => 'required|image|mimes:png,gif|dimensions:width=375,height=520',
            'hd_image' => 'sometimes|image|mimes:png,gif|dimensions:width=750,height=1040',
            'content' => 'required|min:20|max:65535',
        ];
    }
}
