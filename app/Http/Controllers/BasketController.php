<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Sku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view(view: 'basket', data: compact(var_name: 'order'));
    }

    public function basketConfirm(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ((new Basket())->saveOrder(name: $request->name, phone: $request->phone, email: $email)) {
            session()->flash(key: 'success', value: __(key:'basket.order_processed'));
        } else {
            session()->flash(key: 'warning', value: __(key: 'main.notes.unavailable'));
        }

        return redirect()->route(route: 'index');
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash(key: 'warning', value: __(key: 'main.notes.unavailable'));
            return redirect()->route(route: 'basket');
        }
        return view(view: 'order', data: compact(var_name: 'order'));
    }

    /**
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function basketAdd(Sku $skus)
    {
        $result = (new Basket(createOrder: true))->addSku(sku: $skus);
        if ($result) {
            session()->flash(
                key: 'success',
                value: __(key: 'main.notes.add').': "'.$skus->product->__('name').'"');
        } else {
            session()->flash(
                key: 'warning',
                value: __(key: 'main.notes.order').' "'.$skus->product->__('name').'" '.__(key: 'main.notes.amount'));
        }

        return redirect()->route(route: 'basket');
    }

    /**
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function basketRemove(Sku $skus)
    {
        (new Basket())->removeSku(sku: $skus);
        session()->flash(key: 'warning', value: __(key: 'main.notes.removed').': "'.$skus->product->__('name').'"');
        return redirect()->route(route: 'basket');
    }
}
