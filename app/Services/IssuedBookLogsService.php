<?php

namespace App\Services;

use App\Repositories\IssuedBookLogsRepository;
use App\Domain\Actions\AddIssuedBookLogsAction;
use App\Domain\Actions\UpdateBookCountsAction;
use App\Domain\Actions\UpdateBookDetailsAction;
use App\Domain\Actions\UpdateIssuedBookLogsStatus;
use App\Repositories\BookRepository;

/**
 * Class IssuedBookLogsService.
 */
class IssuedBookLogsService
{
    private $issuedBookLogsRepository;
    private $addIssuedBookLogsAction;
    private $updateBookCountsAction;
    private $bookRepository;
    private $updateBookDetailsAction;
    private $updateIssuedBookLogsStatus;

    public function __construct(
        IssuedBookLogsRepository $issuedBookLogsRepository,
        AddIssuedBookLogsAction $addIssuedBookLogsAction,
        UpdateBookCountsAction $updateBookCountsAction,
        BookRepository $bookRepository,
        UpdateBookDetailsAction $updateBookDetailsAction,
        UpdateIssuedBookLogsStatus $updateIssuedBookLogsStatus,
    ) {
        $this->issuedBookLogsRepository = $issuedBookLogsRepository;
        $this->addIssuedBookLogsAction = $addIssuedBookLogsAction;
        $this->updateBookCountsAction = $updateBookCountsAction;
        $this->bookRepository = $bookRepository;
        $this->updateBookDetailsAction = $updateBookDetailsAction;
        $this->updateIssuedBookLogsStatus = $updateIssuedBookLogsStatus;
    }

    /**
     * Add Issued Book's Log
     *
     * @param array $data
     * @return void
     */
    public function addIssuedBookLogs(array $data): array
    {
        try {
            $addedIssuedBookData = $this->addIssuedBookLogsAction->do($data);
            $bookDetailsData = $this->bookRepository->getBookDetailsById((int) $data['book_id'])->first();
            if ($addedIssuedBookData['id']) {
                $updateBookCountsPayload = [
                    "id"        => $data['book_id'],
                    "quantity"  => $bookDetailsData->quantity - (int) $data['issued_quantity'],
                ];
                $updatedBookCount = $this->updateBookCountsAction->do($updateBookCountsPayload);
            }
            return [
                'message'   => 'Book has been successfully issued.',
                'id'        => $addedIssuedBookData['id'],
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * This function is used to get all the issued book logs.
     *
     * @return array
     */
    public function getAllIssuedBookLogs(): array
    {
        try {
            $allIssuedBookLogData = $this->issuedBookLogsRepository->getAllIssuedBookLogs();
            return [
                'data'      => $allIssuedBookLogData,
                'message'   => 'Issued book logs are fetched successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * This function is use to get issued book log by id.
     *
     * @param integer $id
     * @return array
     */
    public function getBookLogById(int $id): array
    {
        try {
            $allIssuedBookLogData = $this->issuedBookLogsRepository->getBookLogById($id);
            return [
                'data'      => $allIssuedBookLogData->first(),
                'message'   => 'Book log is fetched successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * This function is used to update issued book logs.
     *
     * @param array $data
     * @return array
     */
    public function updateIssuedBookLogs(array $data): array
    {
        try {
            $updateBookDetailsParameter = [
                'id'      => $data['id'],
                'status'  => $data['status']
            ];
            $allIssuedBookLogData = $this->updateIssuedBookLogsStatus->do($updateBookDetailsParameter);
            $bookDetailsData = $this->bookRepository->getBookDetailsById((int) $data['book_id'])->first();
            if ($allIssuedBookLogData['id'] && $data['status'] == "3") {
                $updateBookCountsPayload = [
                    "id"        => $data['book_id'],
                    "quantity"  => $data['status'] == "3" ? $bookDetailsData->quantity + (int) $data['issued_quantity'] : $bookDetailsData->quantity
                ];
                $updatedBookCount = $this->updateBookCountsAction->do($updateBookCountsPayload);
            }
            return [
                'id'      => $allIssuedBookLogData['id'],
                'message' => 'Issued book details are updated successfully.',
            ];
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage()
            ];
        }
    }
}
