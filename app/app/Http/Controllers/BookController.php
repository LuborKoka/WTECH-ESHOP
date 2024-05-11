<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
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
        $authorName = $request->input('author_id');
        $author = Author::where('name', $authorName)->first();

        if (!$author) {
            $author = new Author(); // ked nie je author v db tak ho pridame
            $author->name = $authorName;
            $author->save();
        }

        $book->author_id = $author->id;

        if($request->file('product_image_upload')){
            $file= $request->file('product_image_upload');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $book->images = 'images/' . $filename;
        }

        $book->save();

        return redirect()->route('add');

    }

    public function searchAll($queryItems, $booksQuery, $sortBy) {
        $booksQuery->where(function ($query) use ($queryItems) {
            foreach ($queryItems as $item) {
                $query->orWhere(function ($query) use ($item) {
                    $query->whereRaw("unaccent(publisher) ILIKE unaccent(?)", ["%{$item}%"])
                        ->orWhereHas('author', function ($query) use ($item) {
                            $query->whereRaw("unaccent(name) ILIKE unaccent(?)", ["%{$item}%"]);
                        })
                        ->orWhereRaw("unaccent(title) ILIKE unaccent(?)", ["%{$item}%"]);
                });
            }
        });

        $books = $booksQuery->paginate(10)->withQueryString();

        return view('pages/home', [
            'books' => $books,
            'title' => 'Výsledky vyhľadávania',
            'sort_by' => $sortBy,
            'includeFilter' => false
        ]);
    }

    /**
     * Display all books.
     */

    public function showAll(Request $request) {
        $sortBy = $request->input('sort_by', 'default');
        $query = $request->input('query', null);

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

        if ( $query !== null ) {
            $queryItems = explode(' ', $query);
            return $this->searchAll($queryItems, $booksQuery, $sortBy);
        }

        //toto je pre vytvorenie filter guika
        $bookData = $booksQuery->get();
        $filterData = $this->getFilterData($bookData);


        $publishersFilter = $request->input('publishers', []);
        if ( !empty($publishersFilter) ) {
            $publishersFilter = explode(',', $publishersFilter);
            $booksQuery->whereIn('publisher', $publishersFilter);
        }

        $authorsFilter = $request->input('authors', []);
        if ( !empty($authorsFilter) ) {
            $authorsFilter = explode(',', $authorsFilter);
            $booksQuery->whereHas('author', function ($query) use ($authorsFilter) {
                $query->whereIn('name', $authorsFilter);
            });
        }

        $minCost = $request->input('min_cost', 0);
        if ( $minCost > 0 ) {
            $booksQuery->where('cost', '>=', $minCost);
        }

        $maxCost = $request->input('max_cost', 0);
        if ( $maxCost > 0 ) {
            $booksQuery->where('cost', '<=', $maxCost);
        }


        $books = $booksQuery->paginate(10)->withQueryString();

        return view('pages/home', [
            'books' => $books,
            'title' => 'E-SHOP',
            'sort_by' => $sortBy,
            'authors' => $filterData['authors'],
            'publishers' => $filterData['publishers'],
            'maxCost' => $filterData['maxCost']
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
                $booksQuery = Book::where('genre_id', $genre->id)->orderBy('released_at', 'desc');
                break;
            case 'cheapest':
                $booksQuery = Book::where('genre_id', $genre->id)->orderBy('cost');
                break;
            case 'most_expensive':
                $booksQuery = Book::where('genre_id', $genre->id)->orderBy('cost', 'desc');
                break;
            default:
                $booksQuery = Book::where('genre_id', $genre->id);
                break;
        }


        //toto je pre vytvorenie filter guika
        $bookData = $booksQuery->get();
        $filterData = $this->getFilterData($bookData);


        $publishersFilter = $request->input('publishers', []);
        if ( !empty($publishersFilter) ) {
            $booksQuery->whereIn('publisher', $publishersFilter);
        }

        $authorsFilter = $request->input('authors', []);
        if ( !empty($authorsFilter) ) {
            $booksQuery->whereHas('author', function ($query) use ($authorsFilter) {
                $query->whereIn('name', $authorsFilter);
            });
        }

        $minCost = $request->input('min_cost', 0);
        if ( $minCost > 0 ) {
            $booksQuery->where('cost', '>=', $minCost);
        }

        $maxCost = $request->input('max_cost', 0);
        if ( $maxCost > 0 ) {
            $booksQuery->where('cost', '<=', $maxCost);
        }


        $books = $booksQuery->paginate(10)->withQueryString();

        return view('pages/home', [
            'books' => $books,
            'title' => 'E-SHOP',
            'sort_by' => $sortBy,
            'authors' => $filterData['authors'],
            'publishers' => $filterData['publishers'],
            'maxCost' => $filterData['maxCost']
        ]);
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
    public function destroy(Request $request, Book $book) {
        $name = urldecode($request->query('name'));
        $book = Book::where('title', $name)->first();

        $book->delete();

        return redirect()->route('edit');
    }

    public function getFilterData($bookData) {
        $publishers = [];
        $authors = [];
        $maxCost = 0;

        foreach ($bookData as $book) {
            $publisher = $book->publisher;
            if (!in_array($publisher, $publishers)) {
                $publishers[] = $publisher;
            }

            $author = $book->author->name;
            if (!in_array($author, $authors)) {
                $authors[] = $author;
            }

            if ($book->cost > $maxCost) {
                $maxCost = $book->cost;
            }
        }

        $maxCost = ceil($maxCost / 100) * 100;

        return [
            'maxCost' => $maxCost,
            'authors' => $authors,
            'publishers' => $publishers
        ];
    }
}
