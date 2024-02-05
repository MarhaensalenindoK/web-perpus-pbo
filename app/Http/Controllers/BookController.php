<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $authorService = new AuthorService();

        $books = Book::with('author')->paginate(10);

        $authors = $authorService->getAuthors();

        return view('book.index', [
            'books' => $books,
            'authors' => $authors
        ]);
    }

    public function store(Request $request)
    {
        $bookService = new BookService;
        $title = $request->title ?? '';
        $authorId = $request->author_id ?? null;
        $publisher = $request->publisher ?? '';
        $publicationYear = $request->publication_year ?? null;

        if ($title === '' || is_null($authorId) || $publisher === '' || is_null($publicationYear)) {
            return redirect('books')
            ->with('status', 'Tambah Buku Gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required',
        ]);

        $book = new Book();
        $book->title = $validatedData['title'];
        $book->author_id = $validatedData['author_id'];
        $book->publisher = $validatedData['publisher'];
        $book->publication_year = $validatedData['publication_year'];

        if($bookService->createBook($book)) {
            return redirect('books')->with('status', 'Buku berhasil ditambahkan!')
            ->with('clearStatus', true);
        }

        return redirect('books')->with('status', 'Tambah Buku Gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function detail($id)
    {
        $book = Book::findOrFail($id);
        return view('book-edit', [
            'book' => $book,
        ]);
    }

    public function update(Request $request)
    {
        $bookService = new BookService;
        $bookId = $request->book_id ?? '';
        $title = $request->title ?? '';
        $authorId = $request->author_id ?? null;
        $publisher = $request->publisher ?? '';

        $publicationYear = $request->publication_year ?? null;

        if ($bookId === '' || $title === '' || is_null($authorId) || $publisher === '' || is_null($publicationYear)) {
            return redirect('books')
            ->with('status', 'Edit Buku Gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required',
            'status' => 'nullable',
        ]);

        $book = Book::findOrFail($bookId);

        $book->title = $validatedData['title'];
        $book->author_id = $validatedData['author_id'];
        $book->publisher = $validatedData['publisher'];
        $book->publication_year = $validatedData['publication_year'];
        $book->status = $validatedData['status'];

        if($bookService->updateBook($book)) {
            return redirect('books')->with('status', 'Buku berhasil diedit!')
            ->with('clearStatus', true);
        }

        return redirect('books')->with('status', 'Edit Buku Gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function destroy(Request $request)
    {
        $bookService = new BookService;

        $bookId = $request->book_id ?? '';

        if($bookService->deleteBook($bookId)) {
            return redirect('books')->with('status', 'Buku berhasil dihapus!')
            ->with('clearStatus', true);
        }

        return redirect('books')->with('status', 'Hapus Buku Gagal, Silahkan coba lagi!')
        ->with('clearStatus', true);
    }
}
