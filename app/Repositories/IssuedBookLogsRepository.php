<?php

namespace App\Repositories;

use App\Models\IssuedBookLogs;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;

/**
 * Class IssuedBookLogsRepository.
 */
class IssuedBookLogsRepository
{

    /**
     * This function is used to get all the issued book logs.
     *
     * @return JsonResponse
     */
    public function getAllIssuedBookLogs(): Collection
    {
        return IssuedBookLogs::orderBy('created_at', 'DESC')->get();
    }

    /**
     * This function is used to get book log by id.
     *
     * @param integer $id
     * @return Collection
     */
    public function getBookLogById(int $id): Collection
    {
        return IssuedBookLogs::where('id', $id)->get();
    }
}
