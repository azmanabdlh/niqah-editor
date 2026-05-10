<?php

namespace NIQAHEditor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

/** 
 * @property string $data
 * @property bool $live
 * @property string $componentable_type
 */

trait InteractsWithComponent 
{
  
  public function data(): Attribute
  {
      return Attribute::make(
          get: fn (string $value) => $this->resolveActiveComponents($value),
      );
  }

  public function scopeFindByClassName(Builder $query, string $className)
  {
    return $query->where('componentable_type', $className);
  }

  public function isLive(): bool 
  {
    return $this->live === 1;
  }

  public function className(): string
  {
    return $this->componentable_type;
  }


  public function casts(): array
  {
    return [
      'live' => 'boolean',
      'data' => 'json'
    ];
  }

  private function resolveActiveComponents(string $data): array
  {
    $raw = json_encode(
      [ 'blocks' => $data, '__ClassName' => $this->className() ],
      true
    );
    
    $blockComponents = (new BlockComponentResolver($raw))->resolve();
    if (count($blockComponents) == 0) 
    {
      return [];
    }

    return $blockComponents[0]['blocks'];
  }
}