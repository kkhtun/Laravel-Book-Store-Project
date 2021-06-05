<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (request("select") == "books" || !request("select")) {
            $items = Book::all();
        } else if (request("select") == "categories") {
            $items = Category::all();
        }
        return view("home", ["items"=> $items]);
    }
}
