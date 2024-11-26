<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|string|max:50',
            'description'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'images'=>'nullable',
            'images.*'=>'image|mimes:png,jpg',
            'comment_able'=>'in:on,off,1,0',
            'status'=>'in:,1,0',
        ];
    }
}
