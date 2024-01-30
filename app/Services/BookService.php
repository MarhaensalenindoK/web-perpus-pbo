<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getBooks()
    {
        return Book::all();
    }

    public function getBookById($id)
    {
        return Book::findOrFail($id);
    }

    public function createBook(Book $book)
    {
        return $book->save();
    }

    public function updateBook($id, Book $book)
    {
        return Book::where('id', $id)->update($book->toArray());
    }

    public function deleteBook($id)
    {
        return Book::destroy($id);
    }
}