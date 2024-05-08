<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function query(): Builder;

    public function all(): Collection;

    public function find(string|int $id): Model;

    public function findByUuid(string $uuid, array $relationships, array $withCounts): Model;

    public function create(array $data): Model;

    public function update(string|int $id, array $data, array $filters = []): bool;

    public function delete(string|int $id): Model;

} 