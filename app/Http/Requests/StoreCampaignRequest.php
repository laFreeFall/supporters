<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'required|string|min:2|unique:campaigns',
            'activity' => 'required|string|min:5',
            'description' => 'string|min:5',
            'category_id' => 'required|integer',
            'slug' => 'required|string|min:2|unique:campaigns',
            'holder' => 'required',
            'color_id' => 'required|integer',
            'avatar' => 'image'
        ];
    }
}
