<?php

namespace NIQAHEditor\View;

class Block 
{
  public function __construct(
    public string $id,
    public string $node,
    public string $type,    
    public array $attributes = [],
    public array $children = [],
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
      'id' => $this->id ?: 'none',
      'node' => $this->node,
      'type' => $this->type,
      'attributes' => $this->attributes ?: [],
      'children' => $this->children ?: [],
    ];
  }

  public function toJSON(): string 
  {
    return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  }

  public function fromJSON(string $json): void {
    $data = json_decode($json, true);
    
    if (!is_array($data)) {
      return;
    }
    
    $this->id = $data['id'];;
    $this->node = $data['node'];
    $this->type = $data['type'];
    $this->attributes = $data['attributes'];
    $this->children = $data['children'];
  }
}