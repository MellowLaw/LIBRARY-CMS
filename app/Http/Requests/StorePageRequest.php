<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]*$/',
                'unique:pages,slug',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>]/',
            ],
            'content' => [
                'nullable',
                'string',
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:160',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug can only contain lowercase letters, numbers, and hyphens.',
            'title.not_regex' => 'Title cannot contain HTML tags.',
        ];
    }
}
