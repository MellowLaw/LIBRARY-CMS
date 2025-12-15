<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $featuredBooks = []; // Replace with actual query to get featured books
        $categories = []; // Replace with actual query to get categories
        
        return view('library.index', compact('featuredBooks', 'categories'));
    }

    public function explore(Request $request)
    {
        $query = Book::query();
        
        // Add search functionality
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Add category filter
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        $books = $query->paginate(12);
        $categories = []; // Replace with actual query to get categories
        
        return view('library.explore', compact('books', 'categories'));
    }

    public function details($id)
    {
        $book = []; // Replace with actual query to get book by ID
        $relatedBooks = []; // Replace with related books query
        
        if (!$book) {
            abort(404);
        }
        
        return view('library.details', compact('book', 'relatedBooks'));
    }

    public function author($id)
    {
        $author = []; // Replace with actual query to get author by ID
        $books = []; // Replace with author's books query
        
        if (!$author) {
            abort(404);
        }
        
        return view('library.author', compact('author', 'books'));
    }

    public function create()
    {
        $categories = []; // Replace with actual query to get categories
        return view('library.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'cover' => 'required|image|max:5120', // 5MB max
            'publication_date' => 'nullable|date',
            'isbn' => 'nullable|string|unique:books,isbn'
        ]);

        // Handle file upload
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('book_covers', 'public');
            $validated['cover_path'] = $path;
        }

        // Create book (replace with actual model and fields)
        // Book::create($validated);

        return redirect()->route('library.index')
                         ->with('success', 'Book added successfully!');
    }
}