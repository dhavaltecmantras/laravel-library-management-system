<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssuedBookLogsRequest;
use App\Http\Requests\UpdateIssuedBookLogsRequest;
use App\Services\IssuedBookLogsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IssuedBookLogsController extends Controller
{
    private $issuedBookLogsService;
    public function __construct(IssuedBookLogsService $issuedBookLogsService)
    {
        $this->issuedBookLogsService = $issuedBookLogsService;
    }

    /**
     * This function is use to issue a book to the user.
     *
     * @param IssuedBookLogsRequest $request
     * @return JsonResponse
     */
    public function addIssuedBookLogs(IssuedBookLogsRequest $request): JsonResponse
    {
        try {
            $request = $request->all();
            $issuedBookLogsData = $this->issuedBookLogsService->addIssuedBookLogs($request);
            return response()->json([
                'success' => true,
                'message' => 'Book has been successfully issued.',
                'data'    => $issuedBookLogsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * This function is used to get all the issued book logs.
     *
     * @return JsonResponse
     */
    public function getAllIssuedBookLogs(): JsonResponse
    {
        try {
            $issuedBookLogsData = $this->issuedBookLogsService->getAllIssuedBookLogs();
            return response()->json([
                'success' => true,
                'message' => 'Issued book logs are fetched successfully.',
                'data'    => $issuedBookLogsData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * This function is use to get book logs by id.
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function getBookLogById(int $id): JsonResponse
    {
        try {
            $issuedBookLogData = $this->issuedBookLogsService->getBookLogById($id);
            return response()->json([
                'success' => true,
                'message' => 'Issued book log is fetched successfully.',
                'data'    => $issuedBookLogData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * This function is used to update issued book logs.
     *
     * @param UpdateIssuedBookLogsRequest $request
     * @return JsonResponse
     */
    public function updateIssuedBookLogs(UpdateIssuedBookLogsRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $issuedBookLogData = $this->issuedBookLogsService->updateIssuedBookLogs($data);
            return response()->json([
                'success' => true,
                'message' => 'Issued book details are updated successfully.',
                'data'    => $issuedBookLogData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Calculate Penalty based on the issued date of book.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function calculatePenalty(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $calculatePenaltyData = $this->issuedBookLogsService->calculatePenalty($data);
            return response()->json([
                'success' => true,
                'message' => 'Penalty Calculation is done successfully.',
                'data'    => $calculatePenaltyData
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(
                $th->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }
}
