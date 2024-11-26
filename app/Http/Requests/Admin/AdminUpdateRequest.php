<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
        $adminId = $this->route('admin');
        return [
            'name'=>"required|string|max:255",
            'username'=>"required|string|max:255|unique:admins,username,{$adminId}",
            'email'=>"required|email|unique:admins,email,{$adminId}",
            'password'=>"nullable|confirmed",
            'status'=>"required|in:1,0",
            'role_id'=>"required|string|max:255",

        ];
    }
}