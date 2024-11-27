@extends('base')
@section('title', 'Accueil Blog')

@section('content') 
    @foreach ($posts as $post)
    <article>
        <h1> {{ $post->title }} </h1>
        <p>
            {{ $post->content }}
        </p> 
            <a href="{{ route('blog.show', ['slug'=> $post->slug, 'post'=> $post->id]) }}" class="btn btn-primary">Lire la suite</a>
        
    </article>
        
    @endforeach
    

    {{ $posts->links() }}
    {{-- @dump($posts) --}}

@endsection
