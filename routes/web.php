<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use \App\Models\Post;
use App\Http\Controllers\BlogController;

/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(callback: function (){
        Route::get('/', 'index' )->name('index');
        Route::get('/new','create')->name('create');
        Route::post('/new','store');
        Route::get('/{post}/edit', 'edit')->name('edit');
        Route::patch('/{post}/edit','update');
        // function(Request $request){
        //     // Insertion des donnees dans la base de donnee
        //     // $post = new Post();
        //     // $post -> title = "Mon second article";
        //     // $post -> slug = "Mon  seconde  article";
        //     // $post -> content = "Ma seconde contenue ";
        //     // $post -> save();
        //     // Seconde Insertion
        //     // $post = new Post();
        //     // $post -> title = "Mon second article";
        //     // $post -> slug = "Mon Second article";
        //     // $post -> content = "Ma seconde contenue";
        //     // $post -> save();

        //     //Acceder a toute les donnees de la base de donnee pour l'afficher au niveau frontend il faut 
        //     //$post =   Post::all(['id', 'title']);
        //     //$post = Post::findOrFail(3);  // find nous permettant de recuperer une data specifique ou findOrFail idem sauf s'il ne trouve pas l'Id et apres envera une erreur 404
        //     //$post = Post::paginate(1,['id', 'title'] ); // permettant la pagination. pour ne pas exposer ma base donnee, nous pouvons lister les attributs que l'on souhaite voir  
        //     // dd ou dai and debug
        //     // quand on fait appelle a la bdd, il se passe de l'hydratation avec les donnees de la base de donnees
        //    // dd($post[0]->title);
        //    // first est un attribut de la collection
        //   // $post = Post::where('id', '>', '0')->limit(1)->get();// quelque requettes sql 
        //     //dd($post);
        //     //  pour une autre methode d'insertion de data avec create 
        //     // $post = Post::create
        //         // $post = Post::where('id', '>', '1')->delete();
        //         // 'title' => 'Nouveau titre-2',
        //         // 'slug' => 'Nouveau titre-2',
        //         // 'content' => 'Nouvelle Contenue-200'
        //     // $post->title = "tu viens de me modifier Nobody";
        //     // $post->delete();
            
            
        //   //  return $post;

            
        // }
        
        // Route::get('/{slug}/{post}', 'show')->where([
        //     'slug', '[a-zA-Z0-9\-]+',
        //     'post', '[0-9]+'
        //     ])->name('show');
        Route::get('/{post}', 'show')->where(
            ['post'=> '[a-zA-Z0-9\-]+']
            )->name('show');
});
        // function(string $slug, int $id, Request $request){
            
        //     // return [
        //     //     'slug' => $slug,
        //     //     'id'   => $id,
        //     //     'name' => $request->input('name', 'kerfala'),
        //     // ];
        // }