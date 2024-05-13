<?php


namespace App\Repositories;

use App\Models\Merchant;
use App\Models\MerchantUser;
use App\Models\User;
use App\Repositories\Contracts\MerchantRepositoryInterface;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function register(mixed $data): Model
    {
        DB::beginTransaction();
        try {
            $user = User::where("email", $data['email'])->first();

            if ($user) {
                $user->name = $data['name'];

                if (!empty($data['password'])) {
                    $user->password = $data['password'];
                }
                
                $user->save();

                $merchantUser = $user->merchantUser;
            }
            else {
                $user = User::create($data);

                $merchantUser = MerchantUser::create([
                    'user_id' => $user->id,
                    'merchant_id' => $data['merchant_id']
                ]);
            }

            DB::commit();

            return $merchantUser;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        } 
    }
}
