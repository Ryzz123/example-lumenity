<?php

namespace Lumenity\Framework\routes;

use Lumenity\Framework\common\config\app\route as Route;
use Lumenity\Framework\app\http\controllers\CategoryController;
use Lumenity\Framework\app\http\controllers\ArticleController;

/**
 * Api Routes
 *
 * This class handles the definition of routes specific to the website.
 */
class api
{
    /**
     * Capture Website Routes
     *
     * This method captures and defines the routes for the website.
     * It should be called to register website-specific routes.
     *
     * @return void
     */
    public static function capture(): void
    {
        Route::group('/api', function () {
            Route::get('/categories', CategoryController::class, 'getAll');
            Route::get('/categories/{id}', CategoryController::class, 'getById');
            Route::post('/categories', CategoryController::class, 'create');
            Route::patch('/categories/{id}', CategoryController::class, 'update');
            Route::delete('/categories/{id}', CategoryController::class, 'delete');
        });

        Route::group('/api', function () {
            Route::get('/articles', ArticleController::class, 'getAll');
            Route::get('/articles/{id}', ArticleController::class, 'getById');
            Route::get('/articles/category/{id}', ArticleController::class, 'getByCategoryId');
            Route::post('/articles', ArticleController::class, 'save');
            Route::patch('/articles/{id}', ArticleController::class, 'update');
            Route::delete('/articles/{id}', ArticleController::class, 'delete');
        });
    }
}