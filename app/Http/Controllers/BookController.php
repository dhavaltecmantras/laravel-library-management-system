<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookDetailsRequest;
use App\Http\Requests\UpdateBookDetailsRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * This function is use to add the book details.
     *
     * @param AddBookDetailsRequest $request
     * @return JsonResponse
     */
    public function addBookDetails(AddBookDetailsRequest $request): JsonResponse
    {
        try {
            $request = $request->all();
            $bookDetailsData = $this->bookService->addBookDetails($request);
            return response()->json([
                'success' => true,
                'message' => 'Book Details are created successfully',
                'data'    => $bookDetailsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * This function is use to fetch all the books' details
     *
     * @return JsonResponse
     */
    public function getBookDetails(): JsonResponse
    {
        try {
            $bookDetailsData = $this->bookService->getBookDetails();
            return response()->json([
                'success' => true,
                'message' => 'Book Details are fetched successfully.',
                'data'    => $bookDetailsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Delete a book.
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function deleteBookDetails(int $id): JsonResponse
    {
        try {
            $deletedBookDetailsData = $this->bookService->deleteBookDetails($id);
            return response()->json([
                'success' => true,
                'message' => 'Book Details are deleted successfully.',
                'data'    => $deletedBookDetailsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * This function is use to get a specific book's detail.
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getBookDetailsById(int $id): JsonResponse
    {
        try {
            $bookDetailsData = $this->bookService->getBookDetailsById($id);
            return response()->json([
                'success' => true,
                'message' => 'Book Details are fetched successfully.',
                'data'    => $bookDetailsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Update Book details.
     *
     * @param UpdateBookDetailsRequest $request
     * @return JsonResponse
     */
    public function updateBookDetails(UpdateBookDetailsRequest $request): JsonResponse
    {
        try {
            $request = $request->all();
            $bookDetailsData = $this->bookService->updateBookDetails($request);
            return response()->json([
                'success' => true,
                'message' => 'Book Details are updated successfully',
                'data'    => $bookDetailsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    // public function getTotalBookQuantity(): JsonResponse
    // {
    //     try {
    //         $bookDetailsData = $this->bookService->getBookDetailsById($id);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Book Details are fetched successfully.',
    //             'data'    => $bookDetailsData
    //         ], Response::HTTP_OK);
    //     } catch (\Throwable $th) {
    //         return response()->json(
    //             $th->getMessage(),
    //             JsonResponse::HTTP_BAD_REQUEST
    //         );
    //     }
    // }
}
