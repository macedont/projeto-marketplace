@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label>Nome Produto:</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control" name="description">
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="body" class="form-control" cols="30" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control" name="price">
        </div>

        <div class="form-group">
            <label for="stores">Lojas</label>
            <select name="store" class="form-control" id="store">
                @foreach($stores as $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Criar Produto</button>
        </div>
    </form>
@endsection
