<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\IssuedBookLogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout1']);
    Route::get('get-user', [ApiController::class, 'getUser']);

    // Routes for Books
    Route::post('add-book-details', [BookController::class, 'addBookDetails']);
    Route::get('get-book-details', [BookController::class, 'getBookDetails']);
    Route::delete('delete-book-details/{id}', [BookController::class, 'deleteBookDetails']);
    Route::get('get-book-details-by-id/{id}', [BookController::class, 'getBookDetailsById']);
    Route::post('update-book-details', [BookController::class, 'updateBookDetails']);

    // Routes for Issued Books
    Route::post('add-issued-book-logs', [IssuedBookLogsController::class, 'addIssuedBookLogs']);
    Route::get('get-all-issued-books', [IssuedBookLogsController::class, 'getAllIssuedBookLogs']);
    Route::get('get-book-log-by-id/{id}', [IssuedBookLogsController::class, 'getBookLogById']);
    Route::get('update-issued-book-logs', [IssuedBookLogsController::class, 'updateIssuedBookLogs']);
});
