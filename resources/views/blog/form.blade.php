<form action="" method="post">
    @csrf 
    @method($post->id ? "PATCH" : "POST")
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
    
    <button class="btn btn-primary my-2 w-100">
        @if ($post->id)
            Modifier
        @else 
            Creer   
        @endif
    </button>
</form>