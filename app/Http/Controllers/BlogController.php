<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Any;
use Illuminate\View\View;

class BlogController extends Controller
{
    
    public function index():View {
    
        // User::create([
        //     "name"=> "bangoura",
        //     "email"=> "bang@bks.gn",
        //     "password"=> Hash::make('2222')
        // ]);
        // $post = Post::find(4);
        // methode sync pour assigner et enlever un tag dans une table de relation
       // $tag = $post->tags()->sync([1, 2]);
        // methode attach pour assigner un tag a une table de relation  
        //$tag = $post->tags()->attach(2);
        //methode detach pour enlever un tag a une table de relation  
        //$tag = $post->tags()->detach(2);
        // $tag = $post->tags()->where('name', 'tag 1')->get();

        // $post->tags()->createMany([[
        //     'name' => 'tag 1',
        // ], 
        // [
        //     'name' => 'tag 2'
        // ]]);

        // $categorie = Category::find(1);
        // // si on veut associer un article a un ou plusieurs categorie
        // $post = Post::find(6);
        // // relation de type (1,n)
        // $post->category()->associate($categorie);
        // $post->save();


        //dd($categorie->posts)->where("id",">", "10")->get();
        // iguerreloading nous permettant de precharger les donnees
        // $posts =  Post::with('category')->get();
        // foreach ($posts as $post ) {
        //     $category = $post->category?->name;   
        // }
    
        // $post->category_id = 2;
        // $post->save();
        //$category = ($post->category->name);
        // $post->category_id = 1;
        // $post->save();

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
        $post = Post::with('tags', 'category')->Paginate(10);
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

    public function store(FormPostRequest $request) {
        $post = new Post();
        $post = Post::create($this->extractData( $post, $request));
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
            'post'=> $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function update(Post $post, FormPostRequest $request) {         
        $post->update($this->extractData( $post, $request));
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug'=>$post->slug, 'post' => $post->id])->with('success','l\'article a bien ete modifier ');
    }

    private function extractData(Post $post, FormPostRequest $request):array
    {
        $data = $request->validated();
        /**  @var UploadeadFile|null $image */
        $image = $request->validated('image');
        if( $image == null || $image->getError()) {
            return $data;
        }
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $data['image']= $image->store('blog', 'public');
        return $data;
        }
    }