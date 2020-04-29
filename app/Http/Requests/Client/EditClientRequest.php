<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class EditClientRequest extends FormRequest
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
            'name' => 'required|unique:clients,name,'.$this->id,
            'email' => 'required|unique:clients,email,'.$this->id,
            'curent' =>'integer|min:0',          
            'type_id' => 'required',
            'time-frame' => 'after:today'
        ];
    }
}
