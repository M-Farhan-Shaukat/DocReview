<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AdminAttachmentController extends Controller
{
    // Show admin upload page
    public function index()
    {
        // Fetch all attachments for admin to manage if you want
        $attachments = Attachment::orderBy('created_at', 'desc')->get();

        return view('admin.attachments', compact('attachments'));
    }

    // Handle admin upload
    public function store(Request $request)
    {
        $request->validate([
            'attachment' => 'required|file|max:10240', // 10 MB max
        ]);

        $file = $request->file('attachment');
        $originalName = $file->getClientOriginalName();
        $filename = uniqid() . '_' . $originalName;
        $path = $file->storeAs('public/attachments', $filename);

        // Save attachment in database
        Attachment::create([
            'filename'      => $filename,
            'original_name' => $originalName,
            'mime_type'     => $file->getMimeType(),
            'file_size'     => $file->getSize(),
            'file_path'     => $path,
            'is_active'     => true, // file is automatically available to users
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    public function toggle($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->is_active = !$attachment->is_active;
        $attachment->save();

        return redirect()->back()->with('success', 'Attachment status updated.');
    }

    // Delete attachment
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Delete file from storage
        if (Storage::exists($attachment->file_path)) {
            Storage::delete($attachment->file_path);
        }

        $attachment->delete();

        return redirect()->back()->with('success', 'Attachment deleted successfully.');
    }
    /**
     * Preview attachment in browser modal.
     */
    public function preview($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Check if file exists
        if (!Storage::exists($attachment->file_path)) {
            abort(404, 'File not found.');
        }

        // Get file content
        $fileContent = Storage::get($attachment->file_path);
        $mimeType = $attachment->mime_type;

        // Return file for inline preview
        return Response::make($fileContent, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $attachment->original_name . '"',
        ]);
    }
    /**
     * Download attachment.
     */
    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Check if file exists
        if (!Storage::exists($attachment->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::download($attachment->file_path, $attachment->original_name);
    }
}
