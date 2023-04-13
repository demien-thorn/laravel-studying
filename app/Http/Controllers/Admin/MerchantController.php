<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     * Gets all merchants from DB and put it into variable
     * which is used further as data when showing us merchants.
     * We use paginate to show only 10 merchants per page.
     *
     * @return Application|Factory|View - returns view "index"
     */
    public function index(): View|Factory|Application
    {
        $merchants = Merchant::paginate(10);
        return view(view: 'auth.merchants.index', data: compact(var_name: 'merchants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View - returns view "form"
     */
    public function create(): View|Factory|Application
    {
        return view(view: 'auth.merchants.form');
    }

    /**
     * Store a newly created resource in storage.
     * Gets all data from the form (via Request) and creates a new record in DB.
     * Then redirect to the main merchant page.
     *
     * @param Request $request - gets all data from the form
     * @return RedirectResponse - redirects to the main merchant page
     */
    public function store(Request $request): RedirectResponse
    {
        Merchant::create($request->all());
        return redirect()->route(route: 'merchants.index');
    }

    /**
     * Display the specified resource.
     * Gets from the argument the specific merchant from DB we need to take a look at.
     *
     * @param Merchant $merchant - gets the specific merchant from DB we need to take a look at
     * @return Application|Factory|View - returns view "show"
     */
    public function show(Merchant $merchant): View|Factory|Application
    {
        return view(view: 'auth.merchants.show', data: compact(var_name: 'merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     * Gets from the argument the specific merchant we need to edit.
     *
     * @param Merchant $merchant - gets the specific merchant from DB we need to edit
     * @return Application|Factory|View - returns view "form"
     */
    public function edit(Merchant $merchant): View|Factory|Application
    {
        return view(view: 'auth.merchants.form', data: compact(var_name: 'merchant'));
    }

    /**
     * Update the specified resource in storage.
     * Gets from the argument the specific merchant we need to update
     * with the data we get from the first argument (Request).
     *
     * @param Request $request - gets all data from the form
     * @param Merchant $merchant - gets the specific merchant from DB we need to update
     * @return RedirectResponse - redirects to the main merchant page
     */
    public function update(Request $request, Merchant $merchant): RedirectResponse
    {
        $merchant->update(attributes: $request->all());
        return redirect()->route(route: 'merchants.index');
    }

    /**
     * Remove the specified resource from storage.
     * Gets from the argument the specific merchant we need to delete.
     *
     * @param Merchant $merchant - gets the specific merchant from DB we need to delete
     * @return RedirectResponse - redirects to the main merchant page
     */
    public function destroy(Merchant $merchant): RedirectResponse
    {
        $merchant->delete();
        return redirect()->route(route: 'merchants.index');
    }

    public function updateToken(Merchant $merchant): RedirectResponse
    {
        session()->flash(
            key: 'success',
            value: __(key: 'notes.for_merchant').' "'.
            $merchant->name.'" '.
            __(key: 'notes.token_updated'). ': ' .
            $merchant->createToken()
        );
        return redirect()->route(route: 'merchants.index');
    }
}
