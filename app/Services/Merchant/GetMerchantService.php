<?php

namespace App\Services\Merchant;

use App\Http\Requests\Contracts\RequestContract;
use App\Http\Resources\MerchantResource;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMerchantService extends BaseMerchantService 
{
    public function __invoke(RequestContract $request): Paginator
    {
        $merchant = $this->repository->paginate($request->size ?? 5);

        return $merchant;
    }
}