<?php

namespace NIQAHEditor\View;

abstract class BlockComponent
{
    public string $name;

    public string $description;

    public string $thumbnail;

    private ?Block $block;

    // Define the default block component.
    abstract public function defaultBlock(): Block;

    public function getClassName(): string
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
            'thumbnail' => $this->thumbnail,
            '__ClassName' => $this->getClassName(),
        ];
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function setBlock(Block $block): self
    {
        $this->block = $block;

        return $this;
    }
}
