<?php

namespace App\Api\Http\Data;

class CandidateData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?AddressData $address = null,
    ) {
    }
}
