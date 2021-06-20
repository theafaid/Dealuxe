<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodStoreRequest;
use App\Models\ShippingMethod;
use App\Services\ShippingMethods\ShippingMethodIndexService;
use App\Services\ShippingMethods\ShippingMethodStoreService;

class ShippingMethodsController extends Controller
{
    protected $indexService, $storeService;
    public function __construct(ShippingMethodIndexService $indexService, ShippingMethodStoreService $storeService)
    {
        $this->indexService = $indexService;
        $this->storeService = $storeService;
    }

    /**
     * List all shipping methods
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('shipping-methods.index', [
            'shippingMethods' => $this->indexService->handle()
        ]);
    }

    /**
     * @param ShippingMethodStoreRequest $request
     * @return mixed
     */
    public function store(ShippingMethodStoreRequest $request)
    {
        return $this->storeService->handle($request->validated());
    }

    /**
     * Delete a shipping method
     * @param ShippingMethod $shippingMethod
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();

        return response([], 204);
    }
}
