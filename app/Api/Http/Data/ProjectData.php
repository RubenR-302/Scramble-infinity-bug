<?php

namespace App\Api\Http\Data;

class ProjectData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $status,
        public ?TimelineData $timeline = null,
    ) {
    }
}
