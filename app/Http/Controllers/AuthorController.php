<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::paginate(10);
        return view('author.index', [
            'authors' => $authors
        ]);
    }

    public function store(Request $request)
    {
        $authorService = new AuthorService;
        $name = $request->name ?? '';

        if ($name === '') {
            return redirect('authors')
            ->with('status', 'Tambah pengarang gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable',
        ]);

        $author = new Author();
        $author->name = $validatedData['name'];
        $author->biography = $validatedData['biography'];

        if($authorService->createAuthor($author)) {
            return redirect('authors')->with('status', 'Pengarang berhasil ditambahkan!')
            ->with('clearStatus', true);
        }

        return redirect('authors')->with('status', 'Tambah pengarang gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function detail($id)
    {
        $author = Author::findOrFail($id);
        return view('author-edit', [
            'author' => $author,
        ]);
    }

    public function update(Request $request)
    {
        $authorService = new AuthorService;
        $authorId = $request->author_id ?? '';
        $name = $request->name ?? '';

        if ($name === '' || is_null($authorId)) {
            return redirect('authors')
            ->with('status', 'Edit pengarang gagal, Silahkan isi form dengan benar!')
            ->with('clearStatus', true);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable',
        ]);

        $author = Author::findOrFail($authorId);

        $author->name = $validatedData['name'];
        $author->biography = $validatedData['biography'];

        if($authorService->updateAuthor($author)) {
            return redirect('authors')->with('status', 'Pengarang berhasil diedit!')
            ->with('clearStatus', true);
        }

        return redirect('authors')->with('status', 'Edit pengarang gagal, Silahkan isi form dengan benar!')
        ->with('clearStatus', true);
    }

    public function destroy(Request $request)
    {
        $authorService = new AuthorService;

        $authorId = $request->author_id ?? '';

        if($authorService->deleteAuthor($authorId)) {
            return redirect('authors')->with('status', 'Pengarang berhasil dihapus!')
            ->with('clearStatus', true);
        }

        return redirect('authors')->with('status', 'Hapus pengarang Gagal, Silahkan coba lagi!')
        ->with('clearStatus', true);
    }
}
