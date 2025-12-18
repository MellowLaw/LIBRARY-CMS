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
     * Display a listing of pending loan requests.
     */
    public function index()
    {
        $loans = Loan::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);
            
        return view('admin.loans.index', compact('loans'));
    }

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

        // Check if user already has an active loan or pending request for this book
        $existingLoan = Loan::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where(function ($query) {
                $query->whereNull('returned_date')
                      ->orWhere('status', 'pending');
            })
            ->first();

        if ($existingLoan) {
            $msg = $existingLoan->status === 'pending' 
                ? 'You already have a pending request for this book.' 
                : 'You already have an active loan for this book.';
            return redirect()->back()->with('error', $msg);
        }

        // Create loan request (pending)
        // We decrement copies NOW to reserve it, but if rejected we increment back.
        // OR we don't decrement until approved.
        // Let's reserve it to avoid race conditions where 10 people request the last copy.
        $book->decrement('available_copies');

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending',
            'checkout_date' => now(), // Placeholder, will update on approval
            'due_date' => now()->addDays(14), // Placeholder
        ]);

        return redirect()->route('public.books.show', $book)->with('success', 'Loan request submitted! Please wait for admin approval.');
        
    }

    /**
     * Approve a loan request.
     */
    public function approve(Loan $loan)
    {
        // Add authorization check here if needed (e.g., Auth::user()->isAdmin())

        $loan->update([
            'status' => 'approved',
            'checkout_date' => now(),
            'due_date' => now()->addDays(14),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Loan request approved successfully.');
    }

    /**
     * Reject a loan request.
     */
    public function reject(Request $request, Loan $loan)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        $loan->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'returned_date' => now(), // Mark as closed
        ]);

        // Increment copy back since it was reserved
        $loan->book->increment('available_copies');

        return redirect()->back()->with('success', 'Loan request rejected.');
    }

    /**
     * Display active loans for admin.
     */
    public function activeLoans()
    {
        $loans = Loan::with(['user', 'book'])
            ->where('status', 'approved')
            ->whereNull('returned_date')
            ->latest()
            ->paginate(15);
            
        return view('admin.loans.active', compact('loans'));
    }

    /**
     * Mark a loan as returned.
     */
    public function returnBook(Loan $loan)
    {
        $loan->update([
            'returned_date' => now(),
        ]);

        // Increment available copies
        $loan->book->increment('available_copies');

        return redirect()->back()->with('success', 'Book returned successfully.');
    }
}
