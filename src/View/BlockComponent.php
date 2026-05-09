<?php

namespace NIQAHEditor\View;

use Illuminate\View\Component;


abstract class BlockComponent extends Component
{
    public string $name;

    public string $description;

    // Define the block definition for this schema.
    abstract public function block(): Block;
    

    public function render()
    {
        return view('component', [
            'block' => $this->block()->toArray(),
        ]);
    }
}
