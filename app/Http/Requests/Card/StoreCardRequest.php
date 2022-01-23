<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'empty title',
            'description.required' => 'empty description',
        ];
    }
}
