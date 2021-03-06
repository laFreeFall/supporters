<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePledgeRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:2'
            ],

            'privileges' => [
                'required',
                'string',
                'min:3'
            ],

            'amount' => [
                'required',
                'integer',
                'min:0',
                Rule::unique('campaigns_pledges')->ignore($this->pledge ? $this->pledge->id : null)
            ]
        ];
    }
}
