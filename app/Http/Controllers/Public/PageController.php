<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;
use App\Models\Menu;
use App\Models\StaffProfile;
use App\Models\ResourceLink;
use App\Models\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the public home page.
     */
    public function home()
    {
        $books = Book::published()
            ->latest()
            ->limit(3)
            ->get();

        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        $pages = Page::published()
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        $staff = StaffProfile::published()
            ->ordered()
            ->limit(6)
            ->get();

        $resources = ResourceLink::active()
            ->ordered()
            ->limit(10)
            ->get();

        $menus = Menu::visible()
            ->topLevel()
            ->get();

        return view('public.home', compact('books', 'news', 'pages', 'staff', 'resources', 'menus'));
    }

    /**
     * Display a published page.
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->published()
            ->with(['creator', 'sections'])
            ->firstOrFail();

        $menus = Menu::visible()
            ->topLevel()
            ->get();

        return view('public.page', compact('page', 'menus'));
    }
}
