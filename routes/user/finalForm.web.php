<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FinalFormController;

Route::get('/final_forms', [FinalFormController::class, 'index'])->name('final_form.index');
Route::get('/final-form', [FinalFormController::class, 'create'])->name('final_form.create');
Route::post('/final-form/store', [FinalFormController::class, 'store'])->name('final-form.store');
Route::get('/final_form/{id}', [FinalFormController::class, 'show'])->name('final_form.view');
Route::get('/user/form/download/{application}', [FinalFormController::class, 'downloadPdf'])->name('form.download');
