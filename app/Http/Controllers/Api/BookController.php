<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\BookService;

class BookController extends Controller
{
    private $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookService->getBooks();

        # Query on the existing collection to get our recently added books
        $newBooks = $this->bookService->getNewBooks($books, 3);
        
        
        return response()->json(
            [
                'books' => $books,
                'newBooks' => $newBooks
            ]
        );

    }

    public function getAllBooks()
    {
        $books = $this->bookService->getBooks();
        # Query on the existing collection to get our recently added books
        $newBooks = $this->bookService->getNewBooks($books, 5); //$books->sortByDesc('created_at')->take(3);

        return response()->json(['foobook' => $books, 'newBooks' => $newBooks]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = $this->bookService->createBook($request->all());
        
        return ['book' => $book];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->bookService->getById($id);

        if (!$book) {
            return redirect('foobook')->with(['alert' => 'Book not found']);
        }

        return view('foobook')->with([
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $updatedBook = $this->bookService->updatePost($request, $book->id);

        return response()->json($updatedBook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $bookId = $book->id;
        $result = $this->bookService->deleteById($bookId);
        return $result;
    }

    public function search(Request $request)
    {
        $searchTerm = $request->session()->get('searchTerm', '');
        $caseSensitive = $request->session()->get('caseSensitive', false);
        $searchResults = $request->session()->get('searchResults', null);

        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $caseSensitive,
            'searchResults' => $searchResults,
        ]);
    }
}