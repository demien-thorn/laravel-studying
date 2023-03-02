<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session(key: 'orderId');
        if (!is_null(value: $orderId)) {
            $order = Order::findOrFail($orderId);
        }
//        if (isset($order)) {
//            return view(view: 'basket', data: compact(var_name: 'order'));
//        } else {
//            return view(view: 'basket');
//        }
        return view(view: 'basket', data: compact(var_name: 'order'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session(key: 'orderId');
        if (is_null(value: $orderId)) {
            return redirect()->route(route: 'index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash(key: 'success', value: 'Ваш заказ принят в обработку');
        } else {
            session()->flash(key: 'warning',
                value: 'Случилась ошибка'
            );
        }

        Order::eraseOrderSum();

        return redirect()->route(route: 'index');
    }

    public function basketPlace()
    {
        $orderId = session(key: 'orderId');
        if (is_null(value: $orderId)) {
            return redirect()->route(route: 'index');
        }
        $order = Order::find($orderId);
        return view(view: 'order', data: compact(var_name: 'order'));
    }

    public function basketAdd($productId)
    {
        $orderId = session(key: 'orderId');
        if (is_null(value: $orderId)) {
            $order = Order::create();
            session(key: ['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($productId);

        Order::changeFullSum(changeSum: $product->price);

        session()->flash(key: 'success', value: 'Добавлен товар: '.$product->name);

        return redirect()->route(route: 'basket');
    }

    public function basketRemove($productId)
    {
        $orderId = session(key: 'orderId');
        if (is_null(value: $orderId)) {
            return redirect()->route(route: 'basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Product::find($productId);

        Order::changeFullSum(changeSum: -$product->price);

        session()->flash(key: 'warning', value: 'Удалён товар: '.$product->name);

        return redirect()->route(route: 'basket');
    }
}
