<?php

namespace App\Services\ApiResponser;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ApiResponser
{
    public function validationError(mixed $errors, string $message = null, int $customCode = Response::HTTP_UNPROCESSABLE_ENTITY, int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json([
            'errors' => $errors,
            'message' => $message ?? __('Invalid input.'),
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function throttled(string $message = null, int|null $availableInSeconds = null, int $customCode = Response::HTTP_TOO_MANY_REQUESTS, int $code = Response::HTTP_TOO_MANY_REQUESTS): JsonResponse
    {
        return response()->json(array_merge([
            'message' => $message ?? __('Too many attempts.'),
            'code' => $customCode
        ], isset($availableInSeconds) ? ['available_in_seconds' => $availableInSeconds] : []), $code);
    }

    public function notFound(string $message = null, int $customCode = Response::HTTP_NOT_FOUND, int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('Not found.'),
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function badRequest(string $message = null, int $customCode = Response::HTTP_BAD_REQUEST, int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('Bad request.'),
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function forbidden(string $message = null, int $customCode = Response::HTTP_FORBIDDEN, int $code = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('This action is forbidden.'),
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function unauthenticated(string $message = null, int $customCode = Response::HTTP_UNAUTHORIZED, int $code = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('Unauthenticated'),
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function failed(string $message, int $customCode = Response::HTTP_INTERNAL_SERVER_ERROR, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => $customCode,
            'success' => false
        ], $code);
    }

    public function success(string $message = null, array $data = [], int $customCode = Response::HTTP_OK, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('Success.'),
            'data' => $data,
            'code' => $customCode,
            'success' => true
        ], $code);
    }

    public function successWithResource(string $resource, mixed $data, string $message = null, int $customCode = Response::HTTP_OK, array $additional = []): JsonResource
    {
        return (new $resource($data))->additional(
            array_merge($additional, [
            'message' => $message ?? __('Success.'),
            'code' => $customCode,
            'success' => true
        ]));
    }

    public function successWithResourceCollection(string $resource, mixed $data, string $message = null, int $customCode = Response::HTTP_OK, array $additional = []): JsonResource
    {
        return $resource::collection($data)->additional(array_merge($additional, [
            'message' => $message ?? __('Success.'),
            'code' => $customCode,
            'success' => true
        ]));
    }
}