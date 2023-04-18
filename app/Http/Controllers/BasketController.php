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
     * Method creates a new order adn shows us a basket view.
     *
     * @return Application|Factory|View - returns the basket view with data from $order variable
     */
    public function basket(): View|Factory|Application
    {
        $order = (new Basket())->getOrder();
        return view(view: 'basket', data: compact(var_name: 'order'));
    }

    /**
     * This method gets the Request datda from the form in its argument.
     *
     * We create a new Basket object and then check whether it has a coupon and is it available.
     * If for some reason it's not - we remove coupon, send a warning and redirect back to the basket.
     *
     * If everything is alright with coupon, we get an email.
     * If customers are authorized, we get it from their data; if not - they must indicate their email in the form.
     * If everything is right and the order was saved - send a notification.
     * If something went wrong - we send a warning.
     *
     * In any case - redirect back to the index page.
     *
     * @param Request $request - gets info from the form
     * @return RedirectResponse - redirects to the indicated page
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
     * In this method, we create a new Basket object and then put order data to the variable.
     * Then we check if customers can purchase the products in the indicated amount.
     * If they can't for some reason - send a warning and redirect back to the basket.
     * In any other case - redirect to the checkout page with order data (from the variable).
     *
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
     * This method gets the sku we want to add to the basket in its argument.
     * Then we call to a Basket's addSku() method (look at the method's describtion for more info).
     * If true - show the success notification; if false - show the warning.
     * In any case - redirect back to the basket.
     *
     * @param Sku $skus - sku we want to add
     * @return RedirectResponse - redirect back to the basket
     */
    public function basketAdd(Sku $skus): RedirectResponse
    {
        $result = (new Basket(createOrder: true))->addSku(sku: $skus);
        if ($result) {
            session()->flash(
                key: 'success',
                value: __(key: 'notes.add').': "'.$skus->product->__('name').'"'
            );
        } else {
            session()->flash(
                key: 'warning',
                value: __(key: 'notes.order').' "'.$skus->product->__('name').'" '.__(key: 'notes.amount')
            );
        }

        return redirect()->route(route: 'basket');
    }

    /**
     * This method gets the sku we want to remove in its argument.
     * Then a current Basket object calls its method removeSku() using an argument.
     * After that - redirects back to the basket with notification of the success removing.
     *
     * @param Sku $skus - sku we want to remove
     * @return RedirectResponse - redirects back to the basket
     */
    public function basketRemove(Sku $skus): RedirectResponse
    {
        (new Basket())->removeSku(sku: $skus);
        session()->flash(key: 'success', value: __(key: 'notes.removed').': "'.$skus->product->__('name').'"');

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
