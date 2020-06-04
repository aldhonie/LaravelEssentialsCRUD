<?php

namespace App\Http\Controllers;

use App\Books;
use App\Categories;
use App\Keywords;
use App\BooksCategories;
use App\BooksKeywords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::with(['categories:name','keywords:name'])->paginate(5);
       
        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        $keywords =  Keywords::all();

        return view('books.create')
            ->with('categories', $categories)
            ->with('keywords', $keywords);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'keywords' => 'required',
            'price' =>  'required',
            'quantity' => 'required',
            'publisher' => 'required',
        ]);

        $book = Books::create($request->all());
        
        $categories = collect($request->input('categories'))
            ->map(function($category) use($book) {
                return [
                    'book_id' => $book->id,
                    'category_id' => $category
                ];
            })->values()->toArray();  

        DB::table('books_categories')->insert($categories);

        $keywords = collect($request->input('keywords'))
            ->map(function($keyword) use($book) {
                return [
                    'book_id' => $book->id,
                    'keyword_id' => $keyword
                ];
            })->toArray();

        DB::table('books_keywords')->insert($keywords);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $book)
    {
        $book = $book->with(['categories', 'keywords'])->where('id', $book->id)->first();

        $categories = Categories::all()
            ->map(function($category) use($book) {
                return (object) [
                    'id' => $category->id,
                    'name' => $category->name,
                    'checked' => ($book->categories)
                        ->filter(function($bookCat) use($category) {
                            return $bookCat->id == $category->id;
                        })->toArray() ? true : false
                ];
            });

        $keywords = Keywords::all()
            ->map(function($keyword) use($book) {
                return (object) [
                    'id' => $keyword->id,
                    'name' => $keyword->name,
                    'checked' => ($book->keywords)
                        ->filter(function($bookKey) use($keyword) {
                            return $bookKey->id == $keyword->id;
                        })->toArray() ? true : false
                ];
            });
        
        return view('books.edit')
            ->with('book', $book)
            ->with('keywords', $keywords)
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $book)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'keywords' => 'required',
            'price' =>  'required',
            'quantity' => 'required',
            'publisher' => 'required',
        ]);


        $book->update($request->all());

        BooksKeywords::where('book_id', $book->id)->delete();
        BooksCategories::where('book_id', $book->id)->delete();
        
        $categories = collect($request->input('categories'))
        ->map(function($category) use($book) {
            return [
                'book_id' => (int) $book->id,
                'category_id' => (int) $category
            ];
        })->values()->toArray();  

        BooksCategories::insert($categories);

        $keywords = collect($request->input('keywords'))
        ->map(function($keyword) use($book) {
            return [
                'book_id' => (int) $book->id,
                'keyword_id' => (int) $keyword
            ];
        })->toArray();
        
        BooksKeywords::insert($keywords);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $book)
    {   
        BooksCategories::where('book_id', $book->id)->delete();
        BooksKeywords::where('book_id', $book->id)->delete();
        $book->delete();

        return redirect()->route('books.index');
    }
}
