<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DocumentController;

Route::get('/documents', [DocumentController::class, 'index'])
    ->name('documents.index');

Route::get('/upload', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/upload', [DocumentController::class, 'store'])->name('documents.store');

Route::delete('/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

Route::get('/documents/preview/{id}', [DocumentController::class, 'preview'])->name('documents.preview');
Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');

Route::get('/agreement', [DocumentController::class, 'agreement'])->name('documents.agreement');
Route::post('/agreement/sign', [DocumentController::class, 'signAgreement'])->name('adocuments.greement.sign');

Route::get('/payment', [DocumentController::class, 'paymentForm'])->name('payment');
Route::post('/payment/upload', [DocumentController::class, 'uploadPayment'])->name('documents.payment.upload');
