<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'firstName'             => 'required|string|max:255',
            'lastName'              => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void {
        throw new HttpResponseException(
            Helper::jsonResponse(false, 'Validation Failed', 422, ['errors' => $validator->errors()])
        );
    }
}
