<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function getAuthors()
    {
        return Author::all();
    }

    public function getAuthorById($id)
    {
        return Author::findOrFail($id);
    }

    public function createAuthor(Author $author)
    {
        return $author->save();
    }

    public function updateAuthor($id, Author $author)
    {
        return Author::where('id', $id)->update($author->toArray());
    }

    public function deleteAuthor($id)
    {
        return Author::destroy($id);
    }
}