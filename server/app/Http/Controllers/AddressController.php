<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Resources\AddressResource;
use App\Http\Requests\AddressStoreRequest;
use App\Services\Addresses\AddressStoreService;

class AddressController extends Controller
{
    protected $service;
    /**
     * AddressController constructor.
     */
    public function __construct(AddressStoreService $service)
    {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    /**
     * Get list of all authenticated user addresses
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AddressResource::collection(auth()->user()->addresses()->latest()->get());
    }

    /**
     * Store a new address
     * @param AddressStoreRequest $request
     * @return AddressResource
     */
    public function store(AddressStoreRequest $request)
    {
        return new AddressResource(
            $this->service->handle($request->validated())
        );
    }
}
