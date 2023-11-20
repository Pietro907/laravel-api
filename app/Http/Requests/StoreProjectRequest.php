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
            'title' => ['required','unique:projects', 'bail','max:50', 'min:3'],
            'thumb'  => ['nullable', 'image','max:300'],
            /* 'description' => ['required,max 100,min 10'],
            'authors' => ['nullable,unique,max 50,min 3'],
            'link' => ['required,unique,max 255'],
            'git_hub' => ['required,unique,max 255'],
            'type_id' => ['nullable'],
            'tech' => ['nullable'], */
        ];
    }
}
