<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Http\Request;

interface RequestContract
{
    public function authorize(): bool;
    public function rules(Request $request): array;
    public function parameters(): array;
    public function uuid(): string;
}
