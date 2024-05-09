<?php

namespace Tests\Feature\Merchant;

use App\Models\Merchant;
use App\Models\User;
use App\Repositories\Contracts\MerchantRepositoryInterface;
use Tests\Factory\MerchantFactory;
use Tests\Factory\UserFactory;
use Tests\TestCase;

class MerchantTest extends TestCase
{
    private const API_URL = "merchant.create";
    private const MERCHANT_DATA = MerchantFactory::TEST_MERCHANT_DATA;

    public function test_merchant_created_return_200(): void
    {
        $this->withoutExceptionHandling();

        $user = User::firstOrCreate(['email' => UserFactory::TEST_USER_ADMIN_DATA['email']], UserFactory::TEST_USER_ADMIN_DATA);

        $response = $this->actingAs($user)
            ->post(route("merchant.create"), self::MERCHANT_DATA);

        if($response->getStatusCode() == 302) {
            $response->assertStatus(302);
        } else {
            $response->assertStatus(200);
        }

        // $response->assertStatus([200, 302]);
        // $response->assertContains($response->getStatusCode(), array(200,302));
        // $response->assertJsonFragment(self::MERCHANT_DATA);
    }

    public function test_merchant_created_return_401(): void
    {
        $response = $this->postJson(route(self::API_URL), self::MERCHANT_DATA);

        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }
    
}
