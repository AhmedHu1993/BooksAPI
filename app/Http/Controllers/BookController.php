<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $searchedBooks = Book::query();

        $category = $request->query('category');
        if ($category) {
            $searchedBooks->where('category', 'LIKE', '%' . $category . '%');
        }

        $author = $request->query('author');
        if ($author) {
            $searchedBooks->where('author', 'LIKE', '%' . $author . '%');
        }

        return response($searchedBooks->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     *
     * @return Response
     */
    public function store(StoreBookRequest $request): Response
    {
        $validation = $request->validate([
            'isbn' => [
                'required',
                'regex:/^(?:ISBN(?:-13)?:?\ *(97(?:8|9)([ -]?)(?=\d{1,5}\2?\d{1,7}\2?\d{1,6}\2?\d)(?:\d\2*){9}\d))$/i',
                'max:17'
            ]
        ]);

        $newBook = Book::create($request->all());
        return response($newBook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     *
     * @return Response
     */
    public function show(Book $book): Response
    {
        return response($book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     *
     * @return Response
     */
    public function update(UpdateBookRequest $request, Book $book): Response
    {
        $book->update($request->all());
        return response($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book  $book
     *
     * @return Response
     */
    public function destroy(Book $book): Response
    {
        $book->delete();
        return response('', 204);
    }
}
