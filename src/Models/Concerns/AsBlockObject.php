<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use NIQAHEditor\BlockComponentResolver;
use NIQAHEditor\View\Block;

class AsBlockObject implements CastsAttributes
{
    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): array {
      

        return $this->makeBlock($value)->toArray();
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
        
        if (! is_string($value)) {
            throw new \Error("Expected type 'string'. Found '".gettype($value)."'");
        }

        return $this->makeBlock($value)->toJSON();
    }

    private function makeBlock(string $value) 
    {
        $block = Block::fromJSON($value);
        if (! is_null($block) && ! $block->isValid()) {
            throw new \Error('Invalid block JSON');
        }

        return $block;
    }
}
