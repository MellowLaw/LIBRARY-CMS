<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    // Middleware is handled in routes/web.php or via constructor if needed


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->validated();

        $page = Page::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->has('is_published') ? now() : null,
            'scheduled_at' => $request->filled('scheduled_at') ? $request->scheduled_at : null,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        // Removed authorization check
        $page->load(['creator', 'sections']);

        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        // Removed authorization check
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        // Removed authorization check
        $data = $request->validated();

        // Check if this is a publish-only request (from Quick Actions) or a full update
        if (isset($data['title'])) {
            // Full update with content
            $page->fill([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'updated_by' => Auth::id(),
            ]);
        }

        // Handle publish/schedule logic via Model helpers or direct attribute setting
        if ($request->has('is_published') && $request->boolean('is_published')) {
            if (!$page->is_published) {
                // Changing from draft to published
                $page->publish(); // Uses model method
            } else {
                // Already published, just save any content updates
                $page->save();
            }
        } elseif ($request->filled('scheduled_at')) {
            // Scheduling
            $page->schedulePublish($request->scheduled_at);
        } else {
            // Saving as draft or updating existing draft/published state without changing status
            $page->save();
        }

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Removed authorization check
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
