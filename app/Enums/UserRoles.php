<?php 

namespace App\Enums;

use App\Enums\Concerns\Conditions;
use App\Enums\Concerns\Values;

enum UserRoles: string
{
    use Conditions, Values;
    
    case ADMIN = 'admin';
    case MERCHANT = 'merchant';
}