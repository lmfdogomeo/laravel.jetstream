<?php

namespace App\Services\Merchant;

use App\Repositories\Contracts\MerchantRepositoryInterface;
use App\Services\ServiceInterface;

abstract class BaseMerchantService implements ServiceInterface {
    public function __construct(protected readonly MerchantRepositoryInterface $repository)
    {
        
    }
}