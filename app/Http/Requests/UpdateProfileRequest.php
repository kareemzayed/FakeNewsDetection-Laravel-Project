<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string|regex:/^[a-zA-Z0-9 ]+$/u',
            'email' => Rule::unique('users')->ignore(auth()->user()->id),
            'email' => 'required|max:255|email',
            'jop_title' => 'required|max:255|string|regex:/^[a-zA-Z0-9 ]+$/u',
            'data_of_birth' => 'required|date|before:today',
            'phone_number' => 'required|max:1599999999|numeric',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'gender' => 'required|regex:/^[a-zA-Z]+$/u',
            'photo' => 'image|mimes:jpeg,png,jpg|max:10000',
            'facebook' => 'required|max:255|url',
            'twitter' => 'required|max:255|url',
            'linkedin' => 'required|max:255|url',
            'github' => 'required|max:255|url',
            'instagram' => 'required|max:255|url',
            'skype' => 'required|max:255|url',
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'only letters of the alphabet and numbers are allowed',
            'email.email' => 'please enter a valid email, such as: example123@ex.com',
            'jop_title.regex' => 'only letters of the alphabet and numbers are allowed',
            'data_of_birth.before' => 'date of birth must be entered before today\'s date',
            'phone_number.max' => 'the phone number is too long, please enter a valid number',
            'phone_number.numeric' => 'the phone number must be numbers only',
            'address.regex' => 'only letters of the alphabet, numbers and [/ \ - , ] are allaowed',
            'photo.mimes' => 'Please enter a valid image [jpeg, png, jpg]',
        ];
    }
}
