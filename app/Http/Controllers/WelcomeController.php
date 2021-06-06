<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
class WelcomeController extends Controller
{
    //
    function index () {
        if (request("categorySearch")) {
            $books = Book::where('category_id', request('categorySearch'))->with('category')->get();
        } else {
            $books = Book::with('category')->get(); //with() to prevent lazy loading of laravel
        }
        $categories = Category::all();
        return view('welcome', ["books"=>$books, "categories"=>$categories]);
    }
    
}
