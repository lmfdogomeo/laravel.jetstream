<?php 


namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    public function query(): Builder
    {
        return Product::query();
    }

    public function all(): Collection
    {
        return $this->query()->get();
    }

    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    public function find(string|int $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    public function findByUuid(string $uuid, array $relationships = [], array $withCounts = [], int $merchantId = 0): Model
    {
        return $this->query()->where("uuid", $uuid)->when($merchantId > 0, function ($query) use($merchantId) {
            $query->andWhere('merchant_id', $merchantId);
        })->firstOrFail();
    }

    public function update(string|int $id, array $data, array $filters = []): bool
    {   
        if (is_int($id)) {
            $model = $this->find($id);
        }
        else {
            $model = $this->findByUuid($id);
        }

        if (!empty($filters)) {
            $model = $this->query()->where($filters);
        }

        return $model->update($data);
    }

    public function paginate(int $size, array $filters = []): Paginator
    {
        return $this->query()
            ->when(!empty($filters), function($query) use ($filters) {
                $query->where($filters);
            })
            ->paginate($size);
    }

    public function delete($id, array $filters = []): Model
	{
		if (is_int($id)) {
            $model = $this->find($id);
        }
        else {
            $model = $this->findByUuid($id);
        }

        if (!empty($filters)) {
            $model = $this->query()->where($filters)->firstOrFail();
        }

		$model->delete();

		return $model;
    }
}