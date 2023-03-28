<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class AuthorService
{
    /**
     * @var $bookRepository
     */
    protected $authorRepository;

    /**
     * PostService constructor.
     *
     * @param AuthorRepository $bookRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Get all post.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->authorRepository->all();
    }

    public function getById($id)
    {
        return $this->authorRepository->getById($id);
    }


}
