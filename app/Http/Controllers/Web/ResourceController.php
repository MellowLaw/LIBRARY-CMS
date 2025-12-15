<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ResourceLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,librarian')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = ResourceLink::orderBy('display_order')
            ->orderBy('category')
            ->orderBy('title')
            ->paginate(15);

        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'is_external' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        ResourceLink::create($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Resource link added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResourceLink $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceLink $resource)
    {
        return view('resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResourceLink $resource)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'is_external' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $resource->update($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Resource link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResourceLink $resource)
    {
        $resource->delete();

        return redirect()->route('resources.index')
            ->with('success', 'Resource link deleted successfully.');
    }
}
