<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['bail', 'required', 'string', 'max:50'],
            'password' => ['bail', 'required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => "Tên đăng nhập không được để trống.",
            'username.string' => "Tên đăng nhập phải là chữ.",
            'username.max' => "Tên đăng nhập không vượt quá 50 ký tự.",
            'password.required' => "Mật khẩu không được để trống.",
            'password.string' => "Mật khẩu phải là chữ.",
            'password.min' => "Mật khẩu phải có ít nhất 8 ký tự."
        ];
    }
}
