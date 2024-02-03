<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Services\MemberService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {

        $memberService = new MemberService();

        $loans = Loan::with(['book', 'member'])->paginate(1);
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
        return redirect('loans')->with('status', 'Tambah Peminjaman Berhasil');
    }

    public function detail($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loan-edit', [
            'loan' => $loan,
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect('loans')->with('status', 'Update Peminjaman Berhasil');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect('loans')->with('status', 'Hapus Peminjaman Berhasil');
    }
}
