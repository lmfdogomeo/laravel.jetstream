<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\Paginator;

interface PaginateRepositoryInterface
{
    public function paginate(int $size, array $filters = []): Paginator;
} 