<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $authorService = new AuthorService();

        $books = Book::with('author')->paginate(1);
        $authors = $authorService->getAuthors();

        return view('book.index', [
            'books' => $books,
            'authors' => $authors
        ]);
    }

    public function store(Request $request)
    {
        return redirect('books')->with('status', 'Tambah Buku Berhasil');
    }

    public function detail($id)
    {
        $book = Book::findOrFail($id);
        return view('book-edit', [
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect('books')->with('status', 'Update Buku Berhasil');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect('books')->with('status', 'Hapus Buku Berhasil');
    }
}
