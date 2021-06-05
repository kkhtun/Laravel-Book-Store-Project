<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BookController extends Controller
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

    // functions related to admin book management 
    public function bookView() {
        if (request("id") && request("perform") == "edit") { //book edit view
            $book = Book::find(request("id"));
            $categories = Category::all('id','name');
            // For user checking file
            if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
                return view("book-edit", ["book" => $book, "categories"=>$categories, "filecheck"=> true]);
            } else {
                return view("book-edit", ["book" => $book, "categories"=>$categories, "filecheck"=> false]);
            }
            return view("book-edit", ["book" => $book, "categories"=>$categories]);
        } else if (request("id") && request("perform") == "delete") { //book delete confirm view
            $book = Book::find(request("id"));
            return view("book-delete-confirm", ["book" => $book]);
        } else if (request("id") && !request("perform")) { //view single book detail
            $book = Book::find(request("id"));
            return view("book-view-admin", ["book" => $book]);
        } else if (!request("id") && request("perform")=="add") { //book add view
            $categories = Category::all('id','name');
            return view("book-new", ["categories"=>$categories]);
        }
    }

    public function bookAdd(Request $req) {
        $this->validateRequest($req);
        $book = new Book;
        $book->name = $req->name;
        $book->category_id = $req->category;
        $book->author = $req->author;
        $book->about = $req->about;

        if ($req->file('pdf')) {
            $file = $req->file('pdf');
            $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // File upload location
            $location = 'books';
            // Upload file add pdf extension
            $file->move($location, $filename.'.'.$file->getClientOriginalExtension());
            // Save the filename without extension in database
            $book->filename = $filename;
            $result = $book->save();

            $this->addSessionFlash($result, "added");
            return redirect("/home?select=books");
        } else {
            $this->addSessionFlash(false, "Uploaded", "File not uploaded.");
            return redirect("/home?select=books");
        }

    }

    public function bookDelete(Request $req) {
        $book = Book::find($req->id);
        if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
            File::delete(public_path('books/'.$book->filename.'.pdf'));
        } else {
            $this->addSessionFlash(false, "deleted", "PDF File does not exist.");
            return redirect("/book-view?id=$req->id"); 
        }
        $result = $book->delete();
        $this->addSessionFlash($result, "deleted");
        return redirect('/home?select=books'); 
    }
    
    public function bookUpdate(Request $req) {
        $this->validateRequestWithoutFile($req);
        $book = Book::find($req->id);
        $book->name = $req->name;
        $book->category_id = $req->category;
        $book->author = $req->author;
        $book->about = $req->about;

        if ($req->file('pdf')) {
            $file = $req->file('pdf');
            $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // File upload location
            $location = 'books';
            // Upload file add pdf extension
            $file->move($location, $filename.'.'.$file->getClientOriginalExtension());
            // Delete the old file
            $checkMessage = ""; // This message will be added concatenated to check if old pdf file is deleted or not
            if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
                File::delete(public_path('books/'.$book->filename.'.pdf'));
                $checkMessage = " Old PDF file has been deleted.";
            } else {
                $checkMessage = " [Cannot find old PDF file]";
            }
            // Save the filename without extension in database
            $book->filename = $filename;
            // Save the records in database
            $result = $book->save();

            $checkMessage = "New PDF file has been updated.". $checkMessage;
            $this->addSessionFlash($result, "updated", $checkMessage);
            return redirect("/book-view?id=$req->id");
        } else {
            $result = $book->save();
            $this->addSessionFlash($result, "updated", "No New PDF file detected.");
            return redirect("/book-view?id=$req->id");
        }
    }






    public function download($filename){
        $file = public_path()."/books/".$filename.".pdf";
        $headers = array("Content-Type" => "application/pdf");
        return response()->file($file, $headers);
        // return response()->download($file, 'test_book_1.pdf',$headers);
    }

    //Helper function to add session variables
    private function addSessionFlash($check, $string, $error="") {
        if ($check) {
            session(['type' => 'success', 'message'=>"Book $string successfully. $error"]);
        } else {
            session(['type' => 'danger', 'message'=>"There was an error. Please try again. $error"]);
        }
    }

    //Helper functions to validate incoming request data accepts $req as input
    private function validateRequest($request) {
        $validated = $request->validate([
            'name'=>'required',
            'author'=>'required',
            'about'=>'required',
            'category'=>'required',
            'pdf' => 'required|mimes:pdf'
        ]);
    }
    private function validateRequestWithoutFile($request) {
        $validated = $request->validate([
            'name'=>'required',
            'author'=>'required',
            'about'=>'required',
            'category'=>'required'
        ]);
    }

}
