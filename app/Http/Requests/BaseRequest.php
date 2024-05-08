<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\RequestHelpers;
use App\Http\Requests\Contracts\RequestContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class BaseRequest extends FormRequest implements RequestContract
{
    use RequestHelpers;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function parameters(): array
    {
        return $this->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [];
    }
}
