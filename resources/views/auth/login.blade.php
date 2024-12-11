@extends('base')

@section('content')
    <h1>Se connecter</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('auth.login') }}" method="post" class="vstack gap-3" >
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input  class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input  class="form-control" type="password" name="password" >
                    @error('password')
                        {{ $message }}  
                    @enderror 
                </div>
                <button type="submit" class="btn btn-primary"> Se connecter</button>
            </form>
        </div>
    </div>
@endsection