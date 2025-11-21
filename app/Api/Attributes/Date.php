<?php

namespace App\Api\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class Date
{
    public function __construct(
        public string $format = 'c'
    ) {
    }
}
