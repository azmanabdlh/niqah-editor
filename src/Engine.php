<?php

namespace NIQAHEditor;

use NIQAHEditor\View\BlockComponent;
use NIQAHEditor\View\Editor;

class Engine 
{
  protected array $blockComponents = [];
  
  // Register a block component
  public function registerComponent(BlockComponent $component): void
  {
    $this->blockComponents[$component->name] = $component;
  }

  public function components(): array
  {
    return $this->blockComponents;
  }

  
  public function editor(string $version, array $activeComponents = [])
  {
    return new Editor(
      $version,
      $activeComponents,
      $this->components(),
    );
  }
}