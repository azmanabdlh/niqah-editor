<?php

namespace NIQAHEditor\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use NIQAHEditor\Models\Concerns\HasScopeComponent;
use NIQAHEditor\Models\Concerns\InteractsWithComponent;

#[Fillable(
    'name',
    'thumbnail',
    'description',
    'blocks',
    'className',
)]
class BlockComponent extends Model
{
    use HasScopeComponent, InteractsWithComponent;
}
