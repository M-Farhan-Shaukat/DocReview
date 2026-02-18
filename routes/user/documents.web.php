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

Route::get('/applications', [DocumentController::class, 'index'])
    ->name('applications.index');
Route::get('/application/{id}', [DocumentController::class, 'show'])
    ->name('application.view');

Route::get('application', [DocumentController::class, 'applicationForm'])->name('application.create');
Route::post('application/{id}/upload', [DocumentController::class, 'uploadDocuments'])->name('application.upload');
Route::post('application/{id}/submit', [DocumentController::class, 'submitApplication'])->name('application.submit');
Route::get('document/{id}/preview', [DocumentController::class, 'preview'])->name('document.preview');
