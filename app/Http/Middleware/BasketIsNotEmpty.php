<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session(key: 'orderId');

        if (!is_null(value: $orderId) && Order::getFullSum() > 0) {
            return $next($request);
        }

        session()->flash(key: 'warning', value: 'Your basket is empty!');
        return redirect()->route(route: 'index');
    }
}
