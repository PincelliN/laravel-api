<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name'=>'required|unique:technologies,name|max:30|min:3'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Il campo è obbligatorio.',
            'name.unique'=>'il nome di questa tecnologia è gia presente',
            'name.max'=>'Il campo nome non può superare i :max caratteri.',
            'name.min'=> 'Il campo nome deve contenere almeno :min caratteri.'
        ];
    }
}