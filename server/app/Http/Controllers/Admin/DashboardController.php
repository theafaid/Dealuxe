<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrderIndexService;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    protected $orderIndexService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderIndexService $orderIndexService)
    {
        $this->middleware('auth:admin');
        $this->orderIndexService = $orderIndexService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = $this->orderIndexService->latest();

        return view('dashboard', compact('orders'));
    }

    /**
     * @param $mode
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setDashboardThemeMode($mode) {
        return response([], 200)->cookie(
            'theme-mode', $mode, 1440
        );
    }

    /**
     * @param $color
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function setDashboardLayoutColor($color) {
        return response([], 200)->cookie(
            'layout-color', $color, 1440
        );
    }
}
