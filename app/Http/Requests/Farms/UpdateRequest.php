<?php

namespace App\Http\Requests\Farms;

use App\Farm;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $farm = Farm::findBySlug($this->route('farm'));

        return $farm && $farm->access === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => ['required'],
            'signature' => ['required'],
            'name' => ['sometimes', 'min:5', 'max:30'],
            'content' => ['sometimes', 'min:10', 'max:255'],
            'image' => ['sometimes', 'mimetypes:image/jpeg', 'mimes:jpeg,jpg', 'dimensions:width=1600,height=900', 'max:5000'],
        ];
    }
}
