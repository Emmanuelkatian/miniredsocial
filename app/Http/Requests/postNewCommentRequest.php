<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postNewCommentRequest extends FormRequest
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
            'comment_body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'comment_body.required' => 'No puedes enviar un comentario vacio',
        ];
    }
}