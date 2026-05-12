<?php

namespace NIQAHEditor;

use Illuminate\Support\Collection;
use NIQAHEditor\View\Block;
use NIQAHEditor\View\BlockComponent;
use RuntimeException;

class BlockComponentResolver
{
    protected array $blockComponents = [];

    public function isValid(string $blockComponentsRaw): bool
    {
        try {
            $this->resolve($blockComponentsRaw);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function makeBlockComponent(string $klass): BlockComponent
    {
        if (! class_exists($klass)) {
            throw new RuntimeException('Not found BlockComponent '.$klass);
        }

        return new $klass;
    }

    public function resolve(string $blockComponentsRaw): array
    {

        $blockComponents = json_decode($blockComponentsRaw, true);

        if (! is_array($blockComponents)) {
            throw new RuntimeException('Invalid block components raw value');
        }

        if (count($blockComponents) == 0) {
            return [];
        }

        return Collection::make($blockComponents)->map(function ($component) {
            $block = $this->makeBlock($component['blocks']);
            if (! is_null($block) && ! $block->isValid()) {
                throw new RuntimeException('Invalid block raw value');
            }

            $klass = $this->makeBlockComponent($component['__ClassName']);

            return $klass
                ->setName($component['name'])
                ->setType($component['type'])
                ->setDescription($component['description'])
                ->setThumbnail($component['thumbnail'])
                ->setBlock($block);
        })->toArray();
    }

    public function makeBlock(string $blockRaw): ?Block
    {
        if (empty($blockRaw)) {
            return null;
        }

        return Block::fromJSON($blockRaw);
    }
}
