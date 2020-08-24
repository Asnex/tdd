<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store()
    {

         $book = Book::create($this->validate_request());

         return redirect($book->path());
    }

    public function update(Book $book)
    {
        $book->update($this->validate_request());

        return redirect($book->path());
    }

    public function destroy(Book $book)
    {
         $book->delete();

         return redirect('/books');
    }

    private function validate_request()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
