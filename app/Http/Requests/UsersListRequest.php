<?php

namespace App\Http\Requests;

use App\Responses\UsersListResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UsersListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'nullable|integer|min:1',
            'count' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'page.integer' => 'The page must be an integer.',
            'page.min' => 'The page must be at least 1.',
            'count.integer' => 'The count must be an integer.',
            'count.min' => 'The count must be at least 1.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = UsersListResponse::validationFailed($validator);

        throw new ValidationException($validator, $response);
    }
}
