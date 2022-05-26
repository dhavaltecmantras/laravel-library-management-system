<?php

namespace App\Domain\Actions;

use App\Models\IssuedBookLogs;

class UpdateIssuedBookLogsAction extends Action
{
    const RULES = [
        'quantity'       => 'required'
    ];

    public function do(array $data): array
    {
        parent::do($data);

        $updatedIssuedBookDetails = IssuedBookLogs::where('id', (int) $data['id'])->update($data);

        return [
            'id'        => $updatedIssuedBookDetails['id'],
            'instance'  => $updatedIssuedBookDetails
        ];
    }
}
