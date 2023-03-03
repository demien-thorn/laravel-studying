<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
        $productsQuery = Product::with(relations: 'category');
        if ($request->filled(key: 'price_from')) {
            $productsQuery->where(column: 'price', operator: '>=', value: $request->price_from);
        }
        if ($request->filled(key: 'price_to')) {
            $productsQuery->where(column: 'price', operator: '<=', value: $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has(key: $field)) {
                $productsQuery->$field();
            }
        }

        $products = $productsQuery->paginate(perPage: 6)->withPath("?".$request->getQueryString());
        return view(view: 'index', data: compact(var_name: 'products'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view(view: 'categories', data: compact(var_name: 'categories'));
    }

    public function category($code = null)
    {
        $category = Category::where('code', $code)->first();
        return view(view: 'category', data: compact(var_name: 'category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view(view: 'product', data: compact(var_name: 'product'));
    }
}
