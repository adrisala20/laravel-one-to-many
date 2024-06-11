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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:projects|max:200|min:3',
            'image'=> 'nullable|image',
            'content'=> 'nullable',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio!',
            'title.unique:project' => 'Questo titolo esiste già!',
            'title.max' => 'Il titolo deve essere lungo massimo :max caratteri!',
            'title.min' => 'Il titolo deve essere lungo almeno :min caratteri!',
            'image.max' => 'La URL deve essere lungo massimo :max caratteri!'
        ];
    }
}
