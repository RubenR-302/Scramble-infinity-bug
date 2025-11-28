<?php

namespace App\Api\Http\Data;

class TimelineData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public int $projectId,
        public string $startDate,
        public string $endDate,
        public ?ProjectData $project = null,
    ) {
    }
}
