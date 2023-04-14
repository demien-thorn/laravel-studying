<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\AddCouponRequest;
use App\Models\Coupon;
use App\Models\Sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function basket(): View|Factory|Application
    {
        $order = (new Basket())->getOrder();
        return view(view: 'basket', data: compact(var_name: 'order'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function basketConfirm(Request $request): RedirectResponse
    {
        $basket = new Basket();
        if ($basket->getOrder()->hasCoupon() && !$basket->getOrder()->coupon->availableForUse()) {
            $basket->clearCoupon();
            session()->flash(key: 'warning', value: __(key: 'notes.coupon_unavailable'));
            return redirect()->route(route: 'basket');
        }

        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ($basket->saveOrder(name: $request->name, phone: $request->phone, email: $email)) {
            session()->flash(key: 'success', value: __(key: 'notes.order_processed'));
        } else {
            session()->flash(key: 'warning', value: __(key: 'notes.unavailable'));
        }

        return redirect()->route(route: 'index');
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function basketPlace(): View|Factory|RedirectResponse|Application
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash(key: 'warning', value: __(key: 'notes.unavailable'));
            return redirect()->route(route: 'basket');
        }
        return view(view: 'order', data: compact(var_name: 'order'));
    }

    /**
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function basketAdd(Sku $skus): RedirectResponse
    {
        $result = (new Basket(createOrder: true))->addSku(sku: $skus);
        if ($result) {
            session()->flash(
                key: 'success',
                value: __(key: 'notes.add').': "'.$skus->product->__('name').'"');
        } else {
            session()->flash(
                key: 'warning',
                value: __(key: 'notes.order').' "'.$skus->product->__('name').'" '.__(key: 'notes.amount'));
        }

        return redirect()->route(route: 'basket');
    }

    /**
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function basketRemove(Sku $skus): RedirectResponse
    {
        (new Basket())->removeSku(sku: $skus);
        session()->flash(key: 'warning', value: __(key: 'notes.removed').': "'.$skus->product->__('name').'"');

        return redirect()->route(route: 'basket');
    }

    /**
     * Method gets the coupon searching it by the field "code" from request (getting first record).
     * When found - check whether the coupon is available ($coupon->availableForUse()):
     *     if it is - sets this coupon ((new Basket())->setCoupon(coupon: $coupon))
     *     with a notification that the specific coupon was added to an order;
     *
     *     if it's not - shows a notification that the specific coupon can't be added to an order.
     *
     * After all, in any case - redirect back to the basket.
     *
     * @param AddCouponRequest $request - gets info about the coupon added
     * @return RedirectResponse - redirects back to the basket
     */
    public function setCoupon(AddCouponRequest $request): RedirectResponse
    {
        $coupon = Coupon::where('code', $request->coupon)->first();
        if ($coupon->availableForUse()) {
            (new Basket())->setCoupon(coupon: $coupon);
            session()->flash(key: 'success', value: __(key: 'notes.coupon_added').': "'.$coupon->code.'"');
        } else {
            session()->flash(key: 'warning', value: __(key: 'notes.coupon_unavailable').': "'.$coupon->code.'"');
        }

        return redirect()->route(route: 'basket');
    }

    /**
     * This method checks whether an order has the coupon:
     *    if so - removes coupon from an order and shows a notification;
     *    if not - just shows a warning that coupon doesn't exist;
     * In any case - redirects back to the basket.
     *
     * @return RedirectResponse - redirects back to the basket
     */
    public function removeCoupon(): RedirectResponse
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if ($order->hasCoupon()) {
            $basket->removeCoupon();
            session()->flash(key: 'success', value: __(key: 'notes.coupon_removed'));
        } else {
            session()->flash(key: 'warning', value: __(key: 'notes.coupon_not_exist'));
        }
        return redirect()->route(route: 'basket');
    }
}
