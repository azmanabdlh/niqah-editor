<?php

namespace NIQAHEditor\View;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Editor extends Component
{
    const BLOCK_THRESHOLD = 30;

    public function __construct(
        protected string $version,

        // @var array<BlockComponent>[]
        protected array $activeComponents = [],

        // @var array<string, BlockComponent>[]
        protected array $blockComponents = []
    ) {}

    public function render()
    {
        return view('editor', $this->toArray());
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    private function toArray(): array
    {
        return [
            'version' => $this->version,
            'activeComponents' => $this->activeComponents,
            'blockComponents' => $this->constructBlockComponents(),
        ];
    }

    private function constructBlockComponents(): array
    {

        return Collection::make($this->blockComponents)
            ->map(fn (BlockComponent $component) => $component->toArray())
            ->take(
                config('niqah-editor.blocks.threshold', self::BLOCK_THRESHOLD)
            )->toArray();
    }
}
