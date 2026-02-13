<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\UserDocument;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get active attachments for users
            $attachments = Attachment::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();

            // Get user's documents if UserDocument model exists
            $userDocuments = [];
            $uploadedCount = 0;
            $pendingCount = 0;
            $approvedCount = 0;

            if (class_exists(UserDocument::class)) {
                $userDocuments = UserDocument::where('user_id', auth()->id())
                    ->latest()
                    ->get();

                $uploadedCount = $userDocuments->count();
                $pendingCount = $userDocuments->where('status', 'pending')->count();
                $approvedCount = $userDocuments->where('status', 'approved')->count();
            }

            return view('user.dashboard', compact(
                'attachments',
                'userDocuments',
                'uploadedCount',
                'pendingCount',
                'approvedCount'
            ));

        } catch (\Exception $e) {
            // If there's an error, show basic dashboard
            \Log::error('Dashboard error: ' . $e->getMessage());

            return view('user.dashboard', [
                'attachments' => [],
                'userDocuments' => [],
                'uploadedCount' => 0,
                'pendingCount' => 0,
                'approvedCount' => 0
            ]);
        }
    }

    public function status()
    {
        return view('user.status');
    }

    public function track()
    {
        return view('user.track');
    }
}
