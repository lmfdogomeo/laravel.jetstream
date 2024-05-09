<?php

namespace App\Enums\Concerns;

use BackedEnum;

trait Conditions
{
    public function is(BackedEnum $value): bool
    {
        return $this->value === $value->value;
    }
}