<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Loan::with(['book.category', 'user']);

        // Regular users can only see their own loans
        if (!in_array($user->role, ['Admin', 'Librarian'])) {
            $query->where('user_id', $user->id);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->whereNull('returned_date');
            } elseif ($request->status === 'returned') {
                $query->whereNotNull('returned_date');
            } elseif ($request->status === 'overdue') {
                $query->whereNull('returned_date')
                    ->where('due_date', '<', now());
            }
        }

        $loans = $query->latest()->paginate(15);

        return response()->json($loans);
    }

    /**
     * Store a newly created resource in storage (Borrow a book).
     */
    public function store(StoreLoanRequest $request)
    {
        $book = Book::findOrFail($request->book_id);

        // Deduct available copies
        $book->decrement('available_copies');

        // Create loan record
        $loan = Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'checkout_date' => now(),
            'due_date' => now()->addDays(14), // 2 weeks default
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Book borrowed successfully',
            'loan' => $loan->load('book.category')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        // Authorization: Users can only view their own loans
        if (!in_array(auth()->user()->role, ['Admin', 'Librarian']) && $loan->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return response()->json($loan->load(['book.category', 'user']));
    }

    /**
     * Return a book (custom method).
     */
    public function returnBook(Loan $loan)
    {
        // Only staff or the borrower can return
        if (!in_array(auth()->user()->role, ['Admin', 'Librarian']) && $loan->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($loan->returned_date) {
            return response()->json(['message' => 'Book already returned'], 400);
        }

        // Mark as returned
        $loan->update(['returned_date' => now()]);

        // Increment available copies
        $loan->book->increment('available_copies');

        return response()->json([
            'message' => 'Book returned successfully',
            'loan' => $loan->load('book')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        // Only admins can delete loan records
        if (!in_array(auth()->user()->role, ['Admin'])) {
            abort(403, 'Unauthorized');
        }

        $loan->delete();

        return response()->json(['message' => 'Loan record deleted successfully']);
    }
}
