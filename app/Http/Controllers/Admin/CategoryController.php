<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $categories = Category::paginate(3);
        return view(view: 'auth.categories.index', data: compact(var_name: 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view(view: 'auth.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has(key: 'image')) {
            $path = $request->file(key: 'image')->store(path: 'categories');
            $params['image'] = $path;
        }

        Category::create($params);
        return redirect()->route(route: 'categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return Application|Factory|View
     */
    public function show(Category $category): View|Factory|Application
    {
        return view(view: 'auth.categories.show', data: compact(var_name: 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view(view: 'auth.categories.form', data: compact(var_name: 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has(key: 'image')) {
            Storage::delete(paths: $category->image);
            $path = $request->file(key: 'image')->store(path: 'categories');
            $params['image'] = $path;
        }

        $category->update(attributes: $params);
        return redirect()->route(route: 'categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route(route: 'categories.index');
    }
}
