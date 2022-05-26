<?php

namespace App\Domain\Actions;

use App\Models\IssuedBookLogs;

class CalculatePenaltyForIssuedBook extends Action
{
    const RULES = [
        'id'         => 'required',
        'penalty'    => 'required',
        'status'     => 'required',
    ];

    public function do(array $data): array
    {
        parent::do($data);

        $updatedIssuedBookDetails = IssuedBookLogs::where('id', (int) $data['id'])->update($data);

        return [
            'id'        => $updatedIssuedBookDetails
        ];
    }
}
