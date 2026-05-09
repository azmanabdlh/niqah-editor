<?php

namespace NIQAHEditor\View\Components;

use NIQAHEditor\View\Block;
use NIQAHEditor\View\BlockComponent;

class Hero extends BlockComponent
{
    public string $name = '';

    public string $description = "";

    public function block(): Block 
    {
        return new Block(
            id: "",
            node: 'div',
            attributes: [],
            block: null,
        );
    }
}
