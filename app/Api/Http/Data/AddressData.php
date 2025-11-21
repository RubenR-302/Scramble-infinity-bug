<?php

namespace App\Api\Http\Data;

class AddressData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public int $candidateId,
        public string $street,
        public string $city,
        public string $country,
        public ?CandidateData $candidate = null,
    ) {
    }
}
