<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BookRepository.
 */
class BookRepository
{
    /**
     * This function is use to retrive all book details.
     *
     * @return Collection
     */
    public function getBookDetails(): Collection
    {
        return Book::get();
    }

    /**
     * This function is use to get a specific book's detail.
     *
     * @param integer $id
     * @return Collection
     */
    public function getBookDetailsById(int $id): Collection
    {
        return Book::where('id', $id)->get();
    }
}
