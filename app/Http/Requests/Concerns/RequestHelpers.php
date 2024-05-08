<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Foundation\Http\FormRequest;

trait RequestHelpers
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function uuid(): string
    {
        return $this->route('uuid');
    }
}
