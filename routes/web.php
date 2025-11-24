<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ContactController;

Route::get('/', [TextController::class, 'view'])->name('index');

Route::get('works', [WorkController::class, 'view'])->name('works');
Route::get('works/{id}', [WorkController::class, 'show'])->name('works.show');
Route::view('contact', 'contact')->name('contact');

Route::post('contact', [ContactController::class, 'contact'])->name('contact.submit');

Route::view('admin/login', 'admin.login')->name('admin');
Route::post('admin/auth', [AdminController::class, 'login'])->name('admin.auth');

Route::middleware(['admin.auth'])->group(function () {
    Route::view('admin/index', 'admin.index')->name('admin.index');
    Route::get('admin/operation', [TextController::class, 'operationView'])->name('admin.operation');
    Route::get('admin/works', [WorkController::class, 'admin_view'])->name('admin.works');
    Route::post('admin/works', [WorkController::class, 'upload'])->name('admin.works');
    Route::delete('admin/works/{id}', [WorkController::class, 'delete'])->name('admin.works.delete');
    Route::post('admin/operation', [TextController::class, 'operation'])->name('admin.operation');
    Route::get('admin/contact', [ContactController::class, 'view'])->name('admin.contact');
    Route::delete('admin/contact/{id}', [ContactController::class, 'delete'])->name('admin.contact.delete');
});

Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');