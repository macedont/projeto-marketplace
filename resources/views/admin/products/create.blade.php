@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label>Nome Produto:</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{old('name')}}">
            @error('name')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{old('description')}}">
            @error('description')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="body" class="form-control @error('body')is-invalid @enderror" cols="30" rows="3">{{old('body')}}</textarea>
            @error('body')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control @error('price')is-invalid @enderror" name="price" value="{{old('price')}}">
            @error('price')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Criar Produto</button>
        </div>
    </form>
@endsection
