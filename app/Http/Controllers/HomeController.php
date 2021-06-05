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
            if (request("categorySearch")) {
                $items = Book::where('category_id', request('categorySearch'))->with('category')->get();
            } else {
                $items = Book::with('category')->get(); //with() to prevent lazy loading of laravel
            }
            $categories = Category::all('id', 'name'); //for categorySearch filter
            return view("home", ["items"=> $items, "categories"=> $categories]);
        } else if (request("select") == "categories") {
            $items = Category::all();
            return view("home", ["items"=> $items]);
        }

    }
}
