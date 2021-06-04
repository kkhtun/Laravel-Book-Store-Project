@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header flex">
                    <div>
                    {{ __('Dashboard') }}
                    </div>

                @if (request("select") == "books" || !request("select"))
                    <div class="ml-auto flex space-x-4">
                        {{-- <div class="text-center">
                            <input type="text" class="w-75">
                        </div> --}}
                        <div class="hover:bg-gray-300 px-2">
                            <a href="#" class="hover:text-black hover:no-underline">{{ __('Add Book') }}</a>
                        </div>
                        <div class="px-2">
                            <select name="category" id="categorySearch">
                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>
                @endif

                @if (request("select") == "categories")
                    <div class="ml-auto flex space-x-4">
                        <div class="hover:bg-gray-300 px-2">
                            <a href="/cat?perform=add" class="hover:text-black hover:no-underline">{{ __('Add Category') }}</a>
                        </div>
                    </div>
                @endif

                </div>

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}

                @if (request("select") == "books" || !request("select"))
                <table class="table-striped table-bordered">
                    <thead>
                    <tr class="text-center py-2 px-2">
                        <th>Book Name</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>About</th>
                        <th>Filename</th>
                        <th>Last Modified</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                    <tr class="">
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->about }}</td>
                        <td>{{ $item->filename }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif

                @if (request("select") == "categories")
                <table class="table-striped table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Last Modified</th>
                        <th>Edit or Remove</th>
                    </tr>
                    </thead>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="flex px-4 space-x-2">
                            <a class="px-2 py-1 bg-gray-300 text-black hover:bg-gray-100 hover:text-bold" 
                            href="/cat?perform=edit&id={{$item->id}}">Edit</a>
                            <a class="px-2 py-1 bg-gray-300 text-black hover:bg-gray-100 hover:text-bold" 
                            href="/cat?perform=delete&id={{$item->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
