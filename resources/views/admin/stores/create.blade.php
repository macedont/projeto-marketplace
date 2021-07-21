@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.add')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Nome Loja:</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control" name="description">
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" class="form-control" name="phone">
        </div>

        <div class="form-group">
            <label>Celular:</label>
            <input type="text" class="form-control" name="mobile_phone">
        </div>

        <div class="form-group">
            <label>Usuário:</label>
            <select name="user" class="form-control">
                <option value="">Escolha um usuário</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Criar Loja</button>
        </div>
    </form>
@endsection
