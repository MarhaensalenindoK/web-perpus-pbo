<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Models\Loan;
use App\Models\Member;
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
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/export-pdf', [DashboardController::class, 'exportPDF'])->name('export.pdf');

Route::get('books', [BookController::class, 'index']);
Route::post('book-add', [BookController::class, 'store']);
// Route::get('book-detail/{id}', [BookController::class, 'detail']);
Route::put('book-edit', [BookController::class, 'update']);
Route::delete('book-destroy', [BookController::class, 'destroy']);

Route::get('authors', [AuthorController::class, 'index']);
Route::post('author-add', [AuthorController::class, 'store']);
// Route::get('author-detail/{id}', [AuthorController::class, 'detail']);
Route::put('author-edit', [AuthorController::class, 'update']);
Route::delete('author-destroy', [AuthorController::class, 'destroy']);

Route::get('members', [MemberController::class, 'index']);
Route::post('member-add', [MemberController::class, 'store']);
Route::get('member-detail/{id}', [MemberController::class, 'detail']);
Route::put('member-edit', [MemberController::class, 'update']);
Route::delete('member-destroy', [MemberController::class, 'destroy']);

Route::get('loans', [LoanController::class, 'index']);
Route::post('loan-add', [LoanController::class, 'store']);
Route::get('loan-detail/{id}', [LoanController::class, 'detail']);
Route::put('loan-edit/{id}', [LoanController::class, 'update']);
Route::get('loan-destroy/{id}', [LoanController::class, 'destroy']);
