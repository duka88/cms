<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
           'title' => 'required|unique:posts',
           'slug' => 'required|unique:posts',
           'name' => 'required|unique:posts',
           'meta_description' => 'required',
           'category_id' => 'required',
           'content' => 'required',

        ];
    }
}
