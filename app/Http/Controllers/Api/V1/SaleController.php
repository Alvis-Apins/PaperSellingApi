<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Partner;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Services\SaleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SaleController extends Controller
{

    private SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->saleService->getAllSales();
    }

    public function store(SaleRequest $request): SaleResource
    {
        $warehouseItems = [];

        $sale = new Sale();
        $sale->partner_id = $request->get('partner');
        $sale->total_price = $request->get('total');
        $sale->save();

        $saleItems = $request->get('items');
        foreach ($saleItems as $item) {
            $warehouseItems[] = $item['id'];
        }
        $sale->warehouse()->attach($warehouseItems);

        return new SaleResource($sale);
    }

    public function show(Sale $sale): SaleResource
    {
        return $this->saleService->getSale($sale);
    }

    public function destroy(Sale $sale): Response
    {
        return $this->saleService->deleteSale($sale);
    }
}
