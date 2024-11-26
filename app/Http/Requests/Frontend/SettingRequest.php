<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name'=>'required|string|min:2|max:60',
            'username'=>'required|string|min:2|max:60|unique:users,username,'.auth()->user()->id,
            'email'=>'required|email|unique:users,email,'.auth()->user()->id,
            'country'=>'required|string|min:2|max:60',
            'city'=>'required|string|min:2|max:60',
            'image'=>'nullable|image|mimes:png,jpg',
            'street'=>'required|string|min:2|max:60',
            'phone'=>'required|string|min:2|max:60|unique:users,phone,'.auth()->user()->id,
        ];
    }
}
