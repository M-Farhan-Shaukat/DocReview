<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    public function download($id)
    {

        $attachment = Attachment::where('id', $id)->firstOrFail();
        $path = storage_path('app/' . $attachment->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path, $attachment->original_name);
    }
}
