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
}
