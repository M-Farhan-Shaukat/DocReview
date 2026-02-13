<?php
use App\Http\Controllers\User\AttachmentController;
use Illuminate\Support\Facades\Route;


    Route::get('/attachments/view/{id}', [AttachmentController::class, 'view'])
        ->name('attachments.view');

    Route::get('/attachments/download/{id}', [AttachmentController::class, 'download'])
        ->name('attachments.download');


