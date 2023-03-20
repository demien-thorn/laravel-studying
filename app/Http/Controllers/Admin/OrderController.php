<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(middleware: 'auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $orders = Order::active()->paginate(10);
        return view(view: 'auth.orders.index', data: compact(var_name: 'orders'));
    }

    public function show(Order $order)
    {
        $skus = $order->skus()->withTrashed()->get();
        return view(view: 'auth.orders.show', data: compact('order', 'skus'));
    }
}
