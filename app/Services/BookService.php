<?php

namespace App\Services;

use App\Repositories\Interfaces\BookRepositoryInterface as BookRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Carbon\Carbon;

class BookService
{
    /**
     * @var $bookRepository
     */
    protected $bookRepository;

    /**
     * PostService constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Delete book by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        $book = null;
        DB::beginTransaction();

        try {
            $book = $this->bookRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $book;

    }

    /**
     * Get all post.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->bookRepository->all();
    }

    public function getNewBooks($books, $count = 3)
    {
        return $this->bookRepository->getNewBooks($books, $count);
    }

    public function getBooks()
    {
        $books = $this->bookRepository->getBooks();
        foreach ($books as $book) {
            $book->created_at = Carbon::parse($book->created_at)->format('d-m-Y H:i:s');
            $book->updated_at = Carbon::parse($book->updated_at)->format('d-m-Y H:i:s');
        }
        return $books;
    }
    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->bookRepository->getById($id);
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updatePost($data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $post = $this->bookRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }

        DB::commit();

        return $post;

    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function storeBook($data, $id =null)
    {
        
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->bookRepository->update($data, $id);

        return $result;
    }

    public function createBook($data)
    {
        $validator = Validator::make($data, [
            'title'          => 'required',
            'author_id'      => 'required',
            'published_year' => 'required|digits:4',
            'cover_url'      => 'required|url',
            'purchase_url'   => 'required|url'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->bookRepository->store($data);

    }

}
