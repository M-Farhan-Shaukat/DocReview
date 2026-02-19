<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralDocuments;
use App\Models\UserDownloadedDocuments;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use App\Models\Attachment;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{

    public function index()
    {
        $applications = Application::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.application.index', compact('applications'));
    }
    public function show($id)
    {
        $application = Application::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('documents.attachment')
            ->firstOrFail();

        return view('user.application.show', compact('application'));
    }
    // Show or create draft application
    public function applicationForm()
    {
        $user = Auth::user();

        // Draft application create ya fetch
        $application = Application::firstOrCreate(
            [
                'user_id' => $user->id,
                'status' => 'draft',
            ],
            [
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
                'city' => $user->city,
                'phone' => $user->phone,
                'cnic' => $user->cnic,
                'postal_code' => $user->postal_code,
            ]
        );

        $attachments = GeneralDocuments::whereIn('type', ['agreement','challan'])
            ->where('is_active', true)
            ->orderBy('created_at','desc')
            ->get();

        $documents = $application->documents()->get();

        return view('user.application.create', compact('application', 'attachments', 'documents','user'));
    }

    // Final submit of application
    public function submitApplication(Request $request, $applicationId)
    {
        $user = auth()->user();

        // Fetch active admin attachments
        $attachments = GeneralDocuments::whereIn('type', ['agreement','challan'])
            ->where('is_active', true)
            ->orderBy('created_at','desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        $rules = [];

        foreach ($attachments as $attachment) {
            $rules['documents.' . $attachment->id] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240';
        }

        $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Create or Update Application
        |--------------------------------------------------------------------------
        */

        $uniqueId = UserDownloadedDocuments::where(['user_id'=>auth()->id(),'document_type' => 'challan'])->first()->unique_id;
            $application = Application::create([
                'user_id'     => $user->id,
                'name'        => $user->name,
                'email'       => $user->email,
                'city'        => $user->city,
                'cnic'        => $user->cnic,
                'status'      => 'pending'
            ]);


        /*
        |--------------------------------------------------------------------------
        | Store documents Against Admin Attachments
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('documents')) {

            foreach ($request->file('documents') as $attachmentId => $file) {

                $path = $file->store(
                    'applications/' . $application->id,
                    'public'
                );

                UserDocument::updateOrCreate(
                    [
                        'application_id' => $application->id,
                        'general_document_id'  => $attachmentId
                    ],
                    [
                        'unique_id'       => $uniqueId,
                        'user_id'       => $user->id,
                        'original_name' => $file->getClientOriginalName(),
                        'file_path'     => $path,
                        'file_size'     => $file->getSize(),
                        'mime_type'     => $file->getMimeType(),
                        'status'        => 'pending'
                    ]
                );
            }
        }

        return redirect()
            ->route('user.applications.index')
            ->with('success', 'Application submitted successfully.');
    }

    // Preview document
    public function preview($id)
    {
        $document = UserDocument::where('user_id', Auth::id())->findOrFail($id);

        $path = storage_path('app/public/' . $document->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        $extension = strtolower(pathinfo($document->original_name, PATHINFO_EXTENSION));
        $viewable = ['pdf', 'jpg', 'jpeg', 'png'];

        if (!in_array($extension, $viewable)) {
            return response('Preview not available for this file type.', 403);
        }

        return response()->file($path, [
            'Content-Type' => $document->mime_type,
        ]);
    }
}
