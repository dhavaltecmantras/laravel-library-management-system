<?php

namespace App\Domain\Actions;

use App\Models\Book;

class UpdateBookDetailsAction extends Action
{
    const RULES = [
        'id'             => 'required',
        'book_name'      => 'required',
        'description'    => 'required',
        'price'          => 'required',
        'quantity'       => 'required'
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
