<?php

namespace NIQAHEditor\View;

class Block 
{
  public function __construct(
    public string $id = '',
    public string $node,
    public array $attributes = [],
    public ?Block $block = null,
  )
  {
    
  }

  public function toArray(): array
  {

    if ($this->node
    |> trim(...)
    |> (fn($str) => empty($str))) {
      return [];
    }

    return [
      'id' => $this->id || "none",
      'node' => $this->node,
      'attributes' => $this->attributes,
      'block' => $this->block->toArray() || [],
    ];
  }

  public function toJSON(): string 
  {
    return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  }
}