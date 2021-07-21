@extends('layouts.app')
@section('content')

    <form action="{{route('admin.products.update', ["product" => $product->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto:</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control" name="description" value="{{$product->description}}">
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="body" class="form-control" cols="30" rows="3">{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control" name="price" value="{{$product->price}}">
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Atualizar Produto</button>
        </div>
    </form>

@endsection
