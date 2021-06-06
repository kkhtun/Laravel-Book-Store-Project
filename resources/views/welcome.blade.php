@extends('layouts.user-layout')
@section('user-content')
        <section class="container">
                <form action="/" method="GET" class="text-center lg:float-right">
                    <label for="categorySearch" class="pr-2">Filter By Category</label>
                    <select name="categorySearch" id="categorySearch" class="px-2 py-1 border border-2 border-gray-500 rounded-md" onchange="this.form.submit();">
                            <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request("categorySearch") ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </section>

        <section class="container lg:mt-14 mt-8">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-2">
                @foreach($books as $book)
                <div class="grid grid-cols-12 border border-1 rounded-md">
                    <div class="col-span-3 p-2">
                        {{ $book->filename.'.png' }}
                    </div>
                    <div class="col-span-9 p-2 space-y-4">
                        <h2 class="font-weight-bold">{{ $book->name }}</h2>
                        <p class="text-muted text-md">{{ $book->author }}</p>
                        <p><span class="bg-blue-500 text-white rounded-2xl px-3 py-1">{{ $book->category->name }}</span></p>
                    </div>
                </div>
                @endforeach

            </div>
        </section>
@endsection
