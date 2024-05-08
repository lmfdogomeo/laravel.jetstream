<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class ProductRequest extends BaseRequest
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
            "product_name" => "required|string|max:255",
            "product_description" => "required|string",
            "price" => "required|decimal:2",
            "quantity" => "required|int",
        ];
    }

    /**
     * custom validation messages
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
            "product_name" => $this->product_name,
            "product_description" => $this->product_description,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "merchant_id" => $this->merchant_id
        ];
    }
}
