<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getBooks()
    {
        return Book::with('author')->get();
    }

    public function getBookById($id)
    {
        return Book::findOrFail($id);
    }

    public function createBook(Book $book)
    {
        return $book->save();
    }

    public function updateBook(Book $book)
    {
        return $book->save();
    }

    public function deleteBook($id)
    {
        return Book::destroy($id);
    }
}
