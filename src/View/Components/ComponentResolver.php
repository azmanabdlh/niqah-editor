<?php

namespace NIQAHEditor\View\Components;


interface ComponentResolver {

  public function name(): string;
   
  public function schema(): array;

  public function validate(): bool;
 
}