<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Api\ServiceController;
use App\Http\Requests\Merchant\GetMerchantRequest;
use App\Services\Merchant\GetMerchantService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMerchantController extends ServiceController
{
    protected const string SERVICE_CLASS = GetMerchantService::class;

    /**
     * Handle the incoming request.
     */
    public function __invoke(GetMerchantRequest $request): Paginator
    {
        return parent::handle($request);
    }
}
