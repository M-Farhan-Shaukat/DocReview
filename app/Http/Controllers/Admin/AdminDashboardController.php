<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralDocuments;
use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\User;
use App\Models\Role;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get statistics
        $attachments = GeneralDocuments::whereIn('type', ['agreement','challan'])
            ->where('is_active', true)
            ->orderBy('created_at','desc');

        $totalFiles = (clone $attachments)->count();
        $activeFiles = (clone $attachments)->where('is_active', true)->count();
        $inactiveFiles = (clone $attachments)->where('is_active', false)->count();
        $totalUsers = User::where('role_id','!=', 1)->count();

        // Get users by role
        $usersByRole = [];
        $roles = Role::withCount('users')->get();
        foreach ($roles as $role) {
            $usersByRole[$role->name] = $role->users_count;
        }

        // Get recent files
        $recentFiles = $attachments->get();

        // Get recent users
        $recentUsers = User::with('role')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Calculate storage used
        $storageUsed = Attachment::sum('file_size');
        $storageUsedMB = round($storageUsed / (1024 * 1024), 2);

        return view('admin.dashboard', compact(
            'totalFiles',
            'activeFiles',
            'inactiveFiles',
            'totalUsers',
            'usersByRole',
            'recentFiles',
            'recentUsers',
            'storageUsedMB'
        ));
    }

    /**
     * Display system statistics.
     */
    public function statistics()
    {
        // More detailed statistics
        $stats = [
            'files_by_type' => $this->getFilesByType(),
            'users_by_status' => $this->getUsersByStatus(),
            'monthly_uploads' => $this->getMonthlyUploads(),
        ];

        return view('admin.statistics', compact('stats'));
    }

    /**
     * Get files grouped by type.
     */
    private function getFilesByType()
    {
        return Attachment::selectRaw('SUBSTRING_INDEX(original_name, ".", -1) as extension, COUNT(*) as count')
            ->groupBy('extension')
            ->orderByDesc('count')
            ->get();
    }

    /**
     * Get users grouped by status/role.
     */
    private function getUsersByStatus()
    {
        return User::selectRaw('roles.name as role_name, COUNT(*) as count')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->groupBy('roles.name')
            ->get();
    }

    /**
     * Get monthly upload statistics.
     */
    private function getMonthlyUploads()
    {
        return Attachment::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get();
    }
}
