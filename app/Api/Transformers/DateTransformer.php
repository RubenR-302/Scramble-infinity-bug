<?php

namespace App\Api\Transformers;

use App\Api\Attributes\Date;
use Carbon\{
    Carbon,
    Month,
    WeekDay,
};
use DateTimeInterface;
use Spatie\LaravelData\Casts\{
    Cast,
    IterableItemCast,
};
use Spatie\LaravelData\Support\{
    Creation\CreationContext,
    DataProperty,
    Transformation\TransformationContext,
};
use Spatie\LaravelData\Contracts\BaseData;
use Spatie\LaravelData\Transformers\Transformer;

/**
 * Easy date format transformer and caster for Laravel Data
 *
 * @template TData of BaseData
 */
class DateTransformer implements Transformer, Cast, IterableItemCast
{
    /**
     * Transform data to JSON view
     *
     * @param DataProperty $property
     * @param mixed $value
     * @param TransformationContext $context
     * @return string|null
     */
    public function transform(
        DataProperty $property,
        mixed $value,
        TransformationContext $context,
    ): ?string {
        if (!$value instanceof Carbon) {
            return null;
        }

        $attribute = $property->attributes->first(Date::class);

        $format = $attribute instanceof Date ? $attribute->format : 'c';

        return $value->format($format);
    }

    /**
     * Cast value from database to Carbon
     *
     * @param DataProperty $property
     * @param mixed $value
     * @param array<string, mixed> $properties
     * @param CreationContext<TData> $context
     * @return Carbon|null
     */
    public function cast(
        DataProperty $property,
        mixed $value,
        array $properties,
        CreationContext $context,
    ): ?Carbon {
        if (
            !is_string($value)
            && !$value instanceof Month
            && !$value instanceof WeekDay
            && !$value instanceof DateTimeInterface
            && !is_float($value)
            && !is_int($value)
        ) {
            return null;
        }

        return Carbon::parse($value);
    }

    /**
     * Cast value from database to Carbon
     *
     * @param DataProperty $property
     * @param mixed $value
     * @param array<string, mixed> $properties
     * @param CreationContext<TData> $context
     * @return ?Carbon
     */
    public function castIterableItem(
        DataProperty $property,
        mixed $value,
        array $properties,
        CreationContext $context,
    ): ?Carbon {
        return $this->cast($property, $value, $properties, $context);
    }
}
