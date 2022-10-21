<?php

namespace App\Services;

use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use App\Repositories\PartnerRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PartnerService
{

    private PartnerRepository $partnerRepository;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function getAllPartners(): AnonymousResourceCollection
    {
        return $this->partnerRepository->all();
    }

    public function getPartner(Partner $partner): PartnerResource
    {
        return $this->partnerRepository->show($partner);
    }

    public function storePartner($data): PartnerResource
    {
        return $this->partnerRepository->add($data);
    }

    public function updatePartner($data, Partner $partner): PartnerResource
    {
        return $this->partnerRepository->update($data, $partner);
    }

    public function deletePartner(Partner $partner): Response
    {
        return $this->partnerRepository->delete($partner);
    }

}
