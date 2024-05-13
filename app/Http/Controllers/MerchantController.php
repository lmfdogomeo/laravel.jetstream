<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\Merchant\MerchantRequest;
use App\Http\Requests\Merchant\MerchantUserRequest;
use App\Repositories\Contracts\MerchantRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class MerchantController extends Controller
{
    public function __construct(protected readonly MerchantRepositoryInterface $repository)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $size = $request->size ?? 5;

        $merchants = $this->repository->paginate($size);

        return Inertia::render("Merchant", [
            'table' => $merchants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MerchantRequest $request)
    {

        $this->repository->create($request->parameters());

        return redirect()->back()
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', 'Form submitted successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $merchant = $this->repository->findByUuid($uuid, ['merchantUser', 'merchantUser.user'], ['products']);

        if ($merchant) {
            return Inertia::render("MerchantInfo", [
                'merchant' => $merchant
            ]);
        }

        return abort(404);

        // throw new Exception("No record found", Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MerchantRequest $request, string $uuid)
    {

        $merchant = $this->repository->update($uuid, $request->parameters());

        if (!$merchant) {
            throw new Exception("Unable to update data", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($merchant) {
            return redirect()->back()
                ->with('code', '200')
                ->with('status', 'success')
                ->with('message', "Merchant updated successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $this->repository->delete($uuid);

        return to_route("merchant.get")
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', "Merchant deleted successfully!");
    }

    /**
     * Register and link merchant to user account
     */
    public function register(MerchantUserRequest $request, string $uuid)
    {
        $merchant = $this->repository->findByUuid($uuid );

        $data = array_merge($request->parameters(), ['merchant_id' => $merchant->id, 'role' => UserRoles::MERCHANT]);

        $registered = $this->repository->register($data);

        return redirect()->back()
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', "Merchant account successfully saved!");
    }

    /**
     * Reset password merchant account
     */
    public function resetPassword(Request $request)
    {

        return redirect()->back()
            ->with('code', '200')
            ->with('status', 'success')
            ->with('message', "Merchant account password successfully reset!");
    }
}
