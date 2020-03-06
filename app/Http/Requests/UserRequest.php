<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests
 */
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
            'old_password'     => 'sometimes|nullable|between:8,15|regex:/[a-zA-Z0-9_]+/',
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
            'old_password.regex'         => Lang::get('errors.old_password.regex'),
            'old_password.between'       => Lang::get('errors.old_password.between'),
            'new_password.regex'         => Lang::get('errors.new_password.regex'),
            'new_password.same'          => Lang::get('errors.new_password.same'),
            'new_password.different'     => Lang::get('errors.new_password.different'),
            'new_password.between'       => Lang::get('errors.new_password.between'),
            'confirm_password.regex'     => Lang::get('errors.confirm_password.regex'),
            'confirm_password.same'      => Lang::get('errors.confirm_password.same'),
            'confirm_password.different' => Lang::get('errors.confirm_password.different'),
            'confirm_password.between'   => Lang::get('errors.confirm_password.between'),
        ];
    }
}
