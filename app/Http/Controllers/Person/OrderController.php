<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
    public function index(): Renderable
    {
        $orders = Auth::user()->orders()->active()->paginate(5);
        return view(view: 'auth.orders.index', data: compact(var_name: 'orders'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Order $order): View|Factory|RedirectResponse|Application
    {
        if (!Auth::user()->orders->contains($order)) {
            return back();
        }

        return view(view: 'auth.orders.show', data: compact(var_name: 'order'));
    }
}
