<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|string|min:6|max:100|email:rfc,dns|unique:users,email',
            'phone' => 'required|string|regex:/^[\+]{0,1}380([0-9]{9})$/|unique:users,phone',
            'position_id' => 'required|integer|exists:positions,id|min:1',
            'photo' => 'required|file|mimes:jpeg,jpg|dimensions:min_width=70,min_height=70|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name must not exceed 60 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone field is required.',
            'phone.regex' => 'The phone number must start with +380 and contain 12 digits.',
            'position_id.required' => 'The position id field is required.',
            'position_id.exists' => 'The position id must be valid.',
            'photo.required' => 'The photo is required.',
            'photo.mimes' => 'The photo must be a JPEG/JPG file.',
            'photo.dimensions' => 'The photo must have a minimum resolution of 70x70 pixels.',
            'photo.max' => 'The photo must not exceed 5 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $existingUser = User::hasDuplicate($this->input('email'), $this->input('phone'));

        if ($existingUser) {
            abort(response()->json([
                'success' => false,
                'message' => 'User with this phone or email already exist',
            ], 409));
        }
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'fails' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
