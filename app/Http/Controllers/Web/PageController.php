<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware; // 1. Import this
use Illuminate\Routing\Controllers\Middleware;
class PageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            // If you needed to exclude methods, you would do:
            // new Middleware('auth', except: ['index', 'show']),
        ];
    }

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
        $this->authorize('view', $page);
        
        $page->load(['creator', 'sections']);
        
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $this->authorize('update', $page);
        
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->authorize('update', $page);

        $data = $request->validated();
        
        $updateData = [
            'title' => $data['title'] ?? $page->title,
            'slug' => $data['slug'] ?? $page->slug,
            'meta_description' => $data['meta_description'] ?? $page->meta_description,
            'updated_by' => Auth::id(),
        ];
        
        // Handle publish action
        if ($request->has('is_published') && !$page->is_published) {
            $updateData['is_published'] = true;
            $updateData['published_at'] = now();
            $updateData['scheduled_at'] = null;
        }
        
        $page->update($updateData);

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);

        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
