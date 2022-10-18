<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SaleController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return SaleResource::collection(Sale::all());
    }

    public function store(SaleRequest $request): SaleResource
    {
        $sale = Sale::create($request->validated());
        return new SaleResource($sale);
    }

    public function show(Sale $sale): SaleResource
    {
        return new SaleResource($sale);
    }

    public function update(SaleRequest $request, Sale $sale): SaleResource
    {
        $sale->update($request->validated());
        return new SaleResource($sale);
    }

    public function destroy(Sale $sale): Response
    {
        $sale->delete();
        return response()->noContent();
    }
}
