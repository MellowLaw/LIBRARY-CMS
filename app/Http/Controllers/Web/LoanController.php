<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Borrow a book (create loan).
     */
    public function borrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Check availability
        if ($book->available_copies < 1) {
            return redirect()->back()->with('error', 'This book is currently unavailable.');
        }

        // Check if user already has an active loan for this book
        $existingLoan = Loan::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereNull('returned_date')
            ->first();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'You already have an active loan for this book.');
        }

        // Create loan
        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'checkout_date' => now(),
            'due_date' => now()->addDays(14), // 2 weeks
        ]);

        // Decrement available copies
        $book->decrement('available_copies');

        return redirect()->route('public.books.show', $book)->with('success', 'Book borrowed successfully! Due date: ' . now()->addDays(14)->format('M d, Y'));
    }
}
