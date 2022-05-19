<?php

namespace App\Services;

use App\Domain\Actions\AddBookDetailsAction;
use App\Repositories\BookRepository;

class BookService
{
    private $addBookDetailsAction;
    private $bookRepository;
    public function __construct(AddBookDetailsAction $addBookDetailsAction, BookRepository $bookRepository)
    {
        $this->addBookDetailsAction = $addBookDetailsAction;
        $this->bookRepository = $bookRepository;
    }

    /**
     * To store the book details
     *
     * @param array $data
     * @return array
     */
    public function addBookDetails(array $data): array
    {
        try {
            $data = $this->addBookDetailsAction->do($data);
            return [
                'message'   => 'Book Details are added successfully',
                'id'        => $data['id'],
                'instance'  => $data['instance'],
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * This function is use to fetch all the books' details
     *
     * @return array
     */
    public function getBookDetails(): array
    {
        try {
            $data = $this->bookRepository->getBookDetails();
            return [
                'message'   => 'Book Details are added successfully',
                'data'      => $data
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }
}
