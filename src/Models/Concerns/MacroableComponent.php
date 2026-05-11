<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

use NIQAHEditor\View\Block;

trait MacroableComponent
{

    #[Scope]
    public function toComponent(Builder $query) 
    {
        $query->get()->map(function (Model $model) {
            $klass = new $model->getClassName(
                    Block::fromJSON($model->data),
                );
                
                return $klass
                    ->setName($model->name)
                    ->setDescription($model->description)
                    ->setThumbnail($model->thumbnail);
                
        });
    }
}

