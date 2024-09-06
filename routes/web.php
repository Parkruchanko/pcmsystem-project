<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// เส้นทางสำหรับการเข้าสู่ระบบ
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('postlogin');

// เส้นทางสำหรับการลงทะเบียน
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signupsave'])->name('postsignup');

// เส้นทางสำหรับการออกจากระบบ
Route::post('/logout', [AuthController::class, 'signOut'])->name('logout');

// เส้นทางสำหรับการจัดการข้อมูล
Route::get('/page', [AuthController::class, 'index'])->middleware('auth');
Route::get('/page/list', [AuthController::class, 'list'])->middleware('auth')->name('page.list');
Route::get('/page/create', [AuthController::class, 'showCreateForm'])->middleware('auth')->name('page.create');
Route::get('/page/createk', [AuthController::class, 'showCreateFormk'])->middleware('auth')->name('page.createk');
Route::post('/page', [AuthController::class, 'add'])->middleware('auth');
Route::get('/page/{id}/edit', [AuthController::class, 'edit'])->middleware('auth');
Route::get('/page/{id}/editk', [AuthController::class, 'editk'])->middleware('auth');
Route::put('/page/{id}', [AuthController::class, 'update'])->middleware('auth');
Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePdf'])->name('generatePdf');;
Route::get('/page/listpdf', [AuthController::class, 'listpdf'])->middleware('auth')->name('page.listpdf');
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/page/choiceform', function () {
    return view('page.choiceform'); // เปลี่ยนเป็นชื่อไฟล์วิวที่ถูกต้อง
})->name('page.choiceform'); // กำหนดชื่อเส้นทาง
