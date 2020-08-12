<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store()
    {

         Book::create($this->validate_request());
    }

    public function update(Book $book)
    {
        $book->update($this->validate_request());
    }

    private function validate_request()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
