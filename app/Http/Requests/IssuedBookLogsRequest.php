<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssuedBookLogsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'book_id' => 'required',
            'book_name' => 'required',
            'issuer_id' => 'required',
            'issuer_name' => 'required',
            'user_name' => 'required',
            'user_address' => 'required',
            'user_phone_number' => 'required',
            'user_email' => 'required',
            'notes' => 'required',
            'issued_quantity' => 'required'
        ];
    }
}
