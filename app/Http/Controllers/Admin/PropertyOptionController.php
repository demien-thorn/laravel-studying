<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;
use Illuminate\Http\RedirectResponse;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Property $property
     * @return Application|Factory|View
     */
    public function index(Property $property): Application|View|Factory
    {
        $propertyOptions = PropertyOption::where('property_id', $property->id)->paginate(10);
        return view(view: 'auth.property_options.index', data: compact('propertyOptions', 'property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Property $property
     * @return Factory|Application|View
     */
    public function create(Property $property): View|Application|Factory
    {
        return view(view: 'auth.property_options.form', data: compact(var_name: 'property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyOptionRequest $request
     * @param Property $property
     * @return RedirectResponse
     */
    public function store(PropertyOptionRequest $request, Property $property): RedirectResponse
    {
        $params = $request->all();
        $params['property_id'] = $request->property->id;
        PropertyOption::create($params);
        return redirect()->route(route: 'property-options.index', parameters: $property);
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return Factory|Application|View
     */
    public function show(Property $property, PropertyOption $propertyOption): View|Application|Factory
    {
        return view(view: 'auth.property_options.show', data: compact(var_name: 'propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return Factory|Application|View
     */
    public function edit(Property $property, PropertyOption $propertyOption): View|Application|Factory
    {
        return view(view: 'auth.property_options.form', data: compact('property', 'propertyOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyOptionRequest $request
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return RedirectResponse
     */
    public function update(
        PropertyOptionRequest $request,
        Property $property,
        PropertyOption $propertyOption): RedirectResponse
    {
        $params = $request->all();
        $propertyOption->update(attributes: $params);
        return redirect()->route(route: 'property-options.index', parameters: $property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return RedirectResponse
     */
    public function destroy(Property $property, PropertyOption $propertyOption): RedirectResponse
    {
        $propertyOption->delete();
        return redirect()->route(route: 'property-options.index', parameters: $property);
    }
}
