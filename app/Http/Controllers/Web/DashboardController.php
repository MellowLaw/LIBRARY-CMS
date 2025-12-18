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

        // Viewers get their own dashboard view
        if (Auth::user()->role === 'viewer') {
            return view('dashboard.viewer');
        }

        $totalPages = \App\Models\Page::count();
        $publishedPages = \App\Models\Page::where('is_published', true)->count();
        $staffCount = \App\Models\StaffProfile::count();
        $resourceCount = \App\Models\ResourceLink::count();
        $newsCount = \App\Models\News::count();

        // Book Statistics
        $totalBooks = \App\Models\Book::count();
        $availableBooks = \App\Models\Book::sum('available_copies');
        $borrowedBooks = \App\Models\Loan::whereNull('returned_date')->count();

        $recentPages = \App\Models\Page::with('creator')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPages',
            'publishedPages',
            'staffCount',
            'resourceCount',
            'newsCount',
            'totalBooks',
            'availableBooks',
            'borrowedBooks',
            'recentPages'
        ));
    }
}
