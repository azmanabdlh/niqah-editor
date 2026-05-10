<?php

use Illuminate\Support\Facades\Route;
use NIQAHEditor\Http\Controllers\EditorController;

$middleware = config('niqah-editor.middleware', ['web']);

Route::middleware($middleware)->group(function() {
  Route::post('/niqah-editor/submit', [EditorController::class, 'submit']);
});
