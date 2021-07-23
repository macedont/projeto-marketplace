@extends('layouts.app')
@section('content')

    <form action="{{route('admin.stores.update', ['store' => $stores['id']])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome Loja:</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{$stores['name']}}">
            @error('name')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{$stores['description']}}">
            @error('description')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" class="form-control @error('phone')is-invalid @enderror" name="phone" value="{{$stores['phone']}}">
            @error('phone')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular:</label>
            <input type="text" class="form-control @error('mobile_phone')is-invalid @enderror" name="mobile_phone" value="{{$stores['mobile_phone']}}">
            @error('mobile_phone')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-primary" type="submit">Atualizar Dados</button>
        </div>
    </form>

@endsection
