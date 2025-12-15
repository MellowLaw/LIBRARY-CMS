<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        // Middleware is now handled in routes
    }

    // List all pages
    public function index()
    {
        $pages = Page::with(['creator', 'sections'])
                     ->orderBy('created_at', 'desc')
                     ->paginate(15);

        return response()->json([
            'status' => 'success',
            'data' => $pages->items(),
            'meta' => [
                'current_page' => $pages->currentPage(),
                'total' => $pages->total(),
                'per_page' => $pages->perPage(),
                'total_pages' => $pages->lastPage(),
            ]
        ]);
    }

    // Show single page
    public function show(Page $page)
    {
        $this->authorize('view', $page);

        return response()->json([
            'status' => 'success',
            'data' => $page->load(['creator', 'sections']),
        ]);
    }

    // Create page
    public function store(StorePageRequest $request)
    {
        $this->authorize('create', Page::class);

        $page = Page::create([
            ...$request->validated(),
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Page created successfully',
            'data' => $page,
        ], 201);
    }

    // Update page
    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->authorize('update', $page);

        $page->update([
            ...$request->validated(),
            'updated_by' => auth()->id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Page updated successfully',
            'data' => $page,
        ]);
    }

    // Delete page
    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);

        $page->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Page deleted successfully',
        ]);
    }

    // Publish page
    public function publish(Request $request, Page $page)
    {
        $this->authorize('update', $page);

        $page->publish();

        return response()->json([
            'status' => 'success',
            'message' => 'Page published successfully',
            'data' => $page,
        ]);
    }

    // Schedule page publication
    public function schedule(Request $request, Page $page)
    {
        $this->authorize('update', $page);

        $validated = $request->validate([
            'scheduled_at' => 'required|date|after:now',
        ]);

        $page->schedulePublish($validated['scheduled_at']);

        return response()->json([
            'status' => 'success',
            'message' => 'Page publication scheduled successfully',
            'data' => $page,
        ]);
    }

    // Get published pages (public endpoint)
    public function published()
    {
        $pages = Page::published()
                     ->with(['creator', 'sections'])
                     ->orderBy('published_at', 'desc')
                     ->paginate(15);

        return response()->json([
            'status' => 'success',
            'data' => $pages->items(),
            'meta' => [
                'current_page' => $pages->currentPage(),
                'total' => $pages->total(),
                'per_page' => $pages->perPage(),
                'total_pages' => $pages->lastPage(),
            ]
        ]);
    }
}
