<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\AttachmentController;
use Illuminate\Support\Facades\Route;

// All user routes require authentication and User role
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:User')
        ->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])
        ->middleware('role:User')
        ->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->middleware('role:User')
        ->name('profile.update');

    // Document Management
    Route::get('/documents', [DocumentController::class, 'index'])
        ->middleware('role:User')
        ->name('documents');
    Route::get('/documents/upload', [DocumentController::class, 'create'])
        ->middleware('role:User')
        ->name('documents.upload');
    Route::post('/documents/upload', [DocumentController::class, 'store'])
        ->middleware('role:User')
        ->name('documents.store');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])
        ->middleware('role:User')
        ->name('documents.delete');

    // Application Status
    Route::get('/application/status', [DashboardController::class, 'status'])
        ->middleware('role:User')
        ->name('application.status');
    Route::get('/application/track', [DashboardController::class, 'track'])
        ->middleware('role:User')
        ->name('application.track');

    // Agreement & Payment
    Route::get('/agreement/view', [DocumentController::class, 'agreement'])
        ->middleware('role:User')
        ->name('agreement.view');
    Route::post('/agreement/sign', [DocumentController::class, 'signAgreement'])
        ->middleware('role:User')
        ->name('agreement.sign');
    Route::get('/payment/upload', [DocumentController::class, 'paymentForm'])
        ->middleware('role:User')
        ->name('payment.upload');
    Route::post('/payment/upload', [DocumentController::class, 'uploadPayment'])
        ->middleware('role:User')
        ->name('payment.store');

    // Attachment Downloads
    Route::get('/download/{file}', [AttachmentController::class, 'download'])
        ->middleware('role:User')
        ->name('download');
    Route::get('/view/{file}', [AttachmentController::class, 'view'])
        ->middleware('role:User')
        ->name('view');
});

// Public attachment download (still requires auth)
Route::get('/user-attachments/{file}', [AttachmentController::class, 'downloadPublic'])
    ->name('user.attachments.download')
    ->middleware('auth');
