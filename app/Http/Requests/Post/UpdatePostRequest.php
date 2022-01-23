<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'post_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'please write title for update',
            'description.required' => 'please write description for update',
            'post_img.required' => 'please upload image post',
        ];
    }
}
