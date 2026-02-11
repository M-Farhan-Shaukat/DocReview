<?php

use App\Http\Controllers\Admin\AdminAttachmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:Admin,Manager,Staff'])->name('admin.')->group(function () {

    // List attachments
    Route::get('/attachments', [AdminAttachmentController::class, 'index'])
        ->name('attachments');

    // Upload attachment
    Route::post('/attachments', [AdminAttachmentController::class, 'store'])
        ->name('attachments.store');

    // ✅ DOWNLOAD ROUTE - Add this!
    Route::get('/attachments/{id}/download', [AdminAttachmentController::class, 'download'])
        ->name('attachments.download');

    // Preview route
    Route::get('/attachments/{id}/preview', [AdminAttachmentController::class, 'preview'])
        ->name('attachments.preview');

    // Toggle status
    Route::post('/attachments/{id}/toggle', [AdminAttachmentController::class, 'toggle'])
        ->name('attachments.toggle');

    // Delete attachment
    Route::delete('/attachments/{id}', [AdminAttachmentController::class, 'destroy'])
        ->name('attachments.destroy');
});
