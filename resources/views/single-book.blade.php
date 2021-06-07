@extends('layouts.user-layout')
@section('user-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <x-flash-message />
            <div class="card">
                <div class="card-header">{{ __('Book Details') }}</div>

                <div class="card-body grid grid-cols-6 gap-2">

                    <div class="lg:col-span-1 col-span-2">
                        <img src="books/test.jpg" alt="" class="rounded-md">
                    </div>

                    <div class="lg:col-span-5 col-span-4 pl-2 relative">
                            <h2 class="text-2xl">{{ $book->name }}</h2>
                            <small class="font-semibold">{{ $book->author }}</small>  
                            <p class="lg:absolute top-0 right-0"><small class="border border-1 bg-blue-500 text-white rounded-md px-3 lg:py-1">{{ $book->category->name }}</small></p>

                            <p class="mt-3 p-2 border border-1 rounded-md">{{ $book->about }}</p>                  
                            <button class="mt-2 btn btn-success font-semibold">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
