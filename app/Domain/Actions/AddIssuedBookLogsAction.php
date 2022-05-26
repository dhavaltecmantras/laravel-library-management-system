<?php

namespace App\Domain\Actions;

use App\Models\IssuedBookLogs;

class AddIssuedBookLogsAction extends Action
{
    const RULES = [
        'book_id' => 'required',
        'book_name' => 'required',
        'issuer_id' => 'required',
        'issuer_name' => 'required',
        'user_name' => 'required',
        'user_address' => 'required',
        'user_phone_number' => 'required',
        'user_email' => 'required',
        'notes' => 'required',
        'issued_quantity' => 'required',
        'status' => 'required',
    ];

    public function do(array $data): array
    {
        parent::do($data);

        $issuedBookLogsDetails = IssuedBookLogs::create($data);

        return [
            'id'       => $issuedBookLogsDetails->id,
            'instance' => $issuedBookLogsDetails
        ];
    }
}
