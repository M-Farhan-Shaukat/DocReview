<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralDocuments extends Model
{

    protected $table = 'general_documents';
    protected $fillable = [
        'name',
        'slug',
        'type',
        'is_active',
        'sort_order',
        'created_by',
    ];
}

