<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
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
        if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash(key: 'success', value: __(key:'basket.order_processed'));
        } else {
            session()->flash(key: 'warning', value: 'Products are unavailable to order in this amount');
        }

        Order::eraseOrderSum();

        return redirect()->route(route: 'index');
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash(key: 'warning', value: 'Products are unavailable to order in this amount');
            return redirect()->route(route: 'basket');
        }
        return view(view: 'order', data: compact(var_name: 'order'));
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(createOrder: true))->addProduct($product);
        if ($result) {
            session()->flash(key: 'success', value: 'Product added: "'.$product->name.'"');
        } else {
            session()->flash(key: 'warning', value: 'You can\'t order " '.$product->name.'" in this amount');
        }

        return redirect()->route(route: 'basket');
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);
        session()->flash(key: 'warning', value: 'Product removed: '.$product->name);
        return redirect()->route(route: 'basket');
    }
}
