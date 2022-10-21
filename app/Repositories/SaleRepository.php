<?php

namespace App\Repositories;

use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Repositories\Interfaces\RepositoryCrudInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SaleRepository implements RepositoryCrudInterface
{
    public function all(): AnonymousResourceCollection
    {
        return SaleResource::collection(
            Sale::with('partner', 'warehouse')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function add($data): SaleResource
    {
        $warehouseItems = [];

        $sale = new Sale();
        $sale->partner_id = $data->get('partner');
        $sale->total_price = $data->get('total');
        $sale->save();

        $saleItems = $data->get('items');
        foreach ($saleItems as $item) {
            $warehouseItems[] = $item['id'];
        }
        $sale->warehouse()->attach($warehouseItems);

        return new SaleResource($sale);
    }

    public function delete($model): Response
    {
        $model->delete();
        return response()->noContent();
    }

    public function show($model): SaleResource
    {
        return new SaleResource($model->load('warehouse', 'partner'));
    }
}
