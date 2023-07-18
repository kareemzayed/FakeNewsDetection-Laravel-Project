<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required',
            'newPassword' =>['required','string','min:10',],
            'confirmPassword' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'newPassword.min' => 'new password must be at least 10 digits',
        ];
    }

}
