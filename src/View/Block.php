<?php

namespace NIQAHEditor\View;

class Block
{
    public function __construct(
        public string $id,
        public string $node,
        public string $value,
        public string $type,
        public array $props = [],
        public array $children = [],
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id ?: 'none',
            'node' => $this->node,
            'value' => $this->value,
            'type' => $this->type,
            'props' => $this->props ?: [],
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
            $data['value'],
            $data['type'],
            $data['props'],
            $data['children']
        );
    }
}
