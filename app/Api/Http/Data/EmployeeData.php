<?php

namespace App\Api\Http\Data;

class EmployeeData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $position,
        public ?ContractData $contract = null,
        public ?CompanyData $company = null,
    ) {
    }
}
