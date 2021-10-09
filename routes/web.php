<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\DashboardController;


Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']); 

// dashboard page
Route::get('/', [DashboardController::class, 'dashboardIndex'])
	->name('dashboard')
	->middleware('auth');

// comment page
Route::get('/comment', [DashboardController::class, 'commentIndex'])
	->name('comment_index')
	->middleware('auth');

// comment written
Route::post('/write_comment', [DashboardController::class, 'commentWritten'])
	->name('write_comment')
	->middleware('auth');

// lesson watched
Route::get('lesson_watched', [DashboardController::class, 'lessonWatched'])
	->name('lesson_watched')
	->middleware('auth');

// app logout
Route::get('logout', [DashboardController::class, 'logout'])->name('logout');

