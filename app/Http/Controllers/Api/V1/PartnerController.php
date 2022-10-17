<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PartnerController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return PartnerResource::collection(Partner::all());
    }

    public function store(PartnerRequest $request): PartnerResource
    {
        $partner = Partner::create($request->validated());
        return new PartnerResource($partner);
    }

    public function show(Partner $partner): PartnerResource
    {
        return new PartnerResource($partner);
    }

    public function update(PartnerRequest $request, Partner $partner): PartnerResource
    {
        $partner->update($request->validated());
        return new PartnerResource($partner);
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return response()->noContent();
    }
}
