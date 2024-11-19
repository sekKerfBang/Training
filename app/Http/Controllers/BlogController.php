<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Post;
use View;

class BlogController extends Controller
{
    
    public function index() {
        $post = Post::all();
        return view('blog.index',[
            'posts' => $post,
        ]);
    }

    public function show(string $slug, string $id ){
        $post = Post::findOrFail($id); 
        if($post->slug !== $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view(view: 'blog.show', data: ['post' => $post]);

    }
}
