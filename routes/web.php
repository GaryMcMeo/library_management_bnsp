<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BookController;

// Route::get('/', function () {
//     return view('index');
// })->name('index');
Route::get('/', [MemberController::class, 'index'])->name('index');

Route::get('/Book', [BookController::class, 'index'])->name('Book');
Route::get('/Book/create', [BookController::class, 'create'])->name('book.create');
Route::post('/Book', [BookController::class, 'store'])->name('book.store');
Route::get('/Book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/Book/{book}', [BookController::class, 'update'])->name('book.update');
Route::delete('/Book/{book}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/Member', [MemberController::class, 'index'])->name('Member');
Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
Route::post('/member', [App\Http\Controllers\MemberController::class, 'store'])->name('member.store');
Route::get('/member/{member}/edit', [MemberController::class, 'edit'])->name('member.edit');
Route::put('/member/{member}', [MemberController::class, 'update'])->name('member.update');
Route::delete('/member/{member}', [MemberController::class, 'destroy'])->name('member.destroy');
Route::post('/members/{member}/borrow', [MemberController::class, 'borrowBook'])->name('member.borrowBook');
Route::post('/members/{book}/return', [MemberController::class, 'returnBook'])->name('member.returnBook');

Route::get('/Categories', [CategoriesController::class, 'index'])->name('Categories');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');