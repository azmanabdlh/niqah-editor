<?php

namespace NIQAHEditor\View\Components;

use NIQAHEditor\View\Block;
use NIQAHEditor\View\BlockComponent;

class Hero extends BlockComponent
{
    public string $name = 'Hero';

    public string $type = 'hero';

    public string $description = 'Bagian full-width di bagian atas situs yang berisi proposisi nilai (judul), deskripsi singkat, dan poin interaksi utama';

    public function defaultBlock(): Block
    {
        return new Block(
            id: '',
            node: 'div',
            type: '__Container',
            attributes: [],
            children: [],
        );
    }

}
