<?php

namespace NIQAHEditor;

use NIQAHEditor\View\Block;
use NIQAHEditor\View\Editor;

class Engine
{
    /**
     * The block components.
     *
     * @var array<string>
     *
     * @internal
     *
     * ```php
     * [
     *   'Hero::class',
     *   'Form::class',
     * ]
     * ```
     */
    protected array $blockComponents = [];

    // Register a block component
    public function registerComponent(string $component): void
    {
        $this->blockComponents[] = $component;
    }

    public function adoptComponents(array $components): void
    {
        $this->blockComponents = $components;
    }

    public function components(): array
    {
        return $this->blockComponents;
    }

    /**
     * Create a new editor instance.
     *
     * @param  string  $version  The version of the editor.
     * @param  string|array  $activeComponents  The active components in the editor.
     * @return Editor The editor instance.
     *
     * @throws Throwable If an error occurs.
     *
     * example:
     * ```php
     *
     *  $activeComponents = [
     *    [
     *      'name' => 'Hero',
     *      'description' => '...',
     *      '__ClassName' => '/NIQAHEditor/View/Components/Hero',
     *      'attributes' => [],
     *      'children' => [],
     *    ],
     *   *
     *  ];
     *
     *  Engine::editor('1.0.0', $activeComponents);
     * ```
     */
    public function editor(string $version, string $activeComponents)
    {

        return new Editor(
            $version,
            $this->resolveBlockComponents($activeComponents),
            $this->makeBlockComponents(),
        );

    }

    private function resolveBlockComponents(string $blockComponentsRaw): array
    {
        return (new BlockComponentResolver($blockComponentsRaw))->resolve();
    }

    private function makeBlockComponents(): array
    {
        $components = [];
        foreach ($this->blockComponents as $component) {
            $components[] = new $component(null);
        }

        return $components;
    }
}
