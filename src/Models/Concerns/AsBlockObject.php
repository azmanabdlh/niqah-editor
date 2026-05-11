<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use NIQAHEditor\View\Block;
use NIQAHEditor\BlockComponentResolver;

class AsBlockObject implements CastsAttributes
{

    private BlockComponentResolver $resolver;

    public function __construct()
    {
        $this->resolver = new BlockComponentResolver();
    }

    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): array {

        return $this->resolver->makeBlock($value)->toArray();
    }

    /**
     * @param  array  $value
     * @return string
     *
     * Serialize the array to a string.
     *
     * example
     * {
     *  new Block()->toJSON()
     * }
     */
    public function set(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): string {
        $block = $this->resolver->makeBlock((string)$value);
        if (is_null($block)) {
            throw new \Error('Invalid block JSON');
        }
        
        return $block->toJSON();
    }
}
