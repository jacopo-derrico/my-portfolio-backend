<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProjectRequest extends FormRequest
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
            'cover_path' => ['nullable', 'image|mimes:jpg,jpeg,png,gif|max:1024'],
            'link' => ['nullable'],
            'git_link' => ['nullable'],
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
            'title' => 'required|string|unique:projects,title,'.$this->project, // the last part exclude the current record, $this->project returns the id of the record
            'date' => 'required',
            'description' => 'required',
            'cover_path' => ['nullable', 'image|mimes:jpg,jpeg,png,gif|max:1024'],
            'link' => 'nullable',
            'git_link' => 'nullable',
        ];
    }
}
