<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDocument;
use App\Models\User;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'age',
        'city',
        'phone',
        'cnic',
        'postal_code',
        'status',
    ];

    /**
     * User who owns this application
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * documents attached to this application
     */
    public function documents()
    {
        return $this->hasMany(UserDocument::class, 'application_id');
    }
}
