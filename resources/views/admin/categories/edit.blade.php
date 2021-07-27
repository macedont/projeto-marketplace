@extends('layouts.app')
@section('content')

    <form action="{{route('admin.categories.update', ["category" => $category->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{$category->name}}">
            @error('name')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{$category->description}}">
            @error('description')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories">Categorias:</label>
            <select name="categories[]" class="form-control @error('categories')is-invalid @enderror" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('categories')
            <div class="invalid-feedback">
                <p>{{$message}}</p>
            </div>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Atualizar Categoria</button>
        </div>
    </form>

@endsection
