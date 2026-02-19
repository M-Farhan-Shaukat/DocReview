<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDownloadedDocuments extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'unique_id',
        'downloaded_at',
        'expiry_date',
    ];

}
