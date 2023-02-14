<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(int $id)
    {
        return view('public/book/show');
    }

    // public function show(int $id): View
    // {
    //     $book = Book::find($id);
    //     if ($book === null) {
    //         abort(404);
    //     }
    //     return view('public/book/show', ['book' => $book]);
    // }
}
