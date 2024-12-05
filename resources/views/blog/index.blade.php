@extends('base')
@section('title', 'Accueil Blog')

@section('content') 
    @foreach ($posts as $post)
    <article>
        <h1> {{ $post->title }} </h1>
        <p class="small">
            @if ($post->category)
            Categorie: <strong>{{ $post->category?->name }}</strong> ,  
            @endif
            @if (!$post->tags->isEmpty())
                tags : 
                @foreach ($post->tags as $tag)
                    <span class="badge bg-secondary"> {{ $tag->name }} </span>
                @endforeach
            @endif
             </p>
        <p>
            {{ $post->content }}
        </p> 
            <a href="{{ route('blog.show', ['slug'=> $post->slug, 'post'=> $post->id]) }}" class="btn btn-primary">Lire la suite</a>
        
    </article>
        
    @endforeach
    

    {{ $posts->links() }}
    {{-- @dump($posts) --}}

@endsection
