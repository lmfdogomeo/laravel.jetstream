<?php

namespace App\Enums\Concerns;

use BackedEnum;

trait Values
{
    /**
     * Create an array of labels.
     */
    public static function labels(): array
    {
        return array_map(
            fn ($instance) => str($instance->value)->headline()->__toString(),
            self::cases()
        );
    }

    /**
     * Create an array of values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Create an associative array.
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::labels());
    }
}
