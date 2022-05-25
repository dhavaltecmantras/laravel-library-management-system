<?php

namespace App\Domain\Actions;

use App\Models\Book;

class DeleteBookDetailsAction extends Action
{
    const RULES = [
        'id'    => 'required'
    ];

    /**
     * Delete a book.
     *
     * @param array $data
     * @return array
     */
    public function do(array $data): array
    {
        parent::do($data);

        $deleteBookDetails = Book::where('id', $data['id'])->delete();

        return [
            'id'       => $deleteBookDetails->id,
            'instance' => $deleteBookDetails
        ];
    }
}
