<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MerchantUserRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            "name" => "required|string",
            "email" => [
                "required",
                "string",
                "email",
                Rule::unique('users')->ignore($request->user_uuid, 'uuid')
            ],
            "password" => "required_without:user_uuid",
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "password.required_without" => "The password field is required."
        ];
    }

    public function parameters(): array
    {
        return [
            "name" => $this->input("name"),
            "email" => $this->input("email"),
            "password" => bcrypt($this->input("password")),
        ];
    }
}
