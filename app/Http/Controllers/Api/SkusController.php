<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sku;
use Illuminate\Http\JsonResponse;

class SkusController extends Controller
{

    /**
     * When created, we need to register it in api.php as a functioning route.
     * After registering, the assigned routes will open with using "/api" before the routing method.
     *
     * @return JsonResponse - returns our skus in JSon format
     */
    public function getSkus(): JsonResponse
    {
        return Sku::with(relations: 'product')
            ->available()
            ->get()
            ->append('product_name');
    }
}
