<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampaignRequest extends FormRequest
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
                'min:2',
                Rule::unique('campaigns')->ignore($this->campaign ? $this->campaign->id : null)
            ],

            'activity' => [
                'required','
                string','
                min:5'
            ],

            'description' => [
                'nullable',
                'string',
                'min:5'
            ],

            'category_id' => [
                'required',
                'integer'
            ],

            'slug' => [
                'required',
                'string',
                'min:2',
                Rule::unique('campaigns')->ignore($this->campaign ? $this->campaign->id : null)
            ],

            'holder' => [
                'required'
            ],

            'color_id' => [
                'required',
                'integer'
            ],

            'avatar' => [
                'image'
            ]
        ];
    }
}
