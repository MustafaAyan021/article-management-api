<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {


    Route::get('/articles/trashed', [ArticleController::class, 'trashed'])
        ->middleware('auth:sanctum');

    Route::post('/articles/trashed/{id}/restore', [ArticleController::class, 'restore'])
        ->middleware('auth:sanctum');

    Route::apiResource('articles', ArticleController::class)
        ->middleware('auth:sanctum');

    Route::get('/public/articles', [ArticleController::class, 'publicIndex']);
    Route::get('/public/articles/{slug}', [ArticleController::class, 'publicShow']);

    require __DIR__ . '/auth.php';
});
