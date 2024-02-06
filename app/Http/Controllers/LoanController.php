<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Services\BookService;
use App\Services\LoanService;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index(Request $request)
    {

        $memberService = new MemberService();

        $loans = Loan::with(['book', 'member'])->paginate(10);
        $books = Book::where('status', 'available')->get();
        $members = $memberService->getMembers();

        return view('loan.index', [
            'loans' => $loans,
            'books' => $books,
            'members' => $members,
        ]);
    }

    public function store(Request $request)
    {
        $loanService = new LoanService;
        $bookService = new BookService;

        $memberId = $request->member_id ?? null;
        $bookId = $request->book_id ?? null;
        $loanDate = $request->loan_date ?? null;

        if (is_null($memberId) === '' || is_null($bookId) || is_null($loanDate)) {
            return redirect('loans')
                ->with('status', 'Tambah Peminjaman Gagal, Silahkan isi form dengan benar!')
                ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'loan_date' => 'required',
        ]);

        $loan = new Loan();
        $loan->member_id = $validatedData['member_id'];
        $loan->book_id = $validatedData['book_id'];
        $loan->loan_date = $validatedData['loan_date'];

        $book = Book::findOrFail($bookId);
        $book->status = 'unavailable';

        $bookService->updateBook($book);

        if ($loanService->createLoan($loan)) {
            return redirect('loans')->with('status', 'Peminjaman berhasil ditambahkan!')
                ->with('clearStatus', true);
        }

        return redirect('loans')->with('status', 'Tambah Peminjaman Gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
    }

    public function detail($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loan-edit', [
            'loan' => $loan,
        ]);
    }

    public function update(Request $request)
    {
        $loanService = new LoanService;
        $bookService = new BookService;

        $loanId = $request->loan_id ?? '';
        $currentBookId = $request->current_book_id ?? '';
        $memberId = $request->member_id ?? null;
        $bookId = $request->book_id ?? $request->current_book_id;
        $loanDate = $request->loan_date ?? null;
        
        if ($loanId === '' || $currentBookId === '' || is_null($memberId) || is_null($loanDate)) {
            return redirect('loans')
            ->with('status', 'Edit Peminjaman Gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'member_id' => 'required',
            'loan_date' => 'required',
        ]);

        $loan = Loan::findOrFail($loanId);
        $loan->member_id = $validatedData['member_id'];
        $loan->book_id = $bookId;
        $loan->loan_date = $validatedData['loan_date'];

        $currentBook = Book::findOrFail($currentBookId);
        $currentBook->status = 'available';
        $bookService->updateBook($currentBook);

        $book = Book::findOrFail($bookId);
        $book->status = 'unavailable';
        $bookService->updateBook($book);

        if($loanService->updateLoan($loan)) {
            return redirect('loans')->with('status', 'Peminjaman berhasil diedit!')
            ->with('clearStatus', true);
        }

        return redirect('loans')->with('status', 'Edit Peminjaman Gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function destroy(Request $request)
    {
        $loanService = new LoanService;
        $bookService = new BookService;

        $loanId = $request->loan_id ?? '';
        $bookId = $request->book_id ?? '';

        $book = Book::findOrFail($bookId);
        $book->status = 'available';

        $bookService->updateBook($book);

        if($loanService->deleteLoan($loanId)) {
            return redirect('loans')->with('status', 'Data Peminjaman berhasil dihapus!')
            ->with('clearStatus', true);
        }

        return redirect('loans')->with('status', 'Hapus Data Peminjaman Gagal, Silahkan coba lagi!')
        ->with('clearStatus', true);
    }

    public function return(Request $request)
    {
        $loanService = new LoanService;
        $bookService = new BookService;

        $loanId = $request->loan_id ?? '';
        $bookId = $request->book_id ?? '';

        
        $loan = Loan::findOrFail($loanId);
        $loan->status = 'returned';
        $loan->return_date = Carbon::now();

        $book = Book::findOrFail($bookId);
        $book->status = 'available';
        $bookService->updateBook($book);

        if($loanService->updateLoan($loan)) {
            return redirect('loans')->with('status', 'Pengembalian Buku Berhasil!')
            ->with('clearStatus', true);
        }

        return redirect('loans')->with('status', 'Pengembalian Buku Gagal!')
        ->with('clearStatus', true);
    }
}
