<?php

namespace NIQAHEditor\View;

abstract class BlockComponent
{
    public string $name;

    public string $description;

    public function __construct(
        private ?Block $block
    )
    {
        
    }

    // Define the default block component.
    abstract public function defaultBlock(): Block;
    
    abstract public function thumbnail(): string;
    
    public function modelClassName(): string 
    {
        return get_class($this);
    }

    public function block(): Block
    {
        return $this->block ?: $this->defaultBlock();
    }

    public function toJSON(): string 
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function toArray(): array 
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'blocks' => $this->block()->toArray(),
            'thumbnail' => $this->thumbnail(),
            '__ClassName' => $this->modelClassName(),
        ];
    }
}
