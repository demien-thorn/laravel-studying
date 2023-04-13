<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function index(Product $product): Factory|View|Application
    {
        $skus = $product->skus()->paginate(perPage: 10);
        return view(view: 'auth.skus.index', data: compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function create(Product $product): View|Factory|Application
    {
        return view(view: 'auth.skus.form', data: compact(var_name: 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(SkuRequest $request, Product $product): RedirectResponse
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route(route: 'skus.index', parameters: $product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param Sku $sku
     * @return Application|Factory|View
     */
    public function show(Product $product, Sku $sku): View|Factory|Application
    {
        return view(view: 'auth.skus.show', data: compact('product', 'sku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param Sku $sku
     * @return Application|Factory|View
     */
    public function edit(Product $product, Sku $sku): View|Factory|Application
    {
        return view(view: 'auth.skus.form', data: compact('product', 'sku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function update(SkuRequest $request, Product $product, Sku $sku): RedirectResponse
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku->update(attributes: $params);
        $sku->propertyOptions()->sync(ids: $request->property_id);
        return redirect()->route(route: 'skus.index', parameters: $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function destroy(Product $product, Sku $sku): RedirectResponse
    {
        $sku->delete();
        return redirect()->route(route: 'skus.index', parameters: $product);
    }
}
