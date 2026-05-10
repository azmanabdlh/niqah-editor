<?php

namespace NIQAHEditor\View;

abstract class BlockComponent
{
    public string $name;

    public string $description;

    // Define the block definition for this schema.
    abstract public function block(): Block;
    
    abstract public function thumbnail(): string;

    public function toJSON(): string 
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function toArray(): array 
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'blockComponent' => $this->block()->toArray(),
            'thumbnail' => $this->thumbnail(),
        ];
    }
}
