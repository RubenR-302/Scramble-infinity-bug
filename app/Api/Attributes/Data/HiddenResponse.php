<?php

namespace App\Api\Attributes\Data;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class HiddenResponse
{
}
