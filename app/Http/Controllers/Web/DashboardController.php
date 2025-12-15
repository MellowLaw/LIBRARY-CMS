<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\StaffProfile;
use App\Models\ResourceLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $totalPages = Page::count();
        $publishedPages = Page::where('is_published', true)->count();
        $staffCount = StaffProfile::count();
        $resourceCount = ResourceLink::count();
        
        $recentPages = Page::with('creator')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPages',
            'publishedPages',
            'staffCount',
            'resourceCount',
            'recentPages'
        ));
    }
}
