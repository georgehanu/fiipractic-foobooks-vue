<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function getBooks()
    {
        return Book::with('author')->orderBy('title')->get();
    }
    public function getNewBooks($book, $count = 3)
    {
        return $book->sortByDesc('created_at')->take($count);
    }
    public function all()
    {
        return Book::all();
    }

    public function getById($id)
    {
        return Book::with('author')->find($id);
    }
    public function delete($id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return "Book deleted successfully";
        }
    return "Book not found";

    }
    public function update($data, $id = null)
    {
        $book = new Book();
        if ($id)
            $book = Book::find($id);
        $book->author->bio_url = $data['author']['bio_url'] ?? $book->author->bio_url;
        $book->author->birth_year = $data['author']['birth_year'] ?? $book->author->birth_year;
        $book->author->first_name = $data['author']['first_name'] ?? $book->author->first_name;
        $book->author->last_name = $data['author']['last_name'] ?? $book->author->last_name;
        $book->title = $data['title'] ?? $book->title;
        $book->cover_url = $data['cover_url'] ?? $book->cover_url;
        $book->author_id = $data['author_id'] ?? $book->author_id;
        $book->published_year = $data['published_year'] ?? $book->published_year;
        $book->purchase_url = $data['purchase_url'] ?? $book->purchase_url;

        $book->save();

        return $book;

    }
    public function store($data)
    {
        $book                 = new Book();
        $book->title          = $data['title'];
        $book->author_id      = $data['author_id'];
        $book->published_year = $data['published_year'];
        $book->cover_url      = $data['cover_url'];
        $book->purchase_url   = $data['purchase_url'];
        $book->save();
        
        # Note: Have to sync tags *after* the book has been saved so there's a book_id to store in the pivot table
        $book->tags()->sync($data['tags']);

        return $book;

    }
}
