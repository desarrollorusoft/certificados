<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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

            'title' =>'required | max:50',
            'description' => 'nullable | max:450'
        ];
    }
    public function attributes()
    {
        return [
            'title'   => 'título',
            'description'   => 'descripción',

          ];
    }
}