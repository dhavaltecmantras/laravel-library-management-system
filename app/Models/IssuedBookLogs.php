<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBookLogs extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'book_id',
        'book_name',
        'issuer_id',
        'issuer_name',
        'user_name',
        'user_address',
        'user_phone_number',
        'user_email',
        'penalty',
        'notes',
        'issued_quantity',
        'status'
    ];
}
