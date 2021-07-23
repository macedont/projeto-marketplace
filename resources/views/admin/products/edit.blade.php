@extends('layouts.app')
@section('content')

    <form action="{{route('admin.products.update', ["product" => $product->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto:</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{$product->name}}">
            @error('name')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{$product->description}}">
            @error('description')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="body" class="form-control @error('body')is-invalid @enderror" cols="30" rows="3">{{$product->body}}</textarea>
            @error('body')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control @error('price')is-invalid @enderror" name="price" value="{{$product->price}}">
            @error('price')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Atualizar Produto</button>
        </div>
    </form>

@endsection
