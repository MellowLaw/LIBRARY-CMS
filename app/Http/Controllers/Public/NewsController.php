<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Menu;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $menus = Menu::visible()->topLevel()->get();

        return view('public.news.index', compact('news', 'menus'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        $article = News::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $menus = Menu::visible()->topLevel()->get();

        return view('public.news.show', compact('article', 'menus'));
    }
}
