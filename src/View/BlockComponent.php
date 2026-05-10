<?php

namespace NIQAHEditor\View;

use Illuminate\View\Component;


abstract class BlockComponent extends Component
{
    public string $name;

    public string $description;

    // Define the block definition for this schema.
    abstract public function block(): Block;
    
    abstract public function thumbnail(): string;


    public function render()
    {
        return view('component', [
            'blockComponent' => $this->block()->toArray(),
        ]);
    }
}
