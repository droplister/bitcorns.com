<?php

namespace App\Http\Requests\Farms;

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
        $farm = $this->route('farm');

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
            'content' => ['sometimes', 'min:10', 'max:255'],
            'coop' => ['sometimes', 'exists:coops,id'],
            'add' => ['sometimes', 'required_with:coop'],
            'leave' => ['sometimes', 'required_with:coop'],
            'name' => ['sometimes', 'min:5', 'max:30', 'unique:farms,name,' . $this->route('farm')->id],
            'latitude' => ['sometimes', 'required_with:latitude', 'nullable', 'numeric', 'min:-90', 'max:90'],
            'lontitude' => ['sometimes', 'required_with:longitude', 'nullable', 'numeric', 'min:-180', 'max:180'],
            'image' => ['sometimes', 'mimetypes:image/jpeg', 'mimes:jpeg,jpg', 'dimensions:width=1600,height=900', 'max:5000'],
        ];
    }
}
