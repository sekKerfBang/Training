@extends('base')
@section('title', $post->title)

@section('content') 
    <article>
        <h1> {{ $post->title}} </h1>
        <p>
            {{ $post->content }}
        </p> 
        @if ($post->image)
        <img style="width: 100%; height:500px; object-fit:cover; border-radius:5px;" src="{{ $post->imageUrl() }}" alt="">
    @endif
            <p class=" my-5" >
                <a href="{{ route('blog.index') }}" class="btn btn-primary fw-bolder fs-5">accueil</a>
            </p>
        
    </article> 
        
    

    {{-- {{ $posts->links() }} --}}
    {{-- @dump($posts) --}}

@endsection
