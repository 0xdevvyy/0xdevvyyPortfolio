<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('projects', 'slug')->ignore($this->route('project')),
            ],

            'description' => ['required', 'string'],

            'excerpt' => ['nullable', 'string', 'max:500'],

            'features' => ['nullable', 'array'],
            'features.*' => ['required', 'string', 'max:255'],

            'is_published' => ['required', 'boolean'],

            'published_at' => [
                'nullable',
                'date',
                'required_if:is_published,1',
            ],

            // tegs and screenshots are next...
            'tags' => ['array'],
            'tags.*' => ['required', 'exists:tags,id'],

        ];
    }
}
