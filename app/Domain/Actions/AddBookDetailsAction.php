<?php

namespace App\Domain\Actions;

use App\Models\Book;

class AddBookDetailsAction extends Action
{
    const RULES = [
        'book_name'      => 'required',
        'description'    => 'required',
        'price'          => 'required',
        'quantity'       => 'required',
        'penalty'        => 'required',
    ];

    public function do(array $data): array
    {
        parent::do($data);

        $addBookDetails = Book::create($data);

        return [
            'id'       => $addBookDetails->id,
            'instance' => $addBookDetails
        ];
    }
}
