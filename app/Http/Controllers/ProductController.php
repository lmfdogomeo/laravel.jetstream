<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(protected readonly ProductRepositoryInterface $repository)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $size = $request->size ?? 5;

        $products = $this->repository->paginate($size, ['merchant_id' => $request->merchant_id]);

        return Inertia::render('Product', [
            'table' => $products,
            'merchant_id' => $request->merchant_uuid
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->repository->create($request->parameters());

        if ($product->save()) {

            return redirect()->back()
                ->with('code', '200')
                ->with('status', 'success')
                ->with('message', 'Product submitted successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $merchant_id, string $uuid)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $merchant_id, string $uuid)
    {

        $product = $this->repository->update($uuid, $request->parameters(), ['uuid' => $uuid, 'merchant_id' => $request->merchant_id]);

        if (!$product) {
            throw new Exception("Unable to update data" .  $request->merchant_id, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return redirect()->back()
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', "Product updated successfully!");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $merchant_id, string $uuid)
    {

        $this->repository->delete($uuid, [
            "uuid" => $uuid,
            "merchant_id" => $request->merchant_id
        ]);

        return redirect()->back()
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', "Product deleted successfully!");
        
    }
}
