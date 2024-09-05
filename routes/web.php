<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route to show the inquiry form
Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry');

Route::post('/inquiry/add', [InquiryController::class, 'addInquiry'])->name('addInquiry');


// ---- admin routes ----- 

Route::get('/admin/inquiry/index', [InquiryController::class, 'adminViewInquiryList'])->name('admin.inquiry.index');

Route::get('/admin/inquiry/{ticketID}', [InquiryController::class, 'viewInquiry'])->name('admin.inquiry.viewInquiry');

Route::put('/admin/inquiry/{ticketID}/status', [inquiryController::class, 'updateStatus'])->name('admin.inquiry.updateStatus');

Route::delete('/admin/inquiry/{ticketID}', [inquiryController::class, 'deleteInquiry'])->name('admin.inquiry.delete');

Route::post('/admin/inquiries/{ticketID}/reply', [InquiryController::class, 'reply'])->name('admin.inquiry.reply');