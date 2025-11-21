<?php

namespace App\Api\Http\Data;

use App\Api\Attributes\Data\HiddenResponse;
use App\Api\Transformers\DateTransformer;
use Carbon\Carbon;
use DateTimeInterface;
use Exception;
use Illuminate\Support\Collection;
use Override;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Support\Creation\{CreationContext, CreationContextFactory,};
use Spatie\LaravelData\Support\DataConfig;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\{TransformationContext, TransformationContextFactory,};

/**
 * Api Base Resource
 */
#[MapName(SnakeCaseMapper::class)]
abstract class AbstractApiData extends Data
{
    /**
     * These cast/transform classes will be applied by default
     * for both casting and transforming
     */
    protected const array CAST_TRANSFORMS = [
        DateTimeInterface::class => DateTransformer::class,
        Carbon::class => DateTransformer::class,
    ];

    /**
     * Override transform method, to apply custom transformers
     *
     * @return array<mixed, mixed>
     * @throws Exception
     */
    #[Override]
    public function transform(
        TransformationContext|TransformationContextFactory|null $transformationContext = null,
    ): array {

        $factory = TransformationContextFactory::create()
            ->withWrapping();

        foreach (self::CAST_TRANSFORMS as $from => $to) {
            $factory->withTransformer($from, $to);
        }

        /**
         * Check for #[HiddenResponse] attribute and exclude field from response
         */
        $reflection = new ReflectionClass($this);
        $constructor = $reflection->getConstructor();

        foreach (($constructor?->getParameters() ?? []) as $parameter) {
            if (!$parameter->getAttributes(HiddenResponse::class)) {
                continue;
            }

            $this->except($parameter->getName());
        }

        return parent::transform($factory);
    }

    /**
     * Override factory initializer, to apply custom casts
     *
     * @param CreationContext<static> | null $creationContext
     * @return CreationContextFactory<static>
     */
    #[Override]
    public static function factory(?CreationContext $creationContext = null): CreationContextFactory
    {
        $context = CreationContextFactory::createFromConfig(static::class);

        foreach (self::CAST_TRANSFORMS as $from => $to) {
            $context->withCast($from, $to);
        }

        return $context;
    }

    /**
     * @param callable|null $filtering
     * @return Collection<string, DataProperty>
     */
    public static function getDataClassProperties(?callable $filtering = null): Collection
    {
        $properties = app(DataConfig::class)->getDataClass(static::class)->properties;

        if (empty($filtering)) {
            return $properties;
        }

        return collect($properties)->filter($filtering);
    }

    /**
     * @return CreationContext<AbstractApiData>
     */
    public static function getContext(): CreationContext
    {
        return self::factory()->get();
    }
}
