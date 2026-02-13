<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    public function view($id)
    {
        $attachment = Attachment::findOrFail($id);

        $path = storage_path('app/' . $attachment->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->file($path, [
            'Content-Type' => $attachment->mime_type
        ]);
    }

    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);

        $path = storage_path('app/' . $attachment->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path, $attachment->original_name);
    }
}
