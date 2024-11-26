<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class settingRequest extends FormRequest
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
            'site_name'=>'required|string|min:2|max:60',
            'email'=>'required|email',
            'country'=>'required|string|min:2|max:60',
            'city'=>'required|string|min:2|max:60',
            'street'=>'required|string|min:2|max:60',
            'phone'=>'required|string|min:2|max:60',
            'facebook'=>"required|string",
            'twitter'=>"required|string",
            'instagram'=>"required|string",
            'youtube'=>"required|string",
            'logo'=>"image|mimes:png,jpg",
            'favicon'=>"image|mimes:png,jpg",
        ];
    }
}
