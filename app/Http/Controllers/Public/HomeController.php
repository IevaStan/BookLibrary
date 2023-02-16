<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Book;

class HomeController extends Controller
{
    public function index(): View
    {
        $books = Book::all();
        // return view('public/home', ['books' => $books]);
        // tas pats tik per Laravelio compact:
        return view('public/home', compact('books'));
    }
}
