<?php

namespace NIQAHEditor\View;

use Illuminate\View\Component;

class Editor extends Component
{
    public function __construct(
        protected string $version,
                
        // @var array<BlockComponent>[]
        protected array $activeComponents = [],
                
        // @var array<string, BlockComponent>[]
        protected array $blockComponents = []
    )
    {
        
    }

    public function render() 
    {
        return view('editor', $this->toArray());
    }
    

    public function toJSON(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } 

    private function toArray(): array
    {
        return [
            'version' => $this->version,
            'activeComponents' => $this->activeComponents,
            'blockComponents' => $this->blockComponents,
        ];
    }
}