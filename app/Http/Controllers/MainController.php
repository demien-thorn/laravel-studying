<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscribtionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Subscription;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\NoReturn;

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
        return view(view: 'categories');
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

    public function subscribe(SubscribtionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with(key: 'success', value: 'Thank you! We\'ll inform you');
    }

    public function changeLocale($locale)
    {
        $availableLocales = ['en', 'ru'];
        if (!in_array(needle: $locale, haystack: $availableLocales)) {
            $locale = config(key: 'app.locale');
        }
        session(key: ['locale' => $locale]);
        App::setLocale(locale: $locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(key: ['currency' => $currency->code]);
        return redirect()->back();
    }
}
