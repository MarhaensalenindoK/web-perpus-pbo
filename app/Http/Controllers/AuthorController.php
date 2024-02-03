<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::paginate(1);
        return view('author.index', [
            'authors' => $authors
        ]);
    }

    public function store(Request $request)
    {
        return redirect('authors')->with('status', 'Tambah Pengarang Berhasil');
    }

    public function detail($id)
    {
        $author = Author::findOrFail($id);
        return view('author-edit', [
            'author' => $author,
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect('authors')->with('status', 'Update Pengarang Berhasil');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect('authors')->with('status', 'Hapus Pengarang Berhasil');
    }
}
