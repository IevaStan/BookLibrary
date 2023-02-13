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
        
        // $books = Book::with('category', 'authors')->paginate(10);

        $books = Book::paginate(10); //paginate suskaido puslapį po n knygų
        //withour naudojam nes į modelį dėjom protected $with = ['category', 'authors'];

        $page = $request->get('page');

        return view('books/index', [
            'books' => $books,
        ]);
    }

    public function indexWithoutAuthors(): View
    {
        $books = Book::without('authors')->get();
        return view('books/index_without_author', [
            'books' => $books
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
        // $categories = Category::all();
        $categories = Category::where('enabled', '=', 1)->get();  
        return view('books/create', ['authors' => $authors, 'categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse|View
    {
        $request->validate(
            [
                'name' => 'required',
                'page_count' => 'required',
                'description' => 'required|min:5|max:30',
                // 'author_id' => 'required',
                'category_id' => 'required',
            ]
        );

        $book = Book::create($request->all());
        $authors = Author::find($request->post('author_id'));
        $book->authors()->attach($authors);

        //$book->authors()->attach($request->post('author_id')); // alternatyva, jeigu su tais autoriais nieko nereikia daugiau daryti


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
                [
                    'name' => 'required|max:50',
                    'description' => 'required|min:5|max:30',
                    'page_count' => 'required',
                    'author_id' => 'required',
                    'category_id' => 'required'
                ]
            );

            $book->update($request->all());
            $book->authors()->detach();
            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            return redirect('books')->with('success', 'Book updated successfully!');
        }

        return view('books/edit', [
            'book' => $book, 'authors' => $authors, 'categories' => $categories
        ]);
    }
}
