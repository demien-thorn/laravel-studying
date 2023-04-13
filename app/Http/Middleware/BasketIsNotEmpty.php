<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $order = session(key: 'order');

        if (!is_null(value: $order) && $order->getFullSum() > 0) {
            return $next($request);
        }

        session()->forget(keys: 'order');
        session()->flash(key: 'warning', value: __(key: 'notes.basket_empty'));
        return redirect()->route(route: 'index');
    }
}
