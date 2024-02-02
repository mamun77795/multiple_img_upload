<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UploadController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/uploads', [UploadController::class, 'store'])->name('uploads');
Route::post('/insert', [StudentController::class, 'store'])->name('insert');
Route::post('/edit-data', [StudentController::class, 'edit'])->name('edit');
Route::post('/update-data', [StudentController::class, 'update'])->name('update');
Route::post('/delete-data', [StudentController::class, 'destroy'])->name('delete');
