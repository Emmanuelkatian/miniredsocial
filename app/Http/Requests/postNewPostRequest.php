<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postNewPostRequest extends FormRequest
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
            'content_post' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content_post.required' => 'No puedes enviar un estado vacio',
        ];
    }
}
