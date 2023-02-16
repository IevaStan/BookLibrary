<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;


class BookController extends Controller
{
    public function index(Request $request): View
    {
        //FILTRAVIMAS
        //1. gauti filtrą iš requesto
        //2. pasitikrinti ar key yra request'e
        //3. jeigu yra, tuomet pridėti WHERE filtrą

        $books = Book::query(); //query builder

        if ($request->query('category_id')) {
            $books->where('category_id', '=', $request->query('category_id'));
        }
        if ($request->query('name')) {
            $books->where('name', 'like', '%' . $request->query('name') . '%');
        }
        // $books = $books->paginate(10); //paginate suskaido puslapį po n knygų

        $categories = Category::where('enabled', '=', 1)
            ->whereNull('category_id')
            ->with('childrenCategories')->get();
        return view('books/index', [
            'books' => $books->paginate(10),
            'categories' => $categories,
            'category_id' => $request->query('category_id'),
            'name' => $request->query('name'),
        ]);




        //withour naudojam nes į modelį dėjom protected $with = ['category', 'authors'];

        // $page = $request->get('page');

        // return view('books/index', [
        //     'books' => $books,
        // ]);
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

        $categories = Category::where('enabled', '=', 1)
            ->whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        return view('books/create', ['authors' => $authors, 'categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse|View
    {
        // 1. Papildyti formą mygtuku <input type - file +
        // 2. Pakeisti formos tipą (enctype="multipart/form-data") +
        // 3. Pasiziurėt requestą +
        // 4. Patalpinti failą +
        // 5. Prie knygos prisidėti lauką skirtą failo path: migraciją +
        // 6. Galėsim pasaugoti book image value prie duomenų bazės +
        // 7. Pabandysim nuotrauką atvaizduoti template, tam reikės naudoti symlink ir reikės assetus.



        $request->validate(
            [
                'name' => 'required',
                'page_count' => 'required',
                'description' => 'required|min:5|max:30',
                'author_id' => 'required',
                'category_id' => 'required',
                'image' => ['required', File::types(['jpg', 'jpeg', 'jfif', 'webp'])
                    ->min(1024)
                    ->max(10 * 1024),]
            ]
        );

        $book = Book::create($request->all());

        $file = $request->file('image'); //Objektas
        // $path = Storage::disk('public')->put('books_public', $file);
        $path = $file->store('book_images'); //Saugom į katalogą. -> book_images, nepamiršti įsidėti į linkus (config->filesystems)
        // $file->store('books');
        Storage::disk('public')->put('katalogas', $file); // public kataloge saugom
        $book->image = $path; //priskyrimas
        $book->save();

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

        $categories = Category::where('enabled', '=', 1)
            ->whereNull('category_id')
            ->with('childrenCategories')
            ->get();


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
                    'category_id' => 'required',
                    'image' => ['required', File::types(['jpg', 'jpeg', 'jfif', 'webp', 'avif'])->min(0.0001 * 1024)->max(10 * 1024)],
                ]
            );

            $book->update($request->all());
            $book->authors()->detach();

            $file = $request->file('image');
            $path = $file->store('book_images');
            Storage::disk('public')->put('katalogas', $file);
            $book->image = $path;
            $book->save();



            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            return redirect('books')->with('success', 'Book updated successfully!');
        }

        return view('books/edit', [
            'book' => $book, 'authors' => $authors, 'categories' => $categories
        ]);
    }
}
