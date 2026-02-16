<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'age',
        'city',
        'phone',
        'cnic',
        'postal_code',
        'email_verification_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        if (!$this->role) return false;
        return $this->role->name === $roleName;
    }

    public function hasPermission($permission)
    {
        if ($this->hasRole('Admin')) return true;

        if (!$this->role || !isset($this->role->permissions)) {
            return false;
        }

        return in_array($permission, $this->role->permissions);
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    /**
     * Get the user's pending documents.
     */
    public function pendingDocuments()
    {
        return $this->documents()->pending();
    }

    /**
     * Get the user's approved documents.
     */
    public function approvedDocuments()
    {
        return $this->documents()->approved();
    }

    /**
     * Get the user's completed applications.
     */
    public function completedApplications()
    {
        return $this->documents()->where('status', 'completed');
    }

    /**
     * Check if user has uploaded any documents.
     */
    public function hasUploadedDocuments()
    {
        return $this->documents()->count() > 0;
    }

    /**
     * Get the user's current application status.
     */
    public function getApplicationStatusAttribute()
    {
        $latestDocument = $this->documents()->latest()->first();

        if (!$latestDocument) {
            return 'not_started';
        }

        return $latestDocument->status;
    }
}
