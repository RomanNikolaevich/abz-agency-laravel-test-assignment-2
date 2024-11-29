<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'userId' => 'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'userId.integer' => 'The user id must be an integer.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['userId' => $this->route('id')]);
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'success' => false,
            'message' => 'The user with the requested id does not exist',
            'fails' => $validator->errors(),
        ], 400);

        throw new ValidationException($validator, $response);
    }

}
