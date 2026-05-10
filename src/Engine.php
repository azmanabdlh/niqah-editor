<?php

namespace NIQAHEditor;

use NIQAHEditor\View\BlockComponent;
use NIQAHEditor\View\Editor;

class Engine 
{
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

  
  public function editor(string $version, array $activeComponents = [])
  {
    return new Editor(
      $version,
      $activeComponents,
      $this->resolveBlockComponents(),      
    );
  }

  private function resolveBlockComponents(): array 
  {
    $components = [];
    foreach ($this->blockComponents as $component) {
      $components[] = new $component();
    }
    
    return $components;
  }
}