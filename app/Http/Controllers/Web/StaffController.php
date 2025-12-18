<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\StaffProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Removed role middleware - allow all authenticated users
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = StaffProfile::orderBy('display_order')
            ->orderBy('name')
            ->paginate(15);

        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')
                ->store('staff', 'public');
        }

        StaffProfile::create($validated);

        return redirect()->route('staff.index')
            ->with('success', 'Staff member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffProfile $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffProfile $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffProfile $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($staff->profile_image) {
                Storage::disk('public')->delete($staff->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')
                ->store('staff', 'public');
        }

        $staff->update($validated);

        return redirect()->route('staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffProfile $staff)
    {
        if ($staff->profile_image) {
            Storage::disk('public')->delete($staff->profile_image);
        }

        $staff->delete();

        return redirect()->route('staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }
}
