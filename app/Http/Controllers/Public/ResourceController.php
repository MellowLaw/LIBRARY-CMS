<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ResourceLink;
use App\Models\Menu;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        $resourceLinks = ResourceLink::active()
            ->ordered()
            ->get()
            ->groupBy('category');

        $menus = Menu::visible()->topLevel()->get();

        return view('public.resources.index', compact('resourceLinks', 'menus'));
    }
}
