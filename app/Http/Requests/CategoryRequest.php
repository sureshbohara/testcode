<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'parent_id' => 'nullable',
            'name' => 'required|unique:categories',
            'slug' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'type' => 'nullable',
            'description' => 'nullable|string',
            'order_level' => 'nullable|string|max:255',
            'status' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a JPEG or PNG file.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ];
    }
}
