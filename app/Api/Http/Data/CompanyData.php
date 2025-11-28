<?php

namespace App\Api\Http\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class CompanyData extends AbstractApiData
{
    public function __construct(
        public int                     $id,
        public string                  $name,
        public string                  $industry,
        public ?ProfileData            $profile = null,
        /** @var EmployeeData[] */
        public ?array                  $employees = null,
        #[DataCollectionOf(CandidateData::class)]
        public Optional|DataCollection $candidates,
    )
    {
    }
}
