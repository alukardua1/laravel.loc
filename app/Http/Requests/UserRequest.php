<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'     => 'sometimes|nullable|between:8,15',
            'new_password'     => 'same:confirm_password|different:old_password|regex:/[a-zA-Z0-9_]+/|sometimes|nullable|between:8,15',
            'confirm_password' => 'same:new_password|different:old_password|regex:/[a-zA-Z0-9_]+/|sometimes|nullable|between:8,15',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'old_password.between'       => 'Старый пароль должен содержать от :min до :max символов..',
            'new_password.regex'         => 'Недопустимый формат нового пароля..',
            'new_password.same'          => 'Новый пароль и пароль подтверждения должны совпадать..',
            'new_password.different'     => 'Новый пароль и старый пароль должны отличаться..',
            'new_password.between'       => 'Новый пароль должен содержать от :min до :max символов..',
            'confirm_password.regex'     => 'Недопустимый формат подтверждения пароля..',
            'confirm_password.same'      => 'Пароль подтверждения и новый пароль должны совпадать..',
            'confirm_password.different' => 'Пароль подтверждения и старый пароль должны отличаться..',
            'confirm_password.between'   => 'Пароль подтверждения должен содержать от :min до :max символов..',
        ];
    }
}
