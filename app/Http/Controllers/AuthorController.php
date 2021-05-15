<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
     public function create()
     {
         return view('authors.create');
     }
     public function store()
     {
         Author::create($this->validateAuthor());
     }

     protected function validateAuthor()
     {
         return  request()->validate([
             'name' => 'required',
             'dob' => 'required',
         ]);
     }
}
