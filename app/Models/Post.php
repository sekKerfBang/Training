<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    // cette fonction nous permet de specifier les champs que nous pouvons remplir avec la fonction create  
    protected $fillable = [
        'title', 
        'slug',
        'content'
    ];

    //guarded nous permet d'implementer le l'inverse
    protected $guarded = [

    ];
}
