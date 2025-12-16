<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', News::class);
        $newsQuery = News::with('creator')->orderByDesc('created_at');

        if (request('search')) {
            $search = trim((string) request('search'));
            $newsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $news = $newsQuery->paginate(10)->withQueryString();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        return view('news.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', News::class);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:news,slug|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:4096',
        ]);

        $isPublished = $request->boolean('is_published');
        $publishedAt = null;
        if ($isPublished) {
            $publishedAt = isset($validated['published_at']) && $validated['published_at']
                ? $validated['published_at']
                : now();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        $news = News::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'image_path' => $imagePath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'News item created.');
    }

    public function show(News $news)
    {
        $this->authorize('view', $news);
        return redirect()->route('news.edit', $news);
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:news,slug,' . $news->id . '|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:4096',
        ]);

        $isPublished = $request->boolean('is_published');

        $publishedAt = null;
        if ($isPublished) {
            if (isset($validated['published_at']) && $validated['published_at']) {
                $publishedAt = $validated['published_at'];
            } elseif (!$news->published_at) {
                $publishedAt = now();
            } else {
                $publishedAt = $news->published_at;
            }
        }

        $imagePath = $news->image_path;
        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $imagePath = $request->file('image')->store('news', 'public');
        }

        $news->update([
            'title' => $validated['title'],
            // Only update slug if provided, otherwise keep existing or generate new from title if empty? 
            // Logic: if slug is provided, use it. If not, and it was empty, gen it. 
            // However, usually we keep the slug unless explicitly changed.
            'slug' => $validated['slug'] ?? $news->slug,
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'image_path' => $imagePath,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'News item updated.');
    }

    public function preview(News $news)
    {
        $this->authorize('view', $news);

        $menus = Menu::visible()->topLevel()->get();
        $article = $news;

        return view('public.news.show', compact('article', 'menus'));
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News item deleted.');
    }

    public function uploadEditorImage(Request $request): JsonResponse
    {
        $this->authorize('create', News::class);

        $validated = $request->validate([
            'file' => 'required|image|max:4096',
        ]);

        $path = $validated['file']->store('news-content', 'public');

        return response()->json([
            'location' => '/storage/' . $path,
        ]);
    }
}
