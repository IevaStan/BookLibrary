<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        // $array = Author::all();
        // return view('authors/index', [
        //     'authors' => $array
        // ]);

        $authors = Author::all();
        return view('authors/index', [
            'authors' => $authors
        ]);
    }


    // public function show($id): View
    // {
    //     $author = Author::find($id);
    //     if ($author === null) {abort(404); }
    //     return view('authors/show', ['author' => $author]);
    // }

    public function show(Author $author): View
    {
        return view('authors/show', compact('author'));
    }


    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate(
            [
                'name' => 'required|max:20',
                'surname' => 'required|max:20',
                'country' => 'required|max:20',
                'birthdate' => 'required|date',
            ]
        );

        Author::create($request->all());
        // dd($request);
        //TODO change to authors list
        return redirect('authors')
            ->with('success', 'Author created successfully!');
    }


    //atsakinga uz atvaizdavima create formos
    public function create(): View
    {
        return view('authors/create');
    }

    public function delete(int $id)
    {
        $author = Author::find($id);
        if ($author === null) {
            abort(404);
        }
        $author->delete();
        return redirect('authors')->with('success', 'Author removed successfully!');
    }




    

    public function edit(int $id, Request $request)
    {
        $author = Author::find($id);
        if ($author === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate(
                ['name' => 'required|min:3|max:40'],
                ['surname' => 'required|min:3|max:40'],
                ['country' => 'required|min:2|max:60'],
                ['birthdate' => 'required|date']
            );
            $author->update($request->all());

            return redirect('authors')->with('success', 'Author updated successfully!');
        }

        return view('authors/edit', [
            'author' => $author
        ]);
    }


    public function update(StoreAuthorRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        $author = Author::find($id);
        $author->update($request->all());
        return redirect('authors')->with('success', 'Author updated successfully!');
    }
}
