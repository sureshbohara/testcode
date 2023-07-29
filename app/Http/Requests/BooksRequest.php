<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:books,slug|max:255',
            'tags' => 'required',
            'tags.*' => 'string', 
            'image' => 'nullable|string|max:255',
            'type' => 'nullable',
            'stock' => 'required|integer|min:0',
            'short_details' => 'nullable|string',
            'long_details' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
            'view_count' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'created_by' => 'nullable|string|max:255',
            'updated_by' => 'nullable|string|max:255',
            'author_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'The category name is required.',
            'category_id.integer' => 'The category name must be an integer.',
            'category_id.exists' => 'The selected category does not exist.',
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed :max characters.',
            'tags.max' => 'The tags must not exceed :max characters.',
        ];
    }
}
