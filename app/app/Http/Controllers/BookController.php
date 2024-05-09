<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publisher = $request->input('publisher');
        $book->released_at = $request->input('released_at');
        $book->stock = $request->input('stock');
        $book->cost = $request->input('cost');
        $book->genre_id = $request->input('genre_id');
        $book->author_id = $request->input('author_id');

        $book->save();

        return redirect()->route('add');

    }

    /**
     * Display all books.
     */

     public function showAll(Request $request)
     {
         $sortBy = $request->input('sort_by', 'default');
     
         switch ($sortBy) {
             case 'newest':
                 $booksQuery = Book::orderBy('released_at', 'desc');
                 break;
             case 'cheapest':
                 $booksQuery = Book::orderBy('cost');
                 break;
             case 'most_expensive':
                 $booksQuery = Book::orderBy('cost', 'desc');
                 break;
             default:
                 $booksQuery = Book::query();
                 break;
         }
     
         $books = $booksQuery->paginate(10); // Paginate the results, 10 items per page
     
         return view('pages/home', [
             'books' => $books,
             'title' => 'E-SHOP',
             'sort_by' => $sortBy
         ]);
     }
     

    public function showAllAdmin() {
        $books = Book::all();
        return view('admin/edit', ['books' => $books, 'title' => 'E-SHOP']);
    }


    /**
     * Display all books from genre
     */
    public function showGenreBooks(Request $request) {
        $name = urldecode($request->query('name'));
        $genre = Genre::where('name', $name)->first();
        $sortBy = $request->input('sort_by', 'default');
        $books = null;

        switch ($sortBy) {
            case 'newest':
                $books = Book::orderBy('released_at', 'desc')->where('genre_id', $genre->id)->get();
                break;
            case 'cheapest':
                $books = Book::orderBy('cost')->where('genre_id', $genre->id)->get();
                break;
            case 'most_expensive':
                $books = Book::orderBy('cost', 'desc')->where('genre_id', $genre->id)->get();
                break;
            default:
                $books = Book::where('genre_id', $genre->id)->get();
                break;
        }

        return view('pages.home', ['books' => $books, 'title' => $name, 'sort_by' => $sortBy]);
    }

    /**
     *  Display a certain book
     */

    public function show(Request $request) {
        $name = urldecode($request->query('name'));
        $book = Book::where('title', $name)->first();

        return view('pages.book', ['book' => $book, 'title' => $name]);
    }
    public function showAdmin(Request $request) {
        $name = urldecode($request->query('name'));
        $book = Book::where('title', $name)->first();

        return view('admin.edit_book', ['book' => $book, 'title' => $name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $name = urldecode($request->query('name'));
        $book = Book::where('title', $name)->first();

        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publisher = $request->input('publisher');
        $book->released_at = $request->input('released_at');
        $book->stock = $request->input('stock');
        $book->cost = $request->input('cost');
        $book->genre_id = $request->input('genre');
        $book->author_id = $request->input('author');

        $book->save();

        return redirect()->route('edit');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Book $book)
    {
        $name = urldecode($request->query('name'));
        $book = Book::where('title', $name)->first();

        $book->delete();

        return redirect()->route('edit');    }
}
