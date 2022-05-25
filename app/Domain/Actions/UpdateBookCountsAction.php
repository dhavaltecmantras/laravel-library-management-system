<?php

namespace App\Domain\Actions;

use App\Models\Book;

class UpdateBookCountsAction extends Action
{
    const RULES = [
        'id'        => 'required',
        'quantity'  => 'required'
    ];

    public function do(array $data): array
    {
        parent::do($data);

        $updatedBookDetails = Book::where('id', (int) $data['id'])->update($data);

        return [
            'id'       => $updatedBookDetails
        ];
    }
}
