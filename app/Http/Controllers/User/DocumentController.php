<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = UserDocument::where('user_id', auth()->id())
            ->with('attachment')
            ->latest()
            ->paginate(10);

        return view('user.documents', compact('documents'));
    }

    public function create()
    {
        $attachments = Attachment::where('is_active', true)->get();
        return view('user.upload', compact('attachments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attachment_id' => 'required|exists:attachments,id',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'notes' => 'nullable|string|max:500',
        ]);

        // Store file
        $file = $request->file('document');
        $path = $file->store('user_documents/' . auth()->id(), 'public');

        // Create document record
        UserDocument::create([
            'user_id' => auth()->id(),
            'attachment_id' => $validated['attachment_id'],
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('user.documents')
            ->with('success', 'Document uploaded successfully! Waiting for approval.');
    }

    public function destroy($id)
    {
        $document = UserDocument::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        // Delete file
        Storage::disk('public')->delete($document->file_path);

        // Delete record
        $document->delete();

        return back()->with('success', 'Document deleted successfully!');
    }

    public function agreement()
    {
        $agreement = Attachment::where('type', 'agreement')
            ->where('is_active', true)
            ->first();

        return view('user.agreement', compact('agreement'));
    }

    public function signAgreement(Request $request)
    {
        // Handle agreement signing logic
        // Store signed agreement, update application status, etc.

        return redirect()->route('user.dashboard')
            ->with('success', 'Agreement signed successfully!');
    }

    public function paymentForm()
    {
        return view('user.payment');
    }

    public function uploadPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_slip' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'transaction_id' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        // Handle payment slip upload
        // Store file, create payment record, update application status

        return redirect()->route('user.dashboard')
            ->with('success', 'Payment slip uploaded! Waiting for verification.');
    }
}
