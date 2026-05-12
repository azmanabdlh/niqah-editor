<?php

use Illuminate\Support\Facades\Route;
use NIQAHEditor\View\BlockComponent;
use NIQAHEditor\Http\Controllers\BlockComponentController;

$prefix = config('niqah-editor.prefix', 'editor');
$middleware = config('niqah-editor.middleware', ['web']);

Route::middleware($middleware)->prefix($prefix)->group(function () {
    Route::post('/block-runtime/validate', [BlockComponentController::class, '__invoke']);
});
