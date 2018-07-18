<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfileRequest extends FormRequest
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
            'username' => [
                'required',
                'string',
                'min:2',
                Rule::unique('profiles')->ignore($this->profile ? $this->profile->id : null)
            ],

            'first_name' => [
                'required',
                'string',
                'min:2'
            ],

            'last_name' => [
                'required',
                'string',
                'min:2'
            ],

            'bio' => [
                'nullable',
                'string',
                'min:2'
            ],

            'avatar' => [
                'nullable',
                'image',
                'dimensions:min_width:100,min_height:100',
                'size:5000'
            ]
        ];
    }
}
