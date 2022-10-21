<?php

namespace App\Repositories;

use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Repositories\Interfaces\RepositoryCrudInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PartnerRepository implements RepositoryCrudInterface
{
    public function all(): AnonymousResourceCollection
    {
        return PartnerResource::collection(
            Partner::with('sale')
                ->get()
        );
    }

    public function add($data): PartnerResource
    {
        $partner = Partner::create($data);
        return new PartnerResource($partner);
    }

    public function update($data, Model $model): PartnerResource
    {
        $model->update($data);
        return new PartnerResource($model);
    }

    public function delete(Model $model): Response
    {
        $model->delete();
        return response()->noContent();
    }

    public function show(Model $model): PartnerResource
    {
        return new PartnerResource($model);
    }
}
