<?php

namespace App\Api\Http\Data;

class ProfileData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public int $companyId,
        public ?string $description,
        public ?string $website,
        public ?CompanyData $company = null,
    ) {
    }
}
