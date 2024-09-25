<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('projects')
            ],
            'date' => ['required'],
            'description' => ['required'],
            'cover_path' => ['required', 'image|mimes:jpg,jpeg,png,gif|max:1024'],
            'link' => ['nullable'],
            'git_link' => ['nullable'],
            'technologies' => ['exists:technologies,id'],
            'categories' => ['exists:categories,id'],
            'image_path' => 'nullable|array',
            'image_path.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:projects',
            'date' => 'required',
            'description' => 'required',
            'cover_path' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
            'link' => 'nullable',
            'git_link' => 'nullable',
            'technologies' => [
                'array',
                'exists:technologies,id'
            ],
            'categories' => [
                'array',
                'exists:categories,id'
            ],
            'image_path' => 'nullable|array',
            'image_path.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
