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

    // Category links for delete and edit will be displayed inline in the table, no individual views need for each item
    public function category() {
        if (request("perform") == "add") {
            return view("cat-new");
        } else if (request("perform") == "edit" && request("id")) {
            $category = Category::find(request("id"));
            return view("cat-edit", ["category" => $category]);
        } else if (request("perform") == "delete" && request("id")) {
            $category = Category::find(request("id"));
            return view("cat-delete-confirm", ["category" => $category]);
        }
    }

    public function catAdd(Request $req) {
        $categories = new Category;
        $categories->name = $req->name;
        $categories->description = $req->description;
        $result = $categories->save();
        if ($result) {
            session(['type' => 'success', 'message'=>"Category added successfully"]);
        } else {
            session(['type' => 'danger', 'message'=>"There was an error. Please try again."]);
        }
        return redirect('/home?select=categories');
    }

    public function catUpdate(Request $req) {
        $category = Category::find($req->id);
        $category->name = $req->name;
        $category->description = $req->description;
        $category->save();
        return redirect('/home?select=categories');
    }

    public function catDelete(Request $req) {
        $category = Category::find($req->id);
        $category->delete();
        return redirect('/home?select=categories'); 
    }

    // functions related to admin book management 
    public function bookView() {
        if (request("id") && request("perform") == "edit") {
            echo "book edit view";
        } else if (request("id") && request("perform") == "delete") {
            echo "confirm book delete view";
        } else if (request("id") && !request("perform")) {
            $book = Book::find(request("id"));
            return view("book-view-admin", ["book" => $book]);
        } else if (!request("id") && request("perform")=="add") {
            $categories = Category::all('id','name');
            return view("book-new", ["categories"=>$categories]);
        }
    }

    public function bookAdd(Request $req) {
        return $req->input();
    }
}
