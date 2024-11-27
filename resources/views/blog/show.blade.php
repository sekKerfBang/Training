@extends('base')
@section('title', $post->title)

@section('content') 
    <article>
        <h1> {{ $post->title}} </h1>
        <p>
            {{ $post->content }}
        </p> 
            {{-- <a href="{{ route('blog.show', ['slug'=> $post->slug, 'id'=> $post->id]) }}" class="btn btn-primary">Lire la suite</a> --}}
        
    </article> 
        
    

    {{-- {{ $posts->links() }} --}}
    {{-- @dump($posts) --}}

@endsection
