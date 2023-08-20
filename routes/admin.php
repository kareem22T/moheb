<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\CategoriesController;

Route::middleware(['guest_admin'])->group(function () {
    Route::get('/login', [RegisterController::class, 'getLoginIndex']);
    Route::post('/login', [RegisterController::class, 'login']);
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [RegisterController::class, 'ff']);
    Route::get('/logout', [RegisterController::class, 'logout']);

    //languages
    Route::get('/languages', [LanguagesController::class, 'preview']);
    Route::post('/languages', [LanguagesController::class, 'getLanguages']);
    Route::post('/languages/search', [LanguagesController::class, 'search']);
    Route::post('/languages/edit', [LanguagesController::class, 'editLang']);
    Route::post('/languages/delete', [LanguagesController::class, 'delete']);
    Route::get('/languages/add', [LanguagesController::class, 'addIndex']);
    Route::post('/languages/add', [LanguagesController::class, 'add']);
    Route::get('/languages/content', [LanguagesController::class, 'contentIndex']);
    Route::post('/languages/content/update', [LanguagesController::class, 'updateContentFile']);

    //categories
    Route::get('/categories', [CategoriesController::class, 'preview']);
    Route::post('/categories', [CategoriesController::class, 'getCategories']);
    Route::post('/categories/get-languages', [CategoriesController::class, 'getLanguages']);
    Route::post('/categories/search', [CategoriesController::class, 'search']);
    Route::post('/categories/edit', [CategoriesController::class, 'editLang']);
    Route::post('/categories/delete', [CategoriesController::class, 'delete']);
    Route::get('/categories/add', [CategoriesController::class, 'addIndex']);
    Route::post('/categories/add', [CategoriesController::class, 'add']);
    Route::get('/categories/content', [CategoriesController::class, 'contentIndex']);
    Route::post('/categories/content/update', [CategoriesController::class, 'updateContentFile']);
});

