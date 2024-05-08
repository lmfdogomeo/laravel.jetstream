<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Api\ServiceController;
use App\Http\Requests\Merchant\CreateMerchantRequest;
use App\Http\Resources\MerchantResource;
use App\Services\ApiResponser\Facades\ApiResponser;
use App\Services\Merchant\CreateMerchantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class CreateMerchantController extends ServiceController
{
    protected const string SERVICE_CLASS = CreateMerchantService::class;
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateMerchantRequest $request): JsonResource | JsonResponse
    {
        return ApiResponser::successWithResource(MerchantResource::class, parent::handle($request), "Merchant create successfully", Response::HTTP_CREATED);
    }
}
