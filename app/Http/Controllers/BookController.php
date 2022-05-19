<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookDetailsRequest;
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
}
