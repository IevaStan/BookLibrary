<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{

    // public function index(Request $request)
    public function index(): View
    {
        $categories = Category::all()->where('enabled', '=', 1);
        return view('categories/index', [
            'categories'=>$categories
        ]);


        $page = $request->get('page');
        $name = $request->get('name');

        // var_dump($request->is('categories'));

        $uri = $request->path();
        $url = $request->url();
        $fullUrl = $request->fullUrl();
        $host = $request->host();

        echo $host;


    }

    public function show($id): Response
    {
        return view('categories/show');
        if ($id == 1) {
            return response()->view('categories/show');
        }

        return response()->view('categories/error', [], 404);
    }

    public function store(Request $request): View
    {
        if ($request->isMethod('post')) {
            $name = $request->post('full_name');

            return view('categories/store', [
                'name' => $name
            ]);
        }

        return view('categories/store');
    }

    public function json(): JsonResponse
    {
        return response()->json(
            [
                'product_name' => 'TV',
                'price' => 333
            ]
        );
    }


    public function index()
    {
        $array = Category::all();
        return view('categories/index', [
            'categories' => $array
        ]);
    }

    public function show($id)
    {
        $books = Book::all();
        $books = $books->where('category_id', $id);

        // dd(Category::find(1)->category($id));
        return view('categories/show', [
            'category' => Category::find($id),
            'books' => $books
        ]);
    }
}
