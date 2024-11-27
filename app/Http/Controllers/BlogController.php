<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Any;
use Illuminate\View\View;

class BlogController extends Controller
{
    
    public function index():View {
      //  BlogFilterRequest $request
    //     $validator = Validator::make([
    //         "title"=> ""
    //     ], [ 
    //         "title"=> "required|min:8",
    //     ]
    // );
    //dd($validator->validated("title"));
    //dd($validator->errors());
    //dd($validator->fails());
        $post = Post::Paginate(2);
        return view('blog.index',[
            'posts' => $post,
        ]);
    }

    public function show(Post $post): RedirectResponse | View {
        
        //dd($post);
        //$post = Post::findOrFail($post); 
        //dd($post);
        // if($post->slug !== $slug){
        //     return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id]);
        // }
        
        return view('blog.show', [
            'post' => $post
            ]);
    }
    public function create(){
        //dd(session()->all());
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
    }

    public function store(CreatePostRequest $request) {
        $post = Post::create($request->validated());
        // $post = Post::create([
        //     'title'   => $request->input('title'),
        //     'content' => $request->input('content'),
        //     'slug' =>\Str::slug($request->input('title')),
        // ]);
        return redirect()->route('blog.show', ['slug'=>$post->slug, 'post'=>$post->id])->with('success', 'L\'article a bien ete sauvegarder');
        // dd($request->all());
}

    public function edit(Post $post): View {
        return view('blog.edit', [
            'post'=> $post
        ]);
    }

    public function update(Post $post, CreatePostRequest $request) { 
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug'=>$post->slug, 'post' => $post->id])->with('success','l\'article a bien ete modifier ');
    }

}