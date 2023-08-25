<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\WordsController;

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
    Route::post('/categories', [CategoriesController::class, 'getMainCategories']);
    Route::post('/categories/sub', [CategoriesController::class, 'getSubCategories']);
    Route::post('/category', [CategoriesController::class, 'getCategoryById']);
    Route::post('/category/names', [CategoriesController::class, 'getCategoryNames']);
    Route::post('/categories/get-languages', [CategoriesController::class, 'getLanguages']);
    Route::post('/categories/search', [CategoriesController::class, 'search']);
    Route::post('/categories/delete', [CategoriesController::class, 'delete']);
    Route::get('/categories/add', [CategoriesController::class, 'addIndex']);
    Route::post('/categories/add', [CategoriesController::class, 'add']);
    Route::get('/categories/edit/', [CategoriesController::class, 'preview']);
    Route::post('/categories/edit', [CategoriesController::class, 'editCategory']);
    Route::get('/categories/edit/{cat_id}', [CategoriesController::class, 'editIndex']);

    //words
    Route::get('/words', [WordsController::class, 'preview']);
    Route::post('/words', [WordsController::class, 'getTerms']);
    Route::post('/categories', [WordsController::class, 'getMainCategories']);
    Route::post('/word', [WordsController::class, 'getWordById']);
    Route::post('/word/names', [WordsController::class, 'getWordNames']);
    Route::post('/word/titles', [WordsController::class, 'getWordTitles']);
    Route::post('/word/contents', [WordsController::class, 'getWordContents']);
    Route::post('/word/sounds', [WordsController::class, 'getWordSounds']);
    Route::post('/words/get-languages', [WordsController::class, 'getLanguages']);
    Route::post('/words/search', [WordsController::class, 'search']);
    Route::post('/words/delete', [WordsController::class, 'delete']);
    Route::get('/words/add', [WordsController::class, 'addIndex']);
    Route::post('/words/add', [WordsController::class, 'add']);
    Route::get('/words/edit/', [WordsController::class, 'preview']);
    Route::post('/words/edit', [WordsController::class, 'editCategory']);
    Route::get('/words/edit/{cat_id}', [WordsController::class, 'editIndex']);
});

