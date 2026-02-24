<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FinalFormController;

Route::get('/final-form/review',[FinalFormController::class, 'review'])->name('final.review');

//Route::post('/final-form/submit',[FinalFormController::class, 'submit'])->name('final.submit');
Route::get('/user/final-form/preview',
    [FinalFormController::class, 'formPreview'])
    ->name('final.preview');

Route::get('/final_forms', [FinalFormController::class, 'index'])->name('final_form.index');
Route::get('/final_form/{id}', [FinalFormController::class, 'show'])->name('final_form.view');

Route::post('final_form/{id}/upload', [FinalFormController::class, 'uploadDocuments'])->name('final_form.upload');




Route::get('/final-form', [FinalFormController::class, 'create'])->name('final_form.create');
Route::post('/final-form/preview', [FinalFormController::class, 'preview'])
    ->name('final-form.preview');

Route::post('/final-form/store', [FinalFormController::class, 'store'])
    ->name('final-form.store');

Route::get('/user/form/download/{application}', [FinalFormController::class, 'downloadPdf'])
    ->name('form.download');
