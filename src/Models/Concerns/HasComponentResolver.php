<?php

namespace NIQAHEditor\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use NIQAHEditor\BlockComponentResolver;

trait HasComponentResolver
{
    #[Scope]
    public function asComponent(Builder $query)
    {
        $resolver = new BlockComponentResolver;

        $query->get()->map(function (Model $model) use ($resolver) {

            $klass = $resolver->makeBlockComponent($model->getClassName());

            return $klass
                ->setName($model->name)
                ->setDescription($model->description)
                ->setThumbnail($model->thumbnail)
                ->setBlock($model->data);

        });
    }
}
