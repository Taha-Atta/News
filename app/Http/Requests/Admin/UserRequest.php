<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>"required|string|max:255",
            'username'=>"required|string|max:255|unique:users,username",
            'email'=>"required|email|unique:users,email",
            'country'=>"required|string|max:50",
            'city'=>"required|string|max:50",
            'street'=>"required|string|max:50",
            'image'=>"required|image|mimes:png,jpg",
            'password'=>"required|confirmed",
            'phone'=>"required|string|max:20|unique:users,phone,",
            'status'=>"in:1,0",
            'email_verified_at'=>"in:1,0",
        ];
    }
}
