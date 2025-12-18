<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display the public book catalog.
     */
    public function index(Request $request)
    {
        $query = Book::with('category')->published();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by category (only if category has a value)
        if ($request->filled('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $books = $query->paginate(12);
        $categories = Category::has('books')->get();

        $borrowedBookIds = [];
        if (Auth::check()) {
            $borrowedBookIds = \App\Models\Loan::where('user_id', Auth::id())
                ->whereNull('returned_date')
                ->pluck('book_id')
                ->toArray();
        }

        return view('public.books.index', compact('books', 'categories', 'borrowedBookIds'));
    }

    /**
     * Display a specific book detail.
     */
    public function show(Book $book)
    {
        if (!$book->is_published) {
            abort(404);
        }

        $book->load('category');
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->published()
            ->limit(4)
            ->get();

        $isBorrowed = false;
        if (Auth::check()) {
            $isBorrowed = \App\Models\Loan::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->whereNull('returned_date')
                ->exists();
        }

        return view('public.books.show', compact('book', 'relatedBooks', 'isBorrowed'));
    }
}
