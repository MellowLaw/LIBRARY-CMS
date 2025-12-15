<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index()
{
    try {
        $featuredBooks = Book::with(['author', 'category'])
            ->take(4)
            ->get();
            
        $categories = Category::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(6)
            ->get();
    } catch (\Exception $e) {
        $featuredBooks = collect();
        $categories = collect();
    }
    
    return view('library.index', compact('featuredBooks', 'categories'));
}

    public function explore(Request $request)
    {
        $query = Book::with(['author', 'category']);
        
        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($category = $request->query('category')) {
            $query->where('category_id', $category);
        }
        
        $books = $query->latest()->paginate(12);
        $categories = Category::all();
        
        return view('library.explore', compact('books', 'categories'));
    }

    public function details($id)
    {
        $book = Book::with(['author', 'category'])->findOrFail($id);
        
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();
        
        return view('library.details', compact('book', 'relatedBooks'));
    }

    public function author($id)
    {
        $author = Author::findOrFail($id);
        $books = $author->books()->with('category')->paginate(12);
        
        return view('library.author', compact('author', 'books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('library.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'cover' => 'required|image|max:5120', // 5MB max
            'publication_date' => 'nullable|date',
            'isbn' => 'nullable|string|unique:books,isbn'
        ]);

        // Find or create author
        $author = Author::firstOrCreate(
            ['name' => $validated['author']],
            ['slug' => Str::slug($validated['author'])]
        );

        // Handle file upload
        $coverPath = $request->file('cover')->store('book_covers', 'public');

        // Create book
        $book = Book::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'isbn' => $validated['isbn'] ?? null,
            'cover_image' => $coverPath,
            'publication_date' => $validated['publication_date'] ?? null,
            'quantity' => $validated['quantity'],
            'category_id' => $validated['category_id'],
            'author_id' => $author->id,
        ]);

        return redirect()->route('library.index')
                         ->with('success', 'Book added successfully!');
    }
}