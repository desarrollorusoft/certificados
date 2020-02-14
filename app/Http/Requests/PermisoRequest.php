<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
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
            'name' => 'required|Max:50',
            'guard_name'  =>'required',       
        ];
    }

    public function attributes()
    {
            return [
                'name'                   => 'nombre',
                'guard_name'             => 'Guard',
            ];
     
    }
}
