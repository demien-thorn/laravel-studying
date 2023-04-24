<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscribtionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    /**
     * @param ProductsFilterRequest $request
     * @return Application|Factory|View
     */
    public function index(ProductsFilterRequest $request): View|Factory|Application
    {
        $skusQuery = Sku::with(relations: ['product', 'product.category']);

        if ($request->filled(key: 'price_from')) {
            $skusQuery->where(column: 'price', operator: '>=', value: $request->price_from);
        }

        if ($request->filled(key: 'price_to')) {
            $skusQuery->where(column: 'price', operator: '<=', value: $request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has(key: $field)) {
                $skusQuery->whereHas(relation: 'product', callback: function ($query) use ($field) {
                    $query->$field();
                });
            }
        }

        $skus = $skusQuery->paginate(perPage: 6)->withPath("?".$request->getQueryString());

        return view(view: 'index', data: compact(var_name: 'skus'));
    }

    /**
     * @return Application|Factory|View
     */
    public function categories(): View|Factory|Application
    {
        return view(view: 'categories');
    }

    /**
     * @param $code
     * @return Application|Factory|View
     */
    public function category($code = null): View|Factory|Application
    {
        $category = Category::where('code', $code)->first();
        return view(view: 'category', data: compact(var_name: 'category'));
    }

    /**
     * @param $categoryCode
     * @param $productCode
     * @param Sku $skus
     * @return Application|Factory|View
     */
    public function sku($categoryCode, $productCode, Sku $skus): View|Factory|Application
    {
        if ($skus->product->code != $productCode) {
            abort(code: 404, message: 'Product not found');
        }
        if ($skus->product->category->code != $categoryCode) {
            abort(code: 404, message: 'Category not found');
        }

        return view(view: 'product', data: compact(var_name: 'skus'));
    }

    /**
     * @param SubscribtionRequest $request
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function subscribe(SubscribtionRequest $request, Sku $skus): RedirectResponse
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $skus->id,
        ]);

        return redirect()->back()->with(key: 'success', value: 'Thank you! We\'ll inform you');
    }

    /**
     * @param $locale
     * @return RedirectResponse
     */
    public function changeLocale($locale): RedirectResponse
    {
        $availableLocales = ['en', 'ru'];
        if (!in_array(needle: $locale, haystack: $availableLocales)) {
            $locale = config(key: 'app.locale');
        }
        session(key: ['locale' => $locale]);
        App::setLocale(locale: $locale);
        return redirect()->back();
    }

    /**
     * @param $currencyCode
     * @return RedirectResponse
     */
    public function changeCurrency($currencyCode): RedirectResponse
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(key: ['currency' => $currency->code]);
        return redirect()->back();
    }
}
