<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
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
        return $this->saleService->storeSale($request);
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
