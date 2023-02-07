<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {

        $books = Book::paginate(20);  //suskaido puslapį po 20 knygų
        $page = $request->get('page');

        return view('books/index', [
            'books' => $books,
        ]);
    }


    public function show($id): View
    {
        $book = Book::find($id);
        if ($book === null) {
            abort(404);
        }
        return view('books/show', ['book' => $book]);
    }


    public function create(): View
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books/create', ['authors' => $authors, 'categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required',
                'page_count' => 'required',
                'description' => 'required|min:5|max:30',
                'author_id' => 'required',
            ]
        );

        Book::create($request->all());
        return redirect('books')
            ->with('success', 'New book successfully added!');
    }






    public function delete(int $id)
    {
        $book = Book::find($id);
        if ($book === null) {
            abort(404);
        }
        $book->delete();
        return redirect('books')->with('success', 'Book removed successfully!');
    }


    public function edit(int $id, Request $request)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $categories = Category::all();
        if ($book === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate(
                ['name' => 'required'],
                ['description' => 'required|min:5|max:30'],
                ['page_count' => 'required'],
            );
            $book->update($request->all());

            return redirect('books')->with('success', 'Book updated successfully!');
        }

        return view('books/edit', [
            'book' => $book, 'authors' => $authors, 'categories' => $categories
        ]);
    }
}
