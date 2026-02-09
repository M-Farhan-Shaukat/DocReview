<?php

use App\Http\Controllers\Admin\AdminAttachmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:Admin,Manager,Staff'])->group(function () {
    Route::get('/attachments', [AdminAttachmentController::class, 'index'])
        ->name('admin.attachments');

    Route::post('/attachments', [AdminAttachmentController::class, 'store'])
        ->name('admin.attachments.store');

    Route::post('/attachments/{id}/toggle', [AdminAttachmentController::class, 'toggle'])
        ->name('admin.attachments.toggle');

    Route::delete('/attachments/{id}', [AdminAttachmentController::class, 'destroy'])
        ->name('admin.attachments.destroy');
});
