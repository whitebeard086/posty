@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-md">
            @guest
                <div class="text-center mb-4">
                    <div class="bg-black text-white p-4 mb-5 rounded-md">
                        <h1 class="text-2xl font-medium mb-2">Welcome to Posty</h1>
                        <p class="mb-2">Please login or register to post and like posts</p>
                    </div>
                    <a href="{{ route('login') }}" class="bg-laravel hover:bg-black text-white px-4 py-2 rounded font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-laravel hover:bg-black text-white px-4 py-2 rounded font-medium">Register</a>
                </div>
            @endguest
            @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-laravel hover:bg-black text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth

            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>It's lonely here, post something!</p>
            @endif
        </div>
    </div>
@endsection