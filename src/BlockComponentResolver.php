<?php

namespace NIQAHEditor;

use RuntimeException;

use Illuminate\Support\Collection;

use NIQAHEditor\View\BlockComponent;
use NIQAHEditor\View\Block;

class BlockComponentResolver
{

  protected array $blockComponents = [];

  public function __construct(    
    protected string $blockComponentsRaw,
  ) {
  }

  public function isValid(): bool 
  {
    try {
      $this->resolve();

      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  

  public function resolve() 
  {

    $blockComponentsRaw = json_decode($this->blockComponentsRaw, true);

    if (!is_array($blockComponentsRaw)) {
      throw new RuntimeException('Invalid block components raw value');
    }

    if (count($blockComponentsRaw) == 0) {
      return [];
    }
    
    $blockComponents = Collection::make($blockComponentsRaw)->map(function ($component) {          
      $block = $this->makeBlock($component['blocks']);
      if (!is_null($block) && !$block->isValid()) {
        throw new RuntimeException('Invalid block raw value');
      }

      
      if (class_exists($klass = $component['__ClassName'])) {
        return new $klass($block);
      }

      // Log::info()
      throw new RuntimeException('Not found BlockComponent ' . $klass);       
    });

    return $blockComponents->toArray();
  }

  private function makeBlock(string $blockRaw): ?Block
  {
    if (empty($blockRaw)) {
      return null;
    }
    

    return Block::fromJSON($blockRaw);    
  }

}