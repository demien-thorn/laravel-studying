<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * Gets coupons (Coupon::paginate(10)) and then returns them to index page.
     * Using paginate to show not all coupons at once, but just 10 per page.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view(view: 'auth.coupons.index', data: compact(var_name: 'coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * Returns a blade with form for creating a new coupon.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view(view: 'auth.coupons.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Creates (Coupon::create()) a new record in DB.
     * Record data is getting from the Request $request->all()
     * and goes into declared variable $params, which is used then in Coupon::create().
     *
     * In foreach() cycle we take the checkbox fields "type" and "only_once"
     * and giving them value "1" if they exist for the DB record.
     *
     * Also we check if the request has values in field "type;
     * if it's not - unsets the value from field "currency_id"
     *
     * @param CouponRequest $request - gets all the info from the form
     * @return RedirectResponse - redirects to the main coupon page
     */
    public function store(CouponRequest $request)
    {
        $params = $request->all();
        foreach (['type', 'only_once'] as $fieldName) {
            if (isset($params[$fieldName])) {
                $params[$fieldName] = 1;
            }
        }
        if (!$request->has(key: 'type')) {
            unset($params['currency_id']);
        }

        Coupon::create($params);
        return redirect()->route(route: 'coupons.index');
    }

    /**
     * Display the specified resource.
     * Returns the "auth.coupons.show" blade with data getting from the method's argument.
     *
     * @param Coupon $coupon - gets the record of the coupon from DB
     * @return Application|Factory|View
     */
    public function show(Coupon $coupon)
    {
        return view(view: 'auth.coupons.show', data: compact(var_name: 'coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     * Gets in the argument specific coupon we want to edit
     * and returns a blade with form for editing a new coupon.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function edit(Coupon $coupon)
    {
        return view(view: 'auth.coupons.form', data: compact(var_name: 'coupon'));
    }

    /**
     * Update the specified resource in storage.
     * Updates the record in DB for the coupon we get from method's argument.
     *
     * In foreach() cycle we take the checkbox fields "type" and "only_once"
     * and giving them value "1" if they exist for the DB record; if they're not - giving them value "0".
     *
     * Also we check if the request has values in field "type;
     * if it's not - sets the value for "currency_id" as null.
     *
     * @param CouponRequest $request - gets the info from the form when the coupon is edited
     * @param Coupon $coupon - gets the specific coupon we need to update
     * @return RedirectResponse - redirects to the main coupon page
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $params = $request->all();
        foreach (['type', 'only_once'] as $fieldName) {
            if (isset($params[$fieldName])) {
                $params[$fieldName] = 1;
            } else {
                $params[$fieldName] = 0;
            }
        }
        if (!$request->has(key: 'type')) {
            $params['currency_id'] = null;
        }

        $coupon->update(attributes: $params);
        return redirect()->route(route: 'coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     * Deletes the coupon we got from the method's argument from DB.
     *
     * @param Coupon $coupon - gets the coupon we need to delete
     * @return RedirectResponse - redirects to the main coupon page
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route(route: 'coupons.index');
    }
}
