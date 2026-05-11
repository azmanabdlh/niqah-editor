<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use NIQAHEditor\View\Block;

trait HasScopeComponent
{
    #[Scope]
    public function toComponent(Builder $query)
    {
        $query->get()->map(function (Model $model) {
            $klass = new $model->getClassName($model->data);
                
                return $klass
                    ->setName($model->name)
                    ->setDescription($model->description)
                    ->setThumbnail($model->thumbnail);
                
        });
    }
}
