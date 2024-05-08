<?php

namespace App\Services\Merchant;

use App\Http\Requests\Contracts\RequestContract;
use App\Http\Resources\MerchantResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateMerchantService extends BaseMerchantService 
{
    public function __invoke(RequestContract $request): JsonResource | JsonResponse
    {
        $merchant = $this->repository->create($request->parameters());
        $merchant->refresh();

        return new MerchantResource($merchant);
    }
}