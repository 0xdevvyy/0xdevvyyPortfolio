<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:8', 'max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('projects', 'slug'),
            ],

            'description' => ['required', 'string', 'min:8', 'max:200'],

            'excerpt' => ['required', 'string', 'min:8', 'max:200'],

            'features' => ['nullable', 'array'],
            'features.*' => ['required', 'string', 'max:255'],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'distinct', 'exists:tags,id'],

            'thumbnail_path' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:1024',
            ],

            'screenshots' => ['nullable', 'array'],
            'screenshots.*' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:1024',
            ],

            'is_published' => ['required', 'boolean'],
        ];
    }
}
