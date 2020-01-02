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

      //  dd($this);
        return [
           'title' =>  'unique:posts,title,'.$this->id.',posts.id',
           'slug' => "required|unique:posts,slug,".$this->id,
           'name' => "required|unique:posts,name,".$this->id,
           'meta_description' => 'required',
           'category_id' => 'required',
           'content' => 'required',
        ];
    }
}
