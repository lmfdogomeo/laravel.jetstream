<?php

namespace Tests\Unit\Repository\Merchant;

use App\Models\Merchant;
use App\Repositories\Contracts\MerchantRepositoryInterface;
use Tests\Factory\MerchantFactory;
use Tests\TestCase;

class MerchantRepositoryTest extends TestCase
{
    private const MERCHANT_TEST_DATA = MerchantFactory::TEST_MERCHANT_DATA;
    private MerchantRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(MerchantRepositoryInterface::class);
    }

    public function test_create_merchant_repository(): void
    {
        $merchant = $this->repository->create(self::MERCHANT_TEST_DATA);

        $this->assertDatabaseHas('merchants', self::MERCHANT_TEST_DATA);
        $this->assertInstanceOf(Merchant::class, $merchant);
        $this->assertEquals(self::MERCHANT_TEST_DATA['company_tax_id'], $merchant->company_tax_id);
    }

    public function test_update_merchant_repository(): void
    {   
        $merchant = $this->repository->create(self::MERCHANT_TEST_DATA);
        
        $this->repository->update($merchant->uuid, self::MERCHANT_TEST_DATA);

        $this->assertDatabaseHas('merchants', self::MERCHANT_TEST_DATA);
        $this->assertInstanceOf(Merchant::class, $merchant);
        $this->assertEquals(self::MERCHANT_TEST_DATA['company_tax_id'], $merchant->company_tax_id);
    }
}
