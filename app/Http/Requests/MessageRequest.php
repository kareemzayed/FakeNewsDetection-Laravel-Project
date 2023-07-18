<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'name' => 'required|regex:/^[A-Za-z0-9]+$/',
            'email' => 'required|email',
            'subject' => 'required|regex:/^[A-Za-z0-9]+$/',
            'message' => 'required',
        ];
    }
}
