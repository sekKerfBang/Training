<form action="" method="post" enctype="multipart/form-data" >
    @csrf 
    @method($post->id ? "PATCH" : "POST")
    <div class="form-group">
        <label for="image">Image</label>
        <input  class="form-control" type="file" id='image' name="image" >
        @error('image')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="title">Titre</label>
        <input  class="form-control" type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input  class="form-control" type="text" name="slug" value="{{ old('slug', $post->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" > {{ old('content', $post->content) }} </textarea>
    @error('content')
        {{ $message }}
    @enderror
</div>
<div class="form-group">
    <label for="category">Categories</label>
    <select name="category_id" id="category" class="form-control">
        <option value="" >Selectionner une categorie </option>
        @foreach ($categories as $category)
        <option  @selected(old('category_id', $post->category_id) == $category->id ) value="{{ $category->id }}"> {{ $category->name }} </option>
            
        @endforeach
        </select>
    @error('category_id')
        {{ $message }}
    @enderror
</div>
@php
    $tagsIds = $post->tags()->pluck('id');
@endphp
<div class="form-group">
    <label for="tag">Tag</label>
    <select name="tags[]" id="tags" class="form-control" multiple>
        @foreach ($tags as $tag)
        <option  @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}"> {{ $tag->name }} </option>
        @endforeach
        </select>
    @error('tags')
        {{ $message }}
    @enderror
</div>   

    <button class="btn btn-primary my-2 w-100">
        @if ($post->id)
            Modifier
        @else 
            Creer   
        @endif
    </button>
</form>