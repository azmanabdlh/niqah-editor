<?php

namespace NIQAHEditor\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use NIQAHEditor\Models\Concerns\InteractsWithComponent;
use NIQAHEditor\Models\Concerns\HasScopeComponent;

#[Fillable(
    'name',
    'thumbnail',
    'description',
    'blocks',
    'className',
)]
class BlockComponent extends Model
{
    use InteractsWithComponent, HasScopeComponent;
}
