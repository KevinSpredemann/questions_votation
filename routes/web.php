<?php

use App\Http\Controllers\{DashboardController, ProfileController, QuestionController, Question};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', function () {
    if (app()->isLocal()) {
        Auth::loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    #region Question Routes
    Route::get('/question', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
    Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
    Route::put('/question/publish/{question}', Question\PublishController::class)->name('questions.publish');
    #endregion

    #region Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    #endregion
});

require __DIR__ . '/auth.php';
