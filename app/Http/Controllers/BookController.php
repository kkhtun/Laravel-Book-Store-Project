<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    function index() {
        return view('home');
    }
    
    public function download($filename){
        $file = public_path()."/books/".$filename.".pdf";
        $headers = array("Content-Type" => "application/pdf");
        return response()->file($file, $headers);
        // return response()->download($file, 'test_book_1.pdf',$headers);
        
    }
}
