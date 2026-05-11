<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property string $data
 * @property bool $live
 * @property array $attributes
 */
trait InteractsWithComponent
{
    const CLASS_NAME = 'className';

    public function className(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => throw new \Error('Cannot access private property '.__CLASS__.'::$className'),
            set: fn ($value) => throw new \Error('Cannot set private property '.__CLASS__.'::$className'),
        );
    }

    public function getClassName(): string
    {
        return $this->attributes[self::CLASS_NAME];
    }

    public function scopeFindByClassName(Builder $query, string $className)
    {
        return $query->where(self::CLASS_NAME, $className);
    }

    public function isLive(): bool
    {
        return $this->live === 1;
    }

    public function casts(): array
    {
        return [
            'live' => 'boolean',
            'data' => AsBlockObject::class,
        ];
    }
}
