<?php

namespace App\Api\Http\Data;

class CompanyData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $industry,
        public ?ProfileData $profile = null,
    ) {
    }
}
