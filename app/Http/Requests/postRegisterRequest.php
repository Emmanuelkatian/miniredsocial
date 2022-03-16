<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postRegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Su correo electónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalído.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe tener un minimo de ocho caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' => 'La confirmación de la contraseña debe de tener al menos 8 caracteres.',
            'cpassword.same' => 'La contraseña no coinciden.'
        ];
    }
}
