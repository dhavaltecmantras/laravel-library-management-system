<?php

namespace App\Services;

use App\Domain\Actions\AddBookDetailsAction;
use App\Domain\Actions\DeleteBookDetailsAction;
use App\Domain\Actions\UpdateBookDetailsAction;
use App\Repositories\BookRepository;

class BookService
{
    private $addBookDetailsAction;
    private $bookRepository;
    private $deleteBookDetailsAction;
    private $updateBookDetailsAction;

    public function __construct(
        AddBookDetailsAction $addBookDetailsAction,
        BookRepository $bookRepository,
        DeleteBookDetailsAction $deleteBookDetailsAction,
        UpdateBookDetailsAction $updateBookDetailsAction
    )
    {
        $this->addBookDetailsAction = $addBookDetailsAction;
        $this->bookRepository = $bookRepository;
        $this->deleteBookDetailsAction = $deleteBookDetailsAction;
        $this->updateBookDetailsAction = $updateBookDetailsAction;
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

    /**
     * Delete a book.
     *
     * @param integer $id
     * @return array
     */
    public function deleteBookDetails(int $id): array
    {
        try {
            $deleteBookDetailsArray = [
                'id' => $id
            ];
            $data = $this->deleteBookDetailsAction->do($deleteBookDetailsArray);
            return [
                'message'   => 'Book Details are deleted successfully.',
                'data'      => $data
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * This function is use to get a specific book's detail.
     *
     * @param integer $id
     * @return array
     */
    public function getBookDetailsById(int $id): array
    {
        try {
            $data = $this->bookRepository->getBookDetailsById($id);
            return [
                'message'   => 'Book Details are fetched successfully.',
                'data'      => $data
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * Update Book Details.
     *
     * @param array $data
     * @return array
     */
    public function updateBookDetails(array $data): array
    {
        try {
            $data = $this->updateBookDetailsAction->do($data);

            return [
                'message'   => 'Book Details are updated successfully',
                'id'        => $data['id'],
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }
}
