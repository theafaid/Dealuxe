<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Services\Orders\OrderShowService;
use App\Services\Orders\OrderStoreService;
use App\Services\Orders\OrderIndexService;

class OrderController extends Controller
{
    protected $cart, $indexService, $storeService, $showService;

    /**
     * OrderController constructor.
     * @param OrderIndexService $indexService
     * @param OrderStoreService $storeService
     */
    public function __construct(
        OrderIndexService $indexService,
        OrderStoreService $storeService,
        OrderShowService $showService
    )
    {
        $this->middleware('cart.sync')->only('store');

        $this->indexService = $indexService;
        $this->storeService = $storeService;
        $this->showService  = $showService;
    }


    /**
     * Get a list of user orders
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders =  OrderResource::collection(
            $this->indexService->orders(auth()->user())
        );

        return $this->indexService->handle($orders, request()->wantsJson());
    }

    /**
     * Store an order for the authenticated user
     * @param OrderStoreRequest $request
     * @return OrderResource
     */
    public function store(OrderStoreRequest $request)
    {
        return response([
            'data' => new OrderResource(
                $this->storeService->handle($request->validated())
            )], 201
        );
    }

    /**
     * View a single order for admin
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order = (new OrderResource($order))->toResponse(
            $this->showService->handle($order)
        )->getData();

        return view('orders.show', [
            'order' =>  $order->data,
        ]);
    }

    /**
     * Update a specific order
     * @param Order $order
     * @param OrderUpdateRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Order $order, OrderUpdateRequest $request)
    {
        $order->update($request->validated());

        return response($order->load('user'), 200);
    }

    /**
     * Delete an order
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order){
        $order->delete();

        return response([], 204);
    }
}
