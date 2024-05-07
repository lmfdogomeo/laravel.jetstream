<?php

namespace App\Services\ApiResponser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse validationError(mixed $errors, string $message = null, int $customCode, int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
 * @method static \Illuminate\Http\JsonResponse throttled(string $message = null, int|null $availableInSeconds = null, int $customCode, int $code = Response::HTTP_TOO_MANY_REQUESTS)
 * @method static \Illuminate\Http\JsonResponse notFound(string $message = null, int $customCode, int $code = Response::HTTP_NOT_FOUND)
 * @method static \Illuminate\Http\JsonResponse badRequest(string $message = null, int $customCode, int $code = Response::HTTP_BAD_REQUEST)
 * @method static \Illuminate\Http\JsonResponse forbidden(string $message = null, int $customCode, int $code = Response::HTTP_FORBIDDEN)
 * @method static \Illuminate\Http\JsonResponse unauthenticated(string $message = null, int $customCode, int $code = Response::HTTP_UNAUTHORIZED)
 * @method static \Illuminate\Http\JsonResponse failed(string $message, int $customCode, int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
 * @method static \Illuminate\Http\JsonResponse success(string $message = null, array $data = [], int $customCode, int $code = Response::HTTP_OK)
 * @method static \Illuminate\Http\Resources\Json\JsonResource successWithResource(string $resource, mixed $data, string $message = null, int $customCode, array $additional = [])
 * @method static \Illuminate\Http\Resources\Json\JsonResource successWithResourceCollection(string $resource, mixed $data, string $message = null, int $customCode, array $additional = [])
 *
 * @see \App\Services\ApiResponser\ApiResponser
 */
class ApiResponser extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'api-responser';
	}
}