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
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id ?: 'none',
            'node' => $this->node,
            'type' => $this->type,
            'attributes' => $this->attributes ?: [],
            'children' => $this->children ?: [],
        ];
    }

    public function isValid(): bool
    {
        return $this->node
        |> trim(...)
        |> (fn ($str) => empty($str)) != '';
    }

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function fromJSON(string $blockRaw): self
    {
        $data = json_decode($blockRaw, true);

        return new Block(
            $data['id'],
            $data['node'],
            $data['type'],
            $data['attributes'],
            $data['children']
        );
    }
}
