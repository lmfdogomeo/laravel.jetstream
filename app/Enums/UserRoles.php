<?php 

namespace App\Enums;

use App\Enums\Concerns\Conditions;

enum UserRoles: string
{
    use Conditions;
    
    case ADMIN = 'admin';
    case MERCHANT = 'merchant';
}