<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
});

Route::middleware('role')->group(function () {
    Route::resources([
        'quiz' => QuizController::class,
        'question' => QuestionController::class,
        'user' => UserController::class,
    ]);

    Route::post('/exam/unassign', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::post('/exam/assign', [ExamController::class, 'assign'])->name('exam.assign');
    Route::post('/exam/assign-all', [ExamController::class, 'assignAll'])->name('exam.assignAll');
    Route::get('/exam/assign', [ExamController::class, 'create'])->name('exam.create');
    Route::get('/result', [ExamController::class, 'userResult'])->name('result.user');
    Route::get('/result/{quiz}/user/{user}', [ExamController::class, 'viewUserResult'])->name('result.view');
});

Route::middleware('auth')->group(function () {
    Route::get('/exam', [ExamController::class, 'index'])->name('exam.index');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/exam/{quiz}/start', [ExamController::class, 'start'])->name('exam.start');

    Route::post('/result/store', [ExamController::class, 'result']);

    Route::get('/result/{user}/{quiz}', [ExamController::class, 'viewResult']);
});


require __DIR__ . '/auth.php';
