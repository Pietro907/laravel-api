<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule,array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            /*             'title' => ['required','unique:projects', 'bail','max:50', 'min:3'],
            'thumb'  => ['nullable', 'image','max:500'],
            'description' => ['required','max:100','min:10'],
            'authors' => ['nullable','max:50','min:3'],
            'link' => ['required,unique,max 255'],
            'git_hub' => ['required,unique,max 255'],
            'type_id' => ['nullable'],
            'tech' => ['nullable'], */


            'title' => 'required|unique:projects|bail|min:3|max:200',
            'thumb' => 'nullable|image|max:300',
            'description' => 'nullable|bail|min:3|max:500',
            'authors' => 'nullable|max:50|min:3',
            /* 'tech' => 'nullable|bail|min:3|max:200', */
            'type_id' => ['nullable', 'exists:types,id'],
            'tech' => ['nullable', 'exists:technologies,id'],
            'link_github' => 'nullable|bail|url:http,https',
            'link' => 'nullable|bail|url:http,https',
        ];
    }
}
