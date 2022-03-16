<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Su correo electónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalído.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener un minimo de ocho caracteres.'
        ];
    }
}
