<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(): View
    {
        // select * from categories
        $categories = Category::all();

        return view('categories/index', [
            'categories' => $categories
        ]);
        
    }

    public function show(int $id): View
    {
        // dd($id);
        $category = Category::find($id);
        // dd($category->books);
        // $category->books;

        if ($category === null) {
            abort(404);
        }
        // $category->books;
        // $book->category;

        return view('categories/show', [
            'category' => $category
        ]);
    }

    //saugojimo funkcija:
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $request->validated();
        Category::create($request->all());
        return redirect('categories')
            ->with('success', 'Category created successfully!');
    }

    //atsakinga uz atvaizdavima create formos
    public function create(): View|RedirectResponse
    {
        return view('categories/create');
    }


    public function edit(int $id, Request $request)
    {
        $category = Category::find($id); //=select * from categories where id = {$id} = new Category()
        if ($category === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                ['name' => 'required|min:3|max:20']
            );

            // $request->validated();


            // $category->name = $request->post('name');
            $category->fill($request->all());
            $category->enabled = $request->post('enabled', false);
            $category->save();


            // arba kitas metodas, vietoj 3 eiluciu tik viena:
            // $category->update($request->all());
            return redirect('categories')->with('success', 'Category updated successfully!');
        }

        // dd($category);
        return view('categories/edit', [
            'category' => $category
        ]);
    }

    public function delete(int $id)
    {
        //1. Gaunam pagal id kokia kategorija isvalyt
        $category = Category::find($id);
        //2. Patikrinam ar tokia egzistuoja
        if ($category === null) {
            //3. jeigu neegzistuoja metam 404
            abort(404);
        }
        //4. jeigu egzistuoja isvalom
        $category->delete();
        //5. Po sėkmingo išvalymo redirectinam su sėkmės pranešimu.
        return redirect('categories')->with('success', 'Category removed successfully!');
    }
}
