<?php

namespace App\Repositories\Contracts;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

interface MerchantRepositoryInterface extends RepositoryInterface, PaginateRepositoryInterface
{
    public function register(mixed $data): Model;
}