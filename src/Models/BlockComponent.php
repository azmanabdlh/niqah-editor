<?php

namespace NIQAHEditor\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use NIQAHEditor\Models\Concerns\HasComponentResolver;
use NIQAHEditor\Models\Concerns\InteractsWithComponent;

#[Fillable(
    'name',
    'type',
    'thumbnail',
    'description',
    'blocks',
    'className',
)]
class BlockComponent extends Model
{
    use HasComponentResolver, InteractsWithComponent;
}
