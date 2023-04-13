<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|View|Factory
    {
        $properties = Property::paginate(10);
        return view(view: 'auth.properties.index', data: compact(var_name: 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|View
     */
    public function create(): View|Application|Factory
    {
        return view(view: 'auth.properties.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyRequest  $request
     * @return RedirectResponse
     */
    public function store(PropertyRequest $request): RedirectResponse
    {
        Property::create($request->all());
        return redirect()->route(route: 'properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Property  $property
     * @return Factory|Application|View
     */
    public function show(Property $property): View|Application|Factory
    {
        return view(view: 'auth.properties.show', data: compact(var_name: 'property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Property  $property
     * @return Factory|Application|View
     */
    public function edit(Property $property): View|Application|Factory
    {
        return view(view: 'auth.properties.form', data: compact(var_name: 'property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PropertyRequest  $request
     * @param  Property  $property
     * @return RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property): RedirectResponse
    {
        $property->update(attributes: $request->all());
        return redirect()->route(route: 'properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Property  $property
     * @return RedirectResponse
     */
    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();
        return redirect()->route(route: 'properties.index');
    }
}
