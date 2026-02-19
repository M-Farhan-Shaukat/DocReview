<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'filename',
        'original_name',
        'mime_type',
        'file_size',
        'type',
        'file_path',
        'is_active'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_active' => 'boolean'
    ];
public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 1) . ' ' . $units[$i];
    }

    public function getFileIconAttribute()
    {
        $extension = pathinfo($this->original_name, PATHINFO_EXTENSION);

        return match(strtolower($extension)) {
            'pdf' => 'bi-file-earmark-pdf',
            'doc', 'docx' => 'bi-file-earmark-word',
            'xls', 'xlsx' => 'bi-file-earmark-excel',
            'ppt', 'pptx' => 'bi-file-earmark-ppt',
            'jpg', 'jpeg', 'png', 'gif' => 'bi-file-earmark-image',
            'zip', 'rar' => 'bi-file-earmark-zip',
            default => 'bi-file-earmark'
        };
    }

    public function getFileColorAttribute()
    {
        $extension = pathinfo($this->original_name, PATHINFO_EXTENSION);

        return match(strtolower($extension)) {
            'pdf' => 'primary',
            'doc', 'docx' => 'primary',
            'xls', 'xlsx' => 'success',
            'ppt', 'pptx' => 'warning',
            'jpg', 'jpeg', 'png', 'gif' => 'info',
            'zip', 'rar' => 'secondary',
            default => 'dark'
        };
    }
}
