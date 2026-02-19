<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request, $status = null)
    {
        $query = Application::with('user')->latest();
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $perPage = $request->get('per_page', 10);

        $applications = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.applications.index', compact('applications', 'status'));
    }
    public function PendingApplications(Request $request, $status = null)
    {
        $query = Application::with('user')->where('status', 'pending')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $perPage = $request->get('per_page', 10);

        $applications = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.applications.index', compact('applications', 'status'));
    }
    public function rejectedApplications(Request $request, $status = null)
    {
        $query = Application::with('user')->where('status', 'rejected')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $perPage = $request->get('per_page', 10);

        $applications = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.applications.index', compact('applications', 'status'));
    }
    public function approvedApplications(Request $request, $status = null)
    {
        $query = Application::with('user')->where('status', 'approved')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $perPage = $request->get('per_page', 10);

        $applications = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.applications.index', compact('applications', 'status'));
    }
    public function show($id)
    {
        $application = Application::with('user')
            ->findOrFail($id);

        $documents = UserDocument::where('application_id', $id)->get();

        return view('admin.applications.show', compact('application', 'documents'));
    }

    // 🔹 Approve
    public function approve($id)
    {
        $application = Application::findOrFail($id);

        $application->status = 'approved';
        $application->save();

        return redirect()
            ->route('admin.applications.index')
            ->with('success', 'Application approved successfully.');
    }

    // 🔹 Reject
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $application = Application::findOrFail($id);

        $application->status = 'rejected';
        $application->rejection_reason = $request->reason;
        $application->save();

        return redirect()
            ->route('admin.applications.index')
            ->with('success', 'Application rejected successfully.');
    }

    public function preview($id)
    {
        $document = UserDocument::findOrFail($id);

        if (!Storage::disk('public')->exists($document->file_path)) {
            return response()->json([
                'message' => 'File not found.'
            ], 404);
        }

        $file = Storage::disk('public')->path($document->file_path);

        return response()->file($file);
    }
}
