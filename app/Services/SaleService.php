<?php

namespace App\Services;

use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SaleService
{
    private SaleRepository $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getAllSales(): AnonymousResourceCollection
    {
        return $this->saleRepository->all();
    }

    public function getSale(Sale $sale): SaleResource
    {
        return $this->saleRepository->show($sale);
    }

    public function storeSale($data): SaleResource
    {
        return $this->saleRepository->add($data);
    }

    public function deleteSale(Sale $sale): Response
    {
        return $this->saleRepository->delete($sale);
    }
}
