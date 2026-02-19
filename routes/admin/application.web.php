<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApplicationController;
Route::get('/applications',[ApplicationController::class, 'index'])->name('applications.index');
Route::get('applications/pending',[ApplicationController::class, 'PendingApplications'])->name('applications.pending');
Route::get('applications/reject',[ApplicationController::class, 'rejectedApplications'])->name('applications.reject');
Route::get('applications/approved',[ApplicationController::class, 'approvedApplications'])->name('applications.approved');

// View single application
Route::get('/applications/{id}',[ApplicationController::class, 'show'])->name('applications.show');

// Approve
Route::post('/applications/{id}/approve',[ApplicationController::class, 'approve'])->name('applications.approve');

// Reject
Route::post('/applications/{id}/reject',[ApplicationController::class, 'reject'])->name('applications.reject');

Route::get('/documents/{id}/preview',[ApplicationController::class, 'preview'])->name('document.preview');
