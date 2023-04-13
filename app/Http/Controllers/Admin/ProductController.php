<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $products = Product::paginate(5);
        return view(view: 'auth.products.index', data: compact(var_name: 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::get();
        $properties = Property::get();
        return view(view: 'auth.products.form', data: compact('categories', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has(key: 'image')) {
            $params['image'] = $request->file(key: 'image')->store(path: 'products');
        }

        Product::create($params);
        return redirect()->route(route: 'products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return Application|Factory|View
     */
    public function show(Product $product): View|Factory|Application
    {
        return view(view: 'auth.products.show', data: compact(var_name: 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::get();
        $properties = Property::get();
        return view(view: 'auth.products.form', data: compact('product', 'categories', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has(key: 'image')) {
            Storage::delete(paths: $product->image);
            $params['image'] = $request->file(key: 'image')->store(path: 'products');
        }

        foreach (['new', 'hit', 'recommend'] as $fieldName) {
            if (!isset($params[$fieldName])) {
                $params[$fieldName] = 0;
            }
        }

        $product->properties()->sync(ids: $request->property_id);

        $product->update(attributes: $params);
        return redirect()->route(route: 'products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route(route: 'products.index');
    }
}
