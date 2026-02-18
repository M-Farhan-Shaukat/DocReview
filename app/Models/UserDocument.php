<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'attachment_id',
        'application_id',
        'original_name',
        'file_path',
        'file_size',
        'mime_type',
        'document_type',
        'status',
        'notes',
        'rejection_reason',
        'reviewed_at',
        'reviewed_by',
        'verified_at',
        'verified_by'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'verified_at' => 'datetime',
        'file_size' => 'integer'
    ];

    protected $appends = [
        'formatted_size',
        'file_icon',
        'status_color',
        'status_text'
    ];

    /**
     * Get the user who uploaded the document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related attachment (template/document from admin).
     */
    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    /**
     * Get the reviewer (staff).
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the verifier (manager).
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Get file icon based on mime type.
     */
    public function getFileIconAttribute()
    {
        $extension = strtolower(pathinfo($this->original_name, PATHINFO_EXTENSION));

        $icons = [
            'pdf' => 'bi-file-earmark-pdf',
            'doc' => 'bi-file-earmark-word',
            'docx' => 'bi-file-earmark-word',
            'xls' => 'bi-file-earmark-excel',
            'xlsx' => 'bi-file-earmark-excel',
            'jpg' => 'bi-file-earmark-image',
            'jpeg' => 'bi-file-earmark-image',
            'png' => 'bi-file-earmark-image',
            'txt' => 'bi-file-earmark-text',
            'zip' => 'bi-file-earmark-zip',
            'rar' => 'bi-file-earmark-zip',
        ];

        return $icons[$extension] ?? 'bi-file-earmark';
    }

    /**
     * Get status color for UI.
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'under_review' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'verified' => 'primary',
            'completed' => 'success',
            default => 'secondary'
        };
    }

    /**
     * Get formatted status text.
     */
    public function getStatusTextAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Check if document is pending review.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if document is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if document is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Scope for pending documents.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved documents.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for documents under review.
     */
    public function scopeUnderReview($query)
    {
        return $query->where('status', 'under_review');
    }

    /**
     * Scope for documents that need payment verification.
     */
    public function scopeNeedsVerification($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for user's documents.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
