<?php

require __DIR__ . '/userAuth.web.php';
// All user routes require authentication and User role
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    // Dashboard
    require __DIR__ . '/dashboard.web.php';
    require __DIR__ . '/profile.web.php';
    require __DIR__ . '/attachment.web.php';
    require __DIR__ . '/applications.web.php';

});
