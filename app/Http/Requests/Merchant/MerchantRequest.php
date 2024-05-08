<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class MerchantRequest extends BaseRequest
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
            "company_name" => "required|string|max:255",
            "company_tax_id" => "required|string|max:100|unique:merchants,company_tax_id,$request->uuid,uuid",
            "contact_number" => "required|string|max:50",
            "address" => "required|string|max:255",
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    public function parameters(): array
    {
        return [
            "company_name" => $this->input("company_name"),
            "company_tax_id" => $this->input("company_tax_id"),
            "contact_number" => $this->input("contact_number"),
            "address" => $this->input("address"),
        ];
    }
}
