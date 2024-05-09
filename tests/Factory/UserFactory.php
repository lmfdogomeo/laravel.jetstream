<?php 

namespace Tests\Factory;

use App\Enums\UserRoles;

class UserFactory
{
    public const USER_ADMIN_UUID = '85887074-8da2-3b7b-a8bb-45429339d4b3';
    public const USER_MERCHANT_UUID = '59a0af5e-405a-3b26-a7b1-dd30156431c7';
    public const PASSWORD = 'password';

    public const TEST_USER_ADMIN_DATA = [
        'uuid' => self::USER_ADMIN_UUID,
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'email_verified_at' => '2024-01-01 00:00:00',
        'password' => self::PASSWORD,
        'remember_token' => null,
        'role' => UserRoles::ADMIN,
    ];

    public const TEST_USER_MERCHANT_DATA = [
        'uuid' => self::USER_MERCHANT_UUID,
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'email_verified_at' => '2024-01-01 00:00:00',
        'password' => self::PASSWORD,
        'remember_token' => null,
        'role' => UserRoles::MERCHANT,
    ];
}