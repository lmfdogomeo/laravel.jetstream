<?php 


namespace App\Repositories;

use App\Models\Merchant;
use App\Repositories\Contracts\MerchantRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MerchantRepository implements MerchantRepositoryInterface
{
    public function query(): Builder
    {
        return Merchant::query();
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

    public function findByUuid(string $uuid, array $relationships = [], array $withCounts = []): Model
    {
        return $this->query()->with($relationships)->withCount(['products'])->where("uuid", $uuid)->firstOrFail();
        // return $this->query()->withCount($withCounts)->where("uuid", $uuid)->firstOrFail();
    }

    public function update(string|int $id, array $data, array $filters = []): bool
    {   
        if (is_int($id)) {
            $model = $this->find($id);
        }
        else {
            $model = $this->findByUuid($id);
        }

        return $model->update($data);
    }

    public function paginate(int $size, array $filters = []): Paginator
    {
        return $this->query()
            ->paginate($size);
    }

    public function delete($id): Model
	{
		if (is_int($id)) {
            $model = $this->find($id);
        }
        else {
            $model = $this->findByUuid($id);
        }

		$model->delete();

		return $model;
    }
}