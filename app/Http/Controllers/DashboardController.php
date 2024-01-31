<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Services\BookService;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $bookService = new BookService();
        
        $bookCount = Book::count() ?? 0;
        $authorCount = Author::count() ?? 0;
        $memberCount = Member::count() ?? 0;
        $loanCount = Loan::count() ?? 0;

        $books = $bookService->getBooks();
        $loans = Loan::with(['book', 'member'])
        ->whereNull('return_date')->paginate(6);

        return view('index', [
            'book_count' => $bookCount,
            'author_count' => $authorCount,
            'member_count' => $memberCount,
            'loan_count' => $loanCount,
            'books' => $books,
            'loans' => $loans,
        ]);
    }

    public function exportPDF()
    {
        $loans = Loan::with(['book', 'member'])->get();

        $pdf = Pdf::loadView('export', compact('loans'));

        return $pdf->download('Peminjaman Buku.pdf');
    }
}
