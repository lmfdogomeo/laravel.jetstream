<?php 

namespace Tests\Factory;

abstract class MerchantFactory
{
    public const DEFAULT_MERCHANT_UUID = '59a0af5e-405a-3b26-a7b1-dd30156431c7';

    public const TEST_MERCHANT_DATA = [
        // 'uuid' => self::DEFAULT_MERCHANT_UUID,
        "company_name" => "Company Test",
        "company_tax_id" => "TEST-1000-003",
        "contact_number" => "09574623688",
        "address" => "Test Address"
    ];
    
}