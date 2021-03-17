<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dishValidate extends FormRequest
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
            "name" => "required|min:3|max:50|string",
            "price" => "required|numeric",
            "visibility" => "required",
            "description" => "required|string|min:10|max:500",
            "image" => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048|required',
            "genre" => "required"
            
        ];
    }
}
