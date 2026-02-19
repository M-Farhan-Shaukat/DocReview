<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DocumentController;


Route::get('/applications', [DocumentController::class, 'index'])->name('applications.index');
Route::get('/application/{id}', [DocumentController::class, 'show'])->name('application.view');
Route::get('application', [DocumentController::class, 'applicationForm'])->name('application.create');
Route::post('application/{id}/upload', [DocumentController::class, 'uploadDocuments'])->name('application.upload');
Route::post('application/{id}/submit', [DocumentController::class, 'submitApplication'])->name('application.submit');
Route::get('document/{id}/preview', [DocumentController::class, 'preview'])->name('document.preview');
