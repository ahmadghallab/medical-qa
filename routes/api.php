<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create-account', [AuthController::class, 'createAccount']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Branches
Route::get('/branches', [BranchController::class, 'index'])
    ->name('branch.index');

Route::get('/branches/{id}', [BranchController::class, 'show'])
    ->name('branch.show');

Route::post('/branches', [BranchController::class, 'store'])
    ->name('branch.create');

Route::post('/branches/{id}', [BranchController::class, 'update'])
    ->name('branch.update');

Route::delete('/branches/{id}', [BranchController::class, 'destroy'])
    ->name('branch.delete');

// Topics
Route::get('/topics', [TopicController::class, 'index'])
    ->name('topic.index');

Route::get('/topics/branch/{branchId}', [TopicController::class, 'indexByBranch'])
    ->name('topic.indexByBranch');

Route::get('/topics/{id}', [TopicController::class, 'show'])
    ->name('topic.show');

Route::post('/topics', [TopicController::class, 'store'])
    ->name('topic.create');

Route::post('/topics/{id}', [TopicController::class, 'update'])
    ->name('topic.update');

Route::delete('/topics/{id}', [TopicController::class, 'destroy'])
    ->name('topic.delete');

// Titles
Route::get('/titles', [TitleController::class, 'index'])
    ->name('title.index');

Route::get('/titles/topic/{topicId}', [TitleController::class, 'indexByTopic'])
    ->name('title.indexByTopic');

Route::get('/titles/{id}', [TitleController::class, 'show'])
    ->name('title.show');

Route::post('/titles', [TitleController::class, 'store'])
    ->name('title.create');

Route::post('/titles/{id}', [TitleController::class, 'update'])
    ->name('title.update');

Route::delete('/titles/{id}', [TitleController::class, 'destroy'])
    ->name('title.delete');

// Questions
Route::get('/questions', [QuestionController::class, 'index'])
    ->name('question.index');

Route::get('/questions/title/{titleId}', [QuestionController::class, 'indexByTitle'])
    ->name('question.indexByTitle');

Route::get('/questions/{id}', [QuestionController::class, 'show'])
    ->name('question.show');

Route::post('/questions', [QuestionController::class, 'store'])
    ->name('question.create');

Route::post('/questions/{id}', [QuestionController::class, 'update'])
    ->name('question.update');

Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])
    ->name('question.delete');
