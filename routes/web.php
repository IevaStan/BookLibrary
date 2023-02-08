<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::redirect('/', 'hello', 301);

//user/2
Route::get('user/{id}', function ($id) {
    return 'User: '. $id;
});

//user/2/comments/5
Route::get('user/{id}/comments/{commentId}', function ($id, $commentId) {
    return 'User: '. $id . ' - '. $commentId;
});

// product/Mindaugas
// product
Route::get('product/{name?}', function ($name = 'Apple') {
    return $name;
});

// book/2
// LT23423423
Route::get('book/{id}', function ($id) {
    return $id;
})->where('id', '[A-Za-z]+');
//->where('id', '[0-9]+')
//->where('id', '[LT0-9]+')

Route::get('car/{id}/{name}', function ($id) {
    return $id;
})->whereNumber('id')->whereAlpha('name');*/

// GET index            books/index
// GET show/{id}        books/show/1
// GET create           books/create
// POST store           books/store
// GET edit/{id}        books/edit/1
// PUT update/{id}      books/update/1
// DELETE destroy/{id}  books/destroy/1



// Route::get('categories', [CategoryController::class, 'index']);
// Route::any('categories/save', [CategoryController::class, 'store']);
// Route::get('categories/json', [CategoryController::class, 'json']);
// //Route::post('categories/save', [CategoryController::class, 'store']);
// Route::get('categories/{id}', [CategoryController::class, 'show']);


/*Route::resource('books', BookController::class);

Route::resources([
    'books' => BookController::class,
    'users' => UserController::class,
    'categories' => CategoryController::class
]);*/

Route::get('products/create', [ProductController::class, 'create']);
Route::get('products', [ItemsController::class, 'index']);
Route::get('products/{id}', [ItemsController::class, 'show']);
// Route::get('products/{name}/{price}', [ItemsController::class, 'show']);

// Route::get('categories', [BookCategoryController::class, 'index']);
// Route::get('categories/{id}', [BookCategoryController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/create', [CategoryController::class, 'create']);
Route::post('categories/create', [CategoryController::class, 'store']);
Route::any('categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/create', [AuthorController::class, 'create']);
Route::post('authors/create', [AuthorController::class, 'store']);
Route::any('authors/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
// Route::post('authors/edit/{id}', [AuthorController::class, 'update'])->name('author.edit');
Route::delete('authors/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
// Route::get('authors/{id}', [AuthorController::class, 'show']);
Route::get('authors/{author}', [AuthorController::class, 'show']);


Route::get('books', [BookController::class, 'index']);
Route::get('books/create', [BookController::class, 'create']);
Route::post('books/store', [BookController::class, 'store']);
Route::any('books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::delete('books/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
Route::get('books/{id}', [BookController::class, 'show'])->whereNumber('id');

Route::get('login', [AuthController::class, 'show'])->middleware(['guest'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->middleware(['guest'])->name('authenticate');
Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');


Route::get('profile', [UserController::class, 'show'])->middleware(['auth'])->name('profile');

