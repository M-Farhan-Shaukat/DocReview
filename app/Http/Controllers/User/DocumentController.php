<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    // List user documents
    public function index()
    {
        $documents = UserDocument::where('user_id', Auth::id())
            ->with('attachment')
            ->latest()
            ->paginate(10);

        return view('user.documents.index', compact('documents'));
    }

    // Show upload form
    public function create()
    {
        $attachments = Attachment::where('is_active', true)->get();
        return view('user.documents.upload', compact('attachments'));
    }

    // Store uploaded document
    public function store(Request $request)
    {
        $validated = $request->validate([
            'attachment_id' => 'required|exists:attachments,id',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
            'notes' => 'nullable|string|max:500',
        ]);

        $file = $request->file('document');
        $path = $file->store('user_documents/' . Auth::id(), 'public');

        UserDocument::create([
            'user_id' => Auth::id(),
            'attachment_id' => $validated['attachment_id'],
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('user.documents.index')
            ->with('success', 'Document uploaded successfully!');
    }

    // Delete a document
    public function destroy($id)
    {
        $document = UserDocument::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        Storage::disk('public')->delete($document->file_path);

        $document->delete();

        return back()->with('success', 'Document deleted successfully!');
    }

    // Preview document in modal
    public function preview($id)
    {
        $document = UserDocument::where('user_id', auth()->id())->findOrFail($id);

        $path = storage_path('app/public/' . $document->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        $extension = strtolower(pathinfo($document->original_name, PATHINFO_EXTENSION));
        $viewable = ['pdf', 'jpg', 'jpeg', 'png'];

        if (!in_array($extension, $viewable)) {
            return response('Preview not available for this file type.', 403);
        }

        // For images, return a direct file response
        if (in_array($extension, ['jpg','jpeg','png'])) {
            return response()->file($path, [
                'Content-Type' => $document->mime_type,
            ]);
        }

        // For PDF, also use file response (works in iframe)
        if ($extension === 'pdf') {
            return response()->file($path, [
                'Content-Type' => $document->mime_type,
            ]);
        }
    }


    // Show agreement
    public function agreement()
    {
        $agreement = Attachment::where('type', 'agreement')->where('is_active', true)->first();
        return view('user.documents.agreement', compact('agreement'));
    }

    // Sign agreement (upload signed copy)
    public function signAgreement(Request $request)
    {
        $request->validate([
            'signed_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $file = $request->file('signed_file');
        $path = $file->store('signed_agreements/' . Auth::id(), 'public');

        UserDocument::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'attachment_id' => $request->attachment_id
            ],
            [
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'status' => 'pending',
            ]
        );

        return redirect()->route('user.dashboard')
            ->with('success', 'Agreement signed successfully!');
    }

    // Show payment upload form
    public function paymentForm()
    {
        return view('user.documents.payment');
    }

    // Upload payment slip
    public function uploadPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_slip' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'transaction_id' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        $file = $request->file('payment_slip');
        $path = $file->store('payment_slips/' . Auth::id(), 'public');

        UserDocument::create([
            'user_id' => Auth::id(),
            'attachment_id' => null,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'notes' => 'Payment slip',
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Payment slip uploaded successfully!');
    }
}
