<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


Route::middleware('web')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
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

Route::post('/inquiry/callback-request', [InquiryController::class, 'addCallBackRequest'])->name('addCallBackRequest');



// Route::get('/my-php-page', function () {
//     return view('my-php-page');
// });


// ---- admin routes ----- 


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class,'dashboard'])->name('dashboard');
    Route::prefix('inquiry')->group(function () {
        Route::get('/', [InquiryController::class, 'adminViewInquiriesAndCallbacks'])->name('inquiry.index');
        Route::get('/{ticketID}', [InquiryController::class, 'viewInquiry']) ->where('ticketID', '[0-9]+')->name('inquiry.viewInquiry');
        Route::put('/{ticketID}/status', [InquiryController::class, 'updateStatus'])->name('inquiry.updateStatus');
        Route::delete('/{ticketID}', [InquiryController::class, 'deleteInquiry'])->name('inquiry.delete');
        Route::post('/{ticketID}/reply', [InquiryController::class, 'reply'])->name('inquiry.reply');

        Route::get('/callback/{id}', [InquiryController::class, 'viewCallback'])->name('inquiry.viewCallback');
        Route::put('/callback/{id}/status', [InquiryController::class, 'updateCallbackStatus'])->name('inquiry.callback.updateStatus');
        Route::delete('/callback/{id}/delete', [InquiryController::class, 'deleteCallbackRequest'])->name('inquiry.callback.delete');
    });
});




// Route::get('/admin/inquiry/', [InquiryController::class, 'adminViewInquiriesAndCallbacks'])->name('admin.inquiry.index');

// Route::get('/admin/inquiry/{ticketID}', [InquiryController::class, 'viewInquiry'])->name('admin.inquiry.viewInquiry');

// Route::put('/admin/inquiry/{ticketID}/status', [InquiryController::class, 'updateStatus'])->name('admin.inquiry.updateStatus');

// Route::delete('/admin/inquiry/{ticketID}', [InquiryController::class, 'deleteInquiry'])->name('admin.inquiry.delete');

// Route::post('/admin/inquiries/{ticketID}/reply', [InquiryController::class, 'reply'])->name('admin.inquiry.reply');

// //Route::get('/admin/inquiries/inquiries-callbacks', [InquiryController::class, 'viewInquiriesAndCallbacks'])->name('admin.inquiry.inquiriesCallbacks');


// Route::get('/admin/inquiry/callback/{id}', [InquiryController::class, 'viewCallback'])->name('admin.inquiry.viewCallback');

// Route::delete('/admin/inquiry/callback/{id}/delete', [InquiryController::class, 'deleteCallbackRequest'])->name('admin.inquiry.callback.delete');