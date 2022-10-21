<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PartnerController extends Controller
{
    private PartnerService $partnerService;

    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->partnerService->getAllPartners();
    }

    public function store(PartnerRequest $request): PartnerResource
    {
        return $this->partnerService->storePartner($request->validated());
    }

    public function show(Partner $partner): PartnerResource
    {
        return $this->partnerService->getPartner($partner);
    }

    public function update(PartnerRequest $request, Partner $partner): PartnerResource
    {
        return $this->partnerService->updatePartner($request->validated(), $partner);
    }

    public function destroy(Partner $partner): Response
    {
        return $this->partnerService->deletePartner($partner);

    }
}
