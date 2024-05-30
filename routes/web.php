<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\LogController;
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
    return view('auth.login');
})->name('home');

Route::get('/parameter', function () {
    return view('parameter');
})->name('parameter');

Route::get('/search', function () {
    $students = DB::table('students')->get();
    return view('search',[
        'students' => $students,
    ]);
})->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('students', StudentController::class)->middleware(['auth', 'verified']);
Route::resource('parameters', ParameterController::class)->middleware(['auth', 'verified']);
Route::resource('/logs', LogController::class);
Route::get('/log',[LogController::class,'index'])->name('log');

Route::get('/students/{student}/assist', [StudentController::class, 'assist'])->name('students.assist');
Route::get('/students/{student}/deleteAssist', [StudentController::class, 'deleteAssist'])->name('students.deleteAssist');
Route::get('/students/{student}/infoAssist', [StudentController::class, 'infoAssist'])->name('students.infoAssist');
Route::get('/students-PDF', [StudentController::class, 'generatePDF'])->name('students.generatePDF');
Route::post('/search', [StudentController::class, 'searchStudent'])->name('students.search');


require __DIR__.'/auth.php';
