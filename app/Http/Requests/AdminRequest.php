<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'bio' => 'nullable|string',
            'status' => 'nullable',
            'profiles' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'address.required' => 'The address must be a string.',
            'contact.required' => 'The contact must be a string.',
            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The selected gender is invalid.',
            'facebook.string' => 'The Facebook field must be a string.',
            'instagram.string' => 'The Instagram field must be a string.',
            'twitter.string' => 'The Twitter field must be a string.',
            'bio.string' => 'The bio field must be a string.',
        ];
    }



}
