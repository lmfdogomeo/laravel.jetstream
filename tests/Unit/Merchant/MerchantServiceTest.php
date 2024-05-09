<?php

namespace Tests\Unit\Merchant;

use App\Services\Merchant\CreateMerchantService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class MerchantServiceTest extends TestCase
{
    /**
     * This is a sample test case
     */
    public function test_map_merchant_product(): void
    {
        $service = App::make(CreateMerchantService::class);
        $merchant = $service->mapMerchantProduct();

        // $this->assertTrue(true);
        $this->assertEquals(200, $merchant['balance']);
    }
}
