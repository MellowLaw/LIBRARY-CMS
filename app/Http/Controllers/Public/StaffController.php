<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StaffProfile;
use App\Models\Menu;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index()
    {
        $staffMembers = StaffProfile::published()
            ->ordered()
            ->get();

        $menus = Menu::visible()->topLevel()->get();

        return view('public.staff.index', compact('staffMembers', 'menus'));
    }
}
